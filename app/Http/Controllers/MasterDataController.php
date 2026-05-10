<?php

namespace App\Http\Controllers;

use App\Models\JenisKegiatan;
use App\Models\Skpd;
use App\Models\Pegawai;
use App\Models\Peran;
use App\Models\JenisDokumen;

class MasterDataController extends Controller
{
    public function jenisKegiatan()
    {
        return response()->json([
            'status' => true,
            'data' => JenisKegiatan::all()
        ]);
    }

    public function jenisDokumen()
    {
        return response()->json([
            'status' => true,
            'data' => JenisDokumen::all()
        ]);
    }
    public function peran()
    {
        return response()->json([
            'status' => true,
            'data' => Peran::all()
        ]);
    }

}
