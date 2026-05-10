<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kegiatan;

class OperatorKegiatanController extends Controller
{
    public function search(Request $request)
    {
        $keyword = $request->input('keyword');

        $results = Kegiatan::with(['skpd', 'pegawai', 'dokumen'])
            ->where(function ($q) use ($keyword) {
                $q->where('nama_kegiatan', 'like', "%$keyword%")
                    ->orWhereHas('skpd', fn($q2) => $q2->where('nama_skpd', 'like', "%$keyword%"))
                    ->orWhereHas('pegawai', fn($q3) => $q3->where('nama_pegawai', 'like', "%$keyword%"));
            })
            ->get();

        return response()->json([
            'status' => 'success',
            'data' => $results->map(function ($item) {
                return [
                    'idkegiatan' => $item->idkegiatan,
                    'nama_kegiatan' => $item->nama_kegiatan,
                    'skpd' => $item->skpd->pluck('nama_skpd')->toArray(),
                    'petugas' => $item->pegawai->nama_pegawai ?? null,
                    'status' => $item->status_kegiatan, // accessor
                    'catatan' => $item->catatan_verifikasi, 
                ];
            }),
        ]);
    }

    /**
     * Menampilkan semua kegiatan
     */
    public function index(Request $request)
    {
        $kegiatan = Kegiatan::with(['skpd', 'pegawai', 'dokumen'])->get();

        $data = $kegiatan->map(function ($item) {
            return [
                'idkegiatan' => $item->idkegiatan,
                'nama_kegiatan' => $item->nama_kegiatan,
                'skpd' => $item->skpd->pluck('nama_skpd')->toArray(),
                'petugas' => $item->pegawai->nama_pegawai ?? null,
                'status' => $item->status_kegiatan,
                'catatan' => $item->catatan_verifikasi, 
            ];
        });

        return response()->json([
            'status' => 'success',
            'message' => 'Data kegiatan berhasil diambil',
            'data' => $data,
        ]);
    }


    /**
     * Menambahkan kegiatan baru
     */
    public function store(Request $request)
{
    $validated = $request->validate([
        'nama_kegiatan' => 'required|string|max:255',
        'lokasi' => 'required|string|max:255',
        'anggaran' => 'required|numeric',
        'idJenis_kegiatan' => 'required|integer|exists:jenis_kegiatan,idJenis_kegiatan',
        'idSKPD' => 'required|array',
        'idSKPD.*' => 'integer|exists:skpd,idSKPD',
        'waktu' => 'required|date'
    ]);

    
    // siapkan data kegiatan saja (tanpa idSKPD array)
    $dataKegiatan = [
        'nama_kegiatan' => $validated['nama_kegiatan'],
        'lokasi' => $validated['lokasi'],
        'anggaran' => $validated['anggaran'],
        'idJenis_kegiatan' => $validated['idJenis_kegiatan'],
        'waktu' => $validated['waktu'],
        'idPegawai' => $request->user()->idPegawai,
        'verifikasi' => 0,
        'publikasi' => 0,
    ];

    // simpan kegiatan
    $kegiatan = Kegiatan::create($dataKegiatan);

    // simpan banyak SKPD ke pivot table
    $kegiatan->skpd()->attach($validated['idSKPD']);

    return response()->json([
        'status' => 'success',
        'message' => 'Kegiatan berhasil ditambahkan',
        'data' => $kegiatan->load(['skpd', 'pegawai', 'dokumen'])
    ], 201);
}


    /**
     * Menampilkan detail kegiatan
     */
    public function show(Request $request, $id)
    {
    $kegiatan = Kegiatan::with(['skpd', 'pegawai'])
    ->where('idPegawai', $request->user()->idPegawai)
    ->where('idkegiatan', $id)
    ->first();


        if (!$kegiatan) {
            return response()->json([
                'status' => 'error',
                'message' => 'Kegiatan tidak ditemukan',
                'data' => null
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Detail kegiatan berhasil diambil',
            'data' => $kegiatan
        ]);
    }

    /**
     * Mengupdate kegiatan
     */
    public function update(Request $request, $id)
{
    $kegiatan = Kegiatan::where('idPegawai', $request->user()->idPegawai)->find($id);

    if (!$kegiatan) {
        return response()->json([
            'status' => 'error',
            'message' => 'Kegiatan tidak ditemukan',
            'data' => null
        ], 404);
    }

    if (in_array($kegiatan->verifikasi, [1, 2]) || $kegiatan->dokumen()->exists()) {
        return response()->json([
            'status' => 'error',
            'message' => 'Kegiatan sudah diverifikasi atau sudah ada dokumen, tidak dapat diedit',
            'data' => null
        ], 403);
    }

    $validated = $request->validate([
        'nama_kegiatan' => 'required|string|max:255',
        'lokasi' => 'required|string|max:255',
        'anggaran' => 'required|numeric',
        'idJenis_kegiatan' => 'required|integer|exists:jenis_kegiatan,idJenis_kegiatan',
        'idSKPD' => 'required|array',
        'idSKPD.*' => 'integer|exists:skpd,idSKPD',
        'waktu' => 'nullable|date'
    ]);

    // pisahkan data kegiatan
    $dataKegiatan = [
        'nama_kegiatan' => $validated['nama_kegiatan'],
        'lokasi' => $validated['lokasi'],
        'anggaran' => $validated['anggaran'],
        'idJenis_kegiatan' => $validated['idJenis_kegiatan'],
        'waktu' => $validated['waktu'],
    ];

    // update tabel kegiatan
    $kegiatan->update($dataKegiatan);

    // update banyak SKPD di pivot (replace daftar lama)
    $kegiatan->skpd()->sync($validated['idSKPD']);

    return response()->json([
        'status' => 'success',
        'message' => 'Kegiatan berhasil diperbarui',
        'data' => $kegiatan->load('skpd')
    ]);
}


    /**
     * Menghapus kegiatan
     */
    public function destroy(Request $request, $id)
    {
        $kegiatan = Kegiatan::where('idPegawai', $request->user()->idPegawai)->find($id);

        if (!$kegiatan) {
            return response()->json([
                'status' => 'error',
                'message' => 'Kegiatan tidak ditemukan',
                'data' => null
            ], 404);
        }

        if (in_array($kegiatan->verifikasi, [1, 2]) || $kegiatan->dokumen()->exists()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Kegiatan sudah diverifikasi atau sudah ada dokumen, tidak dapat dihapus',
                'data' => null
            ], 403);
        }
        $kegiatan->skpd()->detach();
        $kegiatan->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Kegiatan berhasil dihapus',
            'data' => null
        ]);
    }
}
