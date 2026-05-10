<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OperatorKegiatanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TimDokumentasiUploadController;
use App\Http\Controllers\KepalaBidangController;
use App\Http\Controllers\AkunController;
use App\Http\Controllers\MasterDataController;
use App\Http\Controllers\SkpdController;
use App\Http\Controllers\PegawaiController;

// base url local: http://localhost:8000/api 

// ==================== AUTHENTICATION ====================

// without token
Route::post('/login', [AuthController::class, 'login']);
// with token
Route::middleware('auth:sanctum')->group(function () {
    // ambil data user
    Route::get('/user', [UserController::class, 'getUser']);
    // ubah password
    Route::post('/change-password', [UserController::class, 'changePassword']);
    //logout
    Route::post('/logout', [AuthController::class, 'logout']);
});
Route::get('/captcha', [AuthController::class, 'getCaptcha']);


// ==================== OPERATOR ====================
Route::middleware(['auth:sanctum', 'role:operator'])->group(function () {
    Route::get('/kegiatan/search', [OperatorKegiatanController::class, 'search']);
    Route::get('/kegiatan', [OperatorKegiatanController::class, 'index']);
    Route::post('/kegiatan', [OperatorKegiatanController::class, 'store']);
    Route::get('/kegiatan/{id}', [OperatorKegiatanController::class, 'show']);
    Route::put('/kegiatan/{id}', [OperatorKegiatanController::class, 'update']);
    Route::delete('/kegiatan/{id}', [OperatorKegiatanController::class, 'destroy']);
});

// ==================== DASHBOARD ====================
Route::get('/dashboard', [DashboardController::class, 'index']);
Route::get('/dashboard/statistik', [DashboardController::class, 'statistik']);

// ==================== TIM DOKUMENTASI ====================
Route::middleware(['auth:sanctum', 'role:tim dokumentasi'])->group(function () {
    Route::get('/dokumentasi/kegiatan/search', [TimDokumentasiUploadController::class, 'search']);
    Route::get('/dokumen/search', [TimDokumentasiUploadController::class, 'searchDokumen']);
    Route::get('/dokumentasi/kegiatan', [TimDokumentasiUploadController::class, 'index']);
    Route::get('/kegiatan/{id}/dokumen', [TimDokumentasiUploadController::class, 'getDokumen']);
    Route::post('/kegiatan/{id}/dokumen', [TimDokumentasiUploadController::class, 'storeDokumen']);
    Route::put('/dokumen/{id}', [TimDokumentasiUploadController::class, 'updateDokumen']);
    Route::delete('/dokumen/{id}', [TimDokumentasiUploadController::class, 'destroyDokumen']);
    Route::put('/kegiatan/{id}/submit', [TimDokumentasiUploadController::class, 'submitToKabid']);
});

// ==================== KEPALA BIDANG ====================
Route::middleware(['auth:sanctum', 'role:kepala bidang'])->group(function () {
    // ambil semua kegiatan
    Route::get('/verifikasi/kegiatan', [KepalaBidangController::class, 'daftarKegiatan']);
    // ambil semua dokumen dalam kegiatan
    Route::get('/verifikasi/kegiatan/{id}/dokumen', [KepalaBidangController::class, 'daftarDokumenKegiatan']);
    // search kegiatan
    Route::post('/verifikasi/kegiatan/search', [KepalaBidangController::class, 'search']);
    // verifikasi dokumen per item
    Route::post('/verifikasi/dokumen/{id}', [KepalaBidangController::class, 'verifikasiDokumen']);
    // verifikasi kegiatan (diterima/ditolak + catatan)
    Route::post('/verifikasi/kegiatan/{id}', [KepalaBidangController::class, 'verifikasiKegiatan']);
    // publikasi kegiatan
    Route::put('/publikasi/kegiatan/{id}', [KepalaBidangController::class, 'updatePublikasi']);

});

// ==================== SUPER ADMIN ====================
Route::middleware(['auth:sanctum', 'role:superadmin'])->group(function () {
    Route::get('/akun', [AkunController::class, 'index']);
    Route::post('/akun', [AkunController::class, 'store']);
    Route::put('/akun/{id}', [AkunController::class, 'update']);
    Route::delete('/akun/{id}', [AkunController::class, 'destroy']);
});

// SKPD
Route::get('/master/skpd', [SkpdController::class, 'index'])
    ->middleware(['auth:sanctum']);
Route::middleware(['auth:sanctum', 'role:superadmin'])->group(function () {
    Route::post('/master/skpd', [SkpdController::class, 'store']);
    Route::put('/master/skpd/{id}', [SkpdController::class, 'update']);
    Route::delete('/master/skpd/{id}', [SkpdController::class, 'destroy']);
});

// Pegawai
Route::get('/master/pegawai', [PegawaiController::class, 'index'])
    ->middleware(['auth:sanctum']);
Route::middleware(['auth:sanctum', 'role:superadmin'])->group(function () {
    Route::post('/master/pegawai', [PegawaiController::class, 'store']);
    Route::put('/master/pegawai/{id}', [PegawaiController::class, 'update']);
    Route::delete('/master/pegawai/{id}', [PegawaiController::class, 'destroy']);
});

Route::get('/master/jenis-kegiatan', [MasterDataController::class, 'jenisKegiatan']);
Route::get('/master/jenis-dokumen', [MasterDataController::class, 'jenisDokumen']);
Route::get('/master/peran', [MasterDataController::class, 'peran']);

Route::get('/dok/{id}',[KepalaBidangController::class, 'aksesDokumen'])
    ->middleware('auth:sanctum');

