<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pegawai;

class PegawaiController extends Controller
{
    public function index()
    {
        return response()->json([
            'status' => true,
            'data' => Pegawai::with('skpd')->get()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'idSKPD' => 'required|exists:skpd,idSKPD',
            'nama_pegawai' => 'required|string|max:255',
            'email' => 'required|email|unique:pegawai,email',
        ]);

        $tanggalDiangkat = $request->tanggal_diangkat ?? now()->format('Y-m-d');
        $tanggalBerhenti = $request->tanggal_berhenti ?? '9999-12-31';
        $today = now()->format('Y-m-d');
        $statusPegawai = ($today >= $tanggalDiangkat && $today <= $tanggalBerhenti) ? 1 : 0;

        $pegawai = Pegawai::create([
            'idSKPD' => $request->idSKPD,
            'NIP' => $request->NIP ?? '-',
            'nama_pegawai' => $request->nama_pegawai,
            'alamat_pegawai' => $request->alamat_pegawai ?? '-',
            'email' => $request->email,
            'nomor_telepon' => $request->nomor_telepon ?? '-',
            'gelar_depan' => $request->gelar_depan ?? '',
            'gelar_belakang' => $request->gelar_belakang ?? '',
            'agama' => $request->agama ?? '-',
            'tempat_lahir' => $request->tempat_lahir ?? '-',
            'tanggal_lahir' => $request->tanggal_lahir ?? now()->format('Y-m-d'),
            'jenis_kelamin' => $request->jenis_kelamin ?? null,
            'status_kawin' => $request->status_kawin ?? null,
            'tanggal_diangkat' => $tanggalDiangkat,
            'tanggal_berhenti' => $tanggalBerhenti,
            'status_pegawai' => $statusPegawai,
        ]);

        return response()->json(['status' => true, 'data' => $pegawai], 201);
    }

    public function update(Request $request, $id)
    {
        $pegawai = Pegawai::findOrFail($id);

        $request->validate([
            'email' => 'sometimes|email|unique:pegawai,email,' . $pegawai->idPegawai . ',idPegawai',
            'idSKPD' => 'sometimes|exists:skpd,idSKPD',
        ]);

        $fields = $request->only([
            'idSKPD',
            'NIP',
            'nama_pegawai',
            'alamat_pegawai',
            'email',
            'nomor_telepon',
            'gelar_depan',
            'gelar_belakang',
            'agama',
            'tempat_lahir',
            'tanggal_lahir',
            'jenis_kelamin',
            'status_kawin',
            'tanggal_diangkat',
            'tanggal_berhenti'
        ]);

        if (isset($fields['tanggal_diangkat']) || isset($fields['tanggal_berhenti'])) {
            $tanggalDiangkat = $fields['tanggal_diangkat'] ?? $pegawai->tanggal_diangkat;
            $tanggalBerhenti = $fields['tanggal_berhenti'] ?? $pegawai->tanggal_berhenti;
            $today = now()->format('Y-m-d');
            $fields['status_pegawai'] = ($today >= $tanggalDiangkat && $today <= $tanggalBerhenti) ? 1 : 0;
        }

        $pegawai->update($fields);

        return response()->json(['status' => true, 'data' => $pegawai]);
    }

    public function destroy($id)
    {
        $pegawai = Pegawai::with('akun')->findOrFail($id);

        if ($pegawai->akun()->exists()) {
            return response()->json([
                'status' => false,
                'message' => 'Pegawai tidak bisa dihapus karena masih memiliki akun login.'
            ], 400);
        }

        $pegawai->delete();

        return response()->json(['status' => true, 'message' => 'Pegawai berhasil dihapus']);
    }
}
