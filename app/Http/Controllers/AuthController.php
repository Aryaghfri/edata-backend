<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Akun;
use Mews\Captcha\Facades\Captcha;


class AuthController extends Controller
{

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
            'captcha' => 'required',
            'captcha_key' => 'required'
        ]);

        // Validasi captcha
        if (!captcha_api_check($request->captcha, $request->captcha_key, 'flat')) {
            return response()->json(['message' => 'Captcha salah'], 422);
        }

        $user = Akun::with('peran')->where('username', $request->username)->first();

        if (!$user) {
            return response()->json(['message' => 'Username tidak ditemukan'], 404);
        }

        if ($user->status_akun != 1) {
            return response()->json(['message' => 'Akun tidak aktif'], 403);
        }

        if (!Hash::check($request->password, $user->password_hash)) {
            return response()->json(['message' => 'Password salah'], 401);
        }

        // Sanctum token
        $token = $user->createToken('API Token')->plainTextToken;

        // Respon 
        return response()->json([
            'message' => 'Login berhasil',
            'token' => $token,
            'user' => [
                'id' => $user->idAkun,
                'username' => e($user->username),
                'role' => e($user->peran->nama_peran ?? null),
            ]
        ]);
    }

    public function getCaptcha()
    {
        $captcha = Captcha::create('flat', true);

        return response()->json([
            'captcha_key' => $captcha['key'],
            'captcha_img' => $captcha['img'],
        ]);
    }


    public function logout(Request $request)
    {
        // Kalau mau hapus semua token user
        $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'Logout berhasil'
        ]);
    }
}
