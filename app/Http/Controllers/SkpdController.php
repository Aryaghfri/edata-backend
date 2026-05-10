<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Skpd;

class SkpdController extends Controller
{
    public function index()
    {
        return response()->json(['status' => true, 'data' => Skpd::all()]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_skpd' => 'required|string|max:128|unique:skpd,kode_skpd',
            'nama_skpd' => 'required|string',
        ]);

        $skpd = Skpd::create([
            'kode_skpd' => $request->kode_skpd,
            'nama_skpd' => $request->nama_skpd,
            'alamat_skpd' => $request->alamat_skpd ?? null,
            'nomor_telepon' => $request->nomor_telepon ?? null,
            'email' => $request->email ?? null,
            'website' => $request->website ?? null,
            'tanggal_dibentuk' => $request->tanggal_dibentuk ?? null,
            'status_skpd' => $request->status_skpd ?? 1,
        ]);

        return response()->json(['status' => true, 'data' => $skpd], 201);
    }

    public function update(Request $request, $id)
    {
        $skpd = Skpd::findOrFail($id);

        $request->validate([
            'nama_skpd' => 'required|string',
        ]);

        $skpd->update($request->only([
            'kode_skpd',
            'nama_skpd',
            'alamat_skpd',
            'nomor_telepon',
            'email',
            'website',
            'tanggal_dibentuk',
            'status_skpd'
        ]));

        return response()->json(['status' => true, 'data' => $skpd]);
    }

    public function destroy($id)
    {
        $skpd = Skpd::with('pegawai')->findOrFail($id);

        if ($skpd->pegawai()->exists()) {
            return response()->json([
                'status' => false,
                'message' => 'SKPD tidak bisa dihapus karena masih memiliki pegawai.'
            ], 400);
        }

        $skpd->delete();

        return response()->json(['status' => true, 'message' => 'SKPD berhasil dihapus']);
    }
}