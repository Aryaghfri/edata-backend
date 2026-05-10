<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kegiatan;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    // Endpoint ringkasan dashboard
   public function index()
{
    // total semua kegiatan
    $totalKegiatan = Kegiatan::count();

    // total pembinaan
    $totalPembinaan = Kegiatan::whereHas('jenis', function($q) {
        $q->where('nama_jenis_kegiatan', 'pembinaan');
    })->count();

    // total sosialisasi
    $totalSosialisasi = Kegiatan::whereHas('jenis', function($q) {
        $q->where('nama_jenis_kegiatan', 'sosialisasi');
    })->count();

    return response()->json([
        'status' => 'success',
        'data' => [
            'total_kegiatan'   => $totalKegiatan,
            'total_pembinaan'  => $totalPembinaan,
            'total_sosialisasi'=> $totalSosialisasi,
        ]
    ]);
}



// Endpoint statistik per tahun
  public function statistik()
{
    $statistik = Kegiatan::select(
            DB::raw('YEAR(waktu) as tahun'),
            DB::raw('COUNT(*) as total')
        )
        ->whereNotNull('waktu')
        ->groupBy('tahun')
        ->orderBy('tahun', 'asc')
        ->get();

    return response()->json($statistik);
}
}
