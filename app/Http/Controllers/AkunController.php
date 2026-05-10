<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Akun;

class AkunController extends Controller
{
    // 📋 Ambil semua akun + relasi pegawai & peran
    public function index()
    {
        $akun = Akun::with(['peran', 'pegawai.skpd'])->get();

        return response()->json([
            'status' => true,
            'message' => 'Daftar akun berhasil diambil',
            'data' => $akun
        ]);
    }

    // ➕ Tambah akun baru (pegawai sudah ada)
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|unique:akun,username',
            'idPeran' => 'required|exists:peran,idPeran',
            'idPegawai' => 'required|exists:pegawai,idPegawai',
        ]);

        // 🔎 Ambil pegawai berdasarkan idPegawai
        $pegawai = \App\Models\Pegawai::findOrFail($request->idPegawai);

        // Kalau NIP kosong/null → pakai default password
        $passwordDefault = !empty($pegawai->NIP) ? $pegawai->NIP : 'password123!';

        $akun = Akun::create([
            'username' => $request->username,
            'password_hash' => Hash::make($passwordDefault),
            'idPeran' => $request->idPeran,
            'idPegawai' => $request->idPegawai,
            'status_akun' => 1,
            'akses_terakhir' => now(),
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Akun berhasil dibuat',
            'username' => $akun->username,
            'password_default' => $passwordDefault,
            'data' => $akun,
        ], 201);
    }

    // ✏️ Update akun
    public function update(Request $request, $id)
    {
        $akun = Akun::findOrFail($id);

        $request->validate([
            'username' => 'sometimes|string|unique:akun,username,' . $id . ',idAkun',
            'password' => 'sometimes|string|min:8',
            'idPeran' => 'sometimes|exists:peran,idPeran',
            'idPegawai' => 'sometimes|exists:pegawai,idPegawai',
        ]);

        if ($request->filled('username'))
            $akun->username = $request->username;
        if ($request->filled('password')) {
            $akun->password_hash = Hash::make($request->password); // manual input
        } elseif ($request->filled('idPegawai')) {
            // kalau ganti pegawai, bisa reset password ke NIP pegawai baru
            $pegawai = \App\Models\Pegawai::findOrFail($request->idPegawai);
            $akun->password_hash = Hash::make($pegawai->NIP ?? 'password123!');
        }

        if ($request->filled('idPeran'))
            $akun->idPeran = $request->idPeran;
        if ($request->filled('idPegawai'))
            $akun->idPegawai = $request->idPegawai;

        $akun->save();

        return response()->json([
            'status' => true,
            'message' => 'Akun berhasil diperbarui',
            'data' => $akun,
        ]);
    }

    // 🗑️ Hapus akun (pegawai tetap ada)
    public function destroy($id)
    {
        $akun = Akun::findOrFail($id);
        $akun->delete();

        return response()->json([
            'status' => true,
            'message' => 'Akun berhasil dihapus (pegawai tetap ada)',
        ]);
    }
}
