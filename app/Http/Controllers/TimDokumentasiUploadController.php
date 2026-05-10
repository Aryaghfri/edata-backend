<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use Illuminate\Http\Request;
use App\Models\Dokumen;
use App\Models\JenisDokumen;

class TimDokumentasiUploadController extends Controller
{
    // 🔎 Search kegiatan
    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
        $tanggalAwal = $request->input('tanggal_awal');
        $tanggalAkhir = $request->input('tanggal_akhir');

        $query = Kegiatan::with(['skpd', 'pegawai']);

        if ($keyword) {
            $query->where(function ($q) use ($keyword) {
                $q->where('nama_kegiatan', 'like', "%$keyword%")
                    ->orWhereHas('skpd', function ($q2) use ($keyword) {
                        $q2->where('nama_skpd', 'like', "%$keyword%");
                    })
                    ->orWhereHas('pegawai', function ($q3) use ($keyword) {
                        $q3->where('nama_pegawai', 'like', "%$keyword%");
                    });
            });
        }

        if ($tanggalAwal && $tanggalAkhir) {
            $query->whereBetween('waktu', [$tanggalAwal, $tanggalAkhir]);
        } elseif ($tanggalAwal) {
            $query->where('waktu', '>=', $tanggalAwal);
        } elseif ($tanggalAkhir) {
            $query->where('waktu', '<=', $tanggalAkhir);
        }

        $results = $query->orderBy('waktu', 'desc')->get();

        $data = $results->map(function ($item) {
            return [
                'idkegiatan' => $item->idkegiatan,
                'nama_kegiatan' => $item->nama_kegiatan,
                'skpd' => $item->skpd->pluck('nama_skpd')->toArray(),
                'petugas' => $item->pegawai->nama_pegawai ?? null,
                'tanggal_input' => $item->waktu,
                'status_kegiatan' => $item->status_kegiatan, // pakai accessor dari Model
            ];
        });

