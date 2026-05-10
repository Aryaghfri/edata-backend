<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    public function getUser(Request $request)
    {
        $user = $request->user()->load('peran');
        $token = $request->bearerToken();

        return response()->json([
            'id'              => (int) $user->idAkun,
            'username'        => e($user->username),
            'idPeran'         => (int) $user->idPeran,
            'idPegawai'       => (int) $user->idPegawai,
            'status_akun'     => (int) $user->status_akun,
            'role'            => $user->peran->nama_peran ?? null, 
            'token'           => $token, 
        ]);
    }

    public function changePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => ['required'], 
            'new_password' => [
                'required',
                'confirmed',
                Password::min(8)       // min 8 karakter
                    ->letters()       // wajib ada huruf
                    ->mixedCase()     // wajib ada huruf besar + kecil
                    ->numbers()       // wajib ada angka
                    ->symbols()       // wajib ada simbol
            ],
        ]);

        $user = $request->user();

        // cek password lama
        if (!Hash::check($request->current_password, $user->password_hash)) {
            return response()->json([
                'message' => 'Password lama salah'
            ], 400);
        }
        
        // update password
        $user->password_hash = Hash::make($validated['new_password']);
        $user->save();
        
        // hapus semua token lama biar aman
        $user->tokens()->delete();

        // token baru 
        $token = $user->createToken('API Token')->plainTextToken;

        return response()->json([
            'message' => 'Password berhasil diubah',
            'token'   => $token
        ]);
    }
}
