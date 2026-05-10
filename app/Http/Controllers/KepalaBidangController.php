<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;
use App\Models\Kegiatan;
use App\Models\Dokumen;

class KepalaBidangController extends Controller
{
   public function daftarKegiatan(Request $request)
{
    $kegiatan = Kegiatan::with(['jenis', 'pegawai', 'skpd', 'dokumen'])
        ->get();

    $data = $kegiatan->map(function ($item) {
        return [
            'idkegiatan' => $item->idkegiatan,
            'nama_kegiatan' => $item->nama_kegiatan,
            'skpd' => $item->skpd->pluck('nama_skpd')->toArray(),
            'petugas' => $item->pegawai->nama_pegawai ?? null,
            'tanggal_input' => $item->waktu,
            'status_kegiatan' => $item->status_kegiatan,
        ];
    });

    return response()->json([
        'status' => true,
        'message' => 'Data kegiatan kabid berhasil diambil',
        'data' => $data
    ]);
}


    // Ambil daftar dokumen untuk verifikasi dari suatu kegiatan
    public function daftarDokumenKegiatan($idKegiatan)
    {
        $dokumen = Dokumen::with(['jenis'])
            ->where('idKegiatan', $idKegiatan)
            ->get();
        return response()->json($dokumen);
    }

    // Verifikasi per dokumen
    public function verifikasiDokumen(Request $request, $idDokumen)
    {
         $request->validate([
            'status' => 'required|in:2,3', // 2 = disetujui, 3 = ditolak
        ]);
        $dokumen = Dokumen::findOrFail($idDokumen);
        $dokumen->verifikasi = $request->status;
        $dokumen->save();

        return response()->json([
            'message' => 'Status Dokumen Berhasil dirubah',
            'verifikasi' => $dokumen->verifikasi,
            'dokumen' => $dokumen
        ]);

    }

    // verivikasi kegiatan dan catatan verifikasi
    public function verifikasiKegiatan(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:2,3', // 2 = diterima, 3 = ditolak
            'catatan' => 'nullable|string'
        ]);

        $kegiatan = Kegiatan::findOrFail($id);
        $kegiatan->verifikasi = $request->status;
        $kegiatan->catatan_verifikasi = $request->catatan;
        $kegiatan->save();

        return response()->json([
            'message' => 'Status Kegiatan Berhasil Diubah',
            'kegiatan' => $kegiatan
        ]);
    }

    // Ubah status publikasi kegiatan
    public function updatePublikasi(Request $request, $id)
    {
        $request->validate([
            'publikasi' => 'required|in:0,1'
        ]);

        $kegiatan = Kegiatan::findOrFail($id);
        $kegiatan->publikasi = $request->publikasi;
        $kegiatan->save();

        return response()->json([
            'message' => 'Status publikasi kegiatan berhasil dirubah',
            'idkegiatan' => $kegiatan->idkegiatan,
            'publikasi' => $kegiatan->publikasi == 1 ? 'Publik' : 'Internal'
        ]);
    }

    // mencari kegiatan berdasarkan keyword
    public function search(Request $request)
    {
        $request->validate(['keyword' => 'required|string|max:255']);
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
                    'status' => $item->status_kegiatan,
                ];
            }),
        ]);
    }

    public function aksesDokumen($idDokumen)
    {
        $dokumen = Dokumen::findOrFail($idDokumen);

        if (!$dokumen->upload_file) {
            return response()->json(['message' => 'File tidak ditemukan di database'], 404);
        }

        // Konversi backslash Windows ke slash
        $path = str_replace('\\', '/', $dokumen->upload_file);

        $fullPath = storage_path('app/public/' . $path);

        if (!file_exists($fullPath)) {
            return response()->json(['message' => 'File fisik tidak ditemukan'], 404);
        }

        return response()->file($fullPath);
    }

}