<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KepalaBidangController;
use App\Http\Controllers\OperatorController;
use App\Http\Controllers\TimDokumentasiController;
use App\Http\Controllers\OperatorKegiatanController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Semua route web aplikasi
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::view('/{any}', 'app')->where('any', '.*');
Route::view('/{any}', 'app')->where('any', '^(?!api|kegiatan).*$');