        return response()->json([
            'status' => true,
            'message' => 'Hasil pencarian kegiatan untuk tim dokumentasi berhasil',
            'data' => $data,
        ]);
    }

    // 🔎 Search dokumen
    public function searchDokumen(Request $request)
    {
        $keyword = $request->input('keyword');
        $idkegiatan = $request->input('idkegiatan');

        $query = Dokumen::with(['jenis', 'pegawai', 'kegiatan']);

        if ($idkegiatan) {
            $query->where('idKegiatan', $idkegiatan);
        }

        if ($keyword) {
            $query->where(function ($q) use ($keyword) {
                $q->where('nomor_dokumen', 'like', "%$keyword%")
                    ->orWhereHas('jenis', function ($q2) use ($keyword) {
                        $q2->where('nama_jenis_dokumen', 'like', "%$keyword%");
                    })
                    ->orWhereHas('pegawai', function ($q3) use ($keyword) {
                        $q3->where('nama_pegawai', 'like', "%$keyword%");
                    });
            });
        }

        $dokumen = $query->get();

        $data = $dokumen->map(fn($item) => $this->mapDokumen($item));

        return response()->json([
            'status' => true,
            'message' => 'Hasil pencarian dokumen berhasil',
            'data' => $data
        ]);
    }

    // Mapping data dokumen
    private function mapDokumen($item)
    {
        return [
            'idDokumen' => $item->idDokumen,
            'nomor_dokumen' => $item->nomor_dokumen,
            'nama_dokumen' => $item->nama_dokumen,
            'jenis_dokumen' => $item->jenis->nama_jenis_dokumen ?? null,
            'penyusun' => $item->pegawai->nama_pegawai ?? null,
            'status' => $item->status_dokumen,
            'editable' => $item->editable,
            'deletable' => $item->deletable,
            'link_dokumen' => asset('storage/' . $item->upload_file),
        ];
    }

    // 📋 Index semua kegiatan
    public function index()
    {
        $kegiatan = Kegiatan::with(['skpd', 'pegawai'])
            ->orderBy('waktu', 'desc')
            ->get();

        $data = $kegiatan->map(function ($item) {
            return [
                'idkegiatan' => $item->idkegiatan,
                'nama_kegiatan' => $item->nama_kegiatan,
                'skpd' => $item->skpd->pluck('nama_skpd')->toArray(),
                'petugas' => $item->pegawai->nama_pegawai ?? null,
                'tanggal_input' => $item->waktu ?? null,
                'status_kegiatan' => $item->status_kegiatan, // pakai accessor
            ];
        });

        return response()->json([
            'status' => true,
            'message' => 'Data kegiatan untuk dokumentasi berhasil diambil',
            'data' => $data
        ]);
    }

    // 📂 Ambil semua dokumen per kegiatan
    public function getDokumen($idkegiatan)
    {
        $dokumen = Dokumen::with(['jenis', 'kegiatan.pegawai'])
            ->where('idKegiatan', $idkegiatan)
            ->get();

        $data = $dokumen->map(fn($item) => $this->mapDokumen($item));

        return response()->json([
            'status' => true,
            'message' => 'Data dokumen berhasil diambil',
            'data' => $data
        ]);
    }

    // ➕ Tambah dokumen baru
    public function storeDokumen(Request $request, $idkegiatan)
    {
        $saved = [];

        if ($request->has('dokumen') && is_array($request->dokumen)) {
            $request->validate([
                'dokumen' => 'required|array',
                'dokumen.*.nomor_dokumen' => 'nullable|string|max:28|unique:dokumen,nomor_dokumen',
                'dokumen.*.nama_dokumen' => 'required|string|max:150',
                'dokumen.*.idJenis_dokumen' => 'required|exists:jenis_dokumen,idJenis_dokumen',
                'dokumen.*.file' => 'required|file|mimes:pdf,doc,docx,jpg,png,xls,xlsx|max:2048',
            ]);

            foreach ($request->dokumen as $index => $doc) {
                $file = $request->file("dokumen.$index.file");
                if (!$file)
                    continue;

                $path = $file->store('uploads', 'public');


                $saved[] = Dokumen::create([
                    'nomor_dokumen' => $doc['nomor_dokumen'],
                    'nama_dokumen' => $doc['nama_dokumen'],
                    'idKegiatan' => $idkegiatan,
                    'idJenis_dokumen' => $doc['idJenis_dokumen'],
                    'idPegawai' => auth()->user()->idPegawai,
                    'upload_file' => $path,
                    'verifikasi' => 0,
                    'publikasi' => 0,
                ]);
            }
        } else {
            $request->validate([
                'nomor_dokumen' => 'nullable|string|max:28|unique:dokumen,nomor_dokumen',
                'nama_dokumen' => 'required|string|max:150',
                'idJenis_dokumen' => 'required|exists:jenis_dokumen,idJenis_dokumen',
                'file' => 'required|file|mimes:pdf,doc,docx,jpg,png,xls,xlsx|max:2048',
            ]);

            $path = $request->file('file')->store('uploads', 'public');


            $saved[] = Dokumen::create([
                'nomor_dokumen' => $request->nomor_dokumen,
                'nama_dokumen' => $request->nama_dokumen,
                'idKegiatan' => $idkegiatan,
                'idJenis_dokumen' => $request->idJenis_dokumen,
                'idPegawai' => auth()->user()->idPegawai,
                'upload_file' => $path,
                'verifikasi' => 0,
                'publikasi' => 0,
            ]);
        }

        $allDokumen = Dokumen::with(['jenis', 'pegawai'])
            ->where('idKegiatan', $idkegiatan)
            ->get()
            ->map(fn($item) => $this->mapDokumen($item));

        return response()->json([
            'status' => true,
            'message' => count($saved) . ' dokumen berhasil ditambahkan',
            'data' => $allDokumen
        ]);
    }

    // ✏️ Update dokumen
    public function updateDokumen(Request $request, $idDokumen)
    {
        $dokumen = Dokumen::findOrFail($idDokumen);

        $request->validate([
            'nomor_dokumen' => 'sometimes|string|max:28|unique:dokumen,nomor_dokumen,' . $idDokumen . ',idDokumen',
            'nama_dokumen' => 'sometimes|string|max:150',
            'idJenis_dokumen' => 'sometimes|exists:jenis_dokumen,idJenis_dokumen',
            'file' => 'sometimes|file|mimes:pdf,doc,docx,jpg,png,xls,xlsx|max:2048',
        ]);

        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('uploads', 'public');
            $dokumen->upload_file = $path;
        }

        if ($request->filled('nomor_dokumen')) {
            $dokumen->nomor_dokumen = $request->nomor_dokumen;
        }

        if ($request->filled('idJenis_dokumen')) {
            $dokumen->idJenis_dokumen = $request->idJenis_dokumen;

        }
        if ($request->filled('nama_dokumen')) {
            $dokumen->nama_dokumen = $request->nama_dokumen;
        }

        $dokumen->save();

        return response()->json([
            'status' => true,
            'message' => 'Dokumen berhasil diperbarui',
            'data' => $this->mapDokumen($dokumen)
        ]);
    }

    // 🗑️ Hapus dokumen
    public function destroyDokumen($idDokumen)
    {
        $dokumen = Dokumen::findOrFail($idDokumen);

        if ($dokumen->verifikasi > 1) {
            return response()->json([
                'status' => false,
                'message' => 'Dokumen tidak bisa dihapus, sudah disetujui/ditolak Kabid'
            ], 403);
        }

        $dokumen->delete();

        return response()->json([
            'status' => true,
            'message' => 'Dokumen berhasil dihapus'
        ]);
    }

    // 📤 Submit semua dokumen ke Kabid
    public function submitToKabid($idkegiatan)
    {
        if (!Dokumen::where('idKegiatan', $idkegiatan)->exists()) {
            return response()->json([
                'status' => false,
                'message' => 'Belum ada dokumen untuk dikirim'
            ], 400);
        }

        Dokumen::where('idKegiatan', $idkegiatan)
            ->update(['verifikasi' => 1]);

        Kegiatan::where('idkegiatan', $idkegiatan)
            ->update(['verifikasi' => 1]);

        return response()->json([
            'status' => true,
            'message' => 'Semua dokumen berhasil dikirim ke Kabid'
        ]);
    }
}
