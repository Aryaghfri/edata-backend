<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{

    public function handle(Request $request, Closure $next, $role)
    {
        // Ambil user yang login via Sanctum
        $user = $request->user();

        // Kalau user belum login
        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized: Anda belum login'
            ], 401);
        }

        $userRole = strtolower(trim($user->peran?->nama_peran ?? ''));
        $requiredRole = strtolower(trim($role));

        if ($userRole === 'superadmin') {
            return $next($request);
        }


        if ($userRole !== $requiredRole) {
            return response()->json([
                'status' => 'error',
                'message' => 'Forbidden: Anda tidak memiliki akses ke halaman ini'
            ], 403);
        }

        return $next($request);
    }
}

