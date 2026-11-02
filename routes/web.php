<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\TarikController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\DashboardController;

// ==========================================
// 1. RUTE AUTENTIKASI PUBLIK
// ==========================================
Route::get('/login', function () { return view('auth.login'); })->name('login');
Route::get('/register', function () { return view('auth.register'); });
Route::post('/register', [AuthController::class, 'registerStore'])->middleware('throttle:10,1');
Route::post('/login', [AuthController::class, 'loginProses'])->middleware('throttle:5,1');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ==========================================
// 2. RUTE NASABAH & UMUM (Wajib Login)
// ==========================================
Route::middleware('auth')->group(function () {
    
    Route::get('/', [DashboardController::class, 'index']);
    Route::get('/riwayat', [DashboardController::class, 'riwayat']);

    Route::get('/setor', [TransaksiController::class, 'create']);
    Route::post('/setor', [TransaksiController::class, 'store']);
    Route::get('/tarik', [TarikController::class, 'create']);
    Route::post('/tarik', [TarikController::class, 'store']);
});

// ==========================================
// 3. RUTE KHUSUS ADMIN (Gembok IsAdmin)
// ==========================================
Route::middleware(['auth', \App\Http\Middleware\IsAdmin::class])->group(function () {

    Route::get('/admin', [AdminController::class, 'index']);
    Route::get('/admin/nasabah', [AdminController::class, 'nasabah']);
    Route::get('/admin/nasabah/tambah', [AdminController::class, 'createNasabah']);
    Route::post('/admin/nasabah', [AdminController::class, 'storeNasabah']);
    Route::get('/admin/nasabah/{id}/edit', [AdminController::class, 'editNasabah']);
    Route::post('/admin/nasabah/{id}', [AdminController::class, 'updateNasabah']);
    Route::delete('/admin/nasabah/{id}', [AdminController::class, 'destroyNasabah']);
    
    Route::get('/admin/pengajuan', [AdminController::class, 'pengajuan']);
    Route::post('/admin/pengajuan/{id}/setuju', [AdminController::class, 'setujuiTarik']);
    Route::post('/admin/pengajuan/{id}/tolak', [AdminController::class, 'tolakTarik']);

    Route::post('/admin/pengajuan/setor/{id}/setujui', [AdminController::class, 'setujuiSetor']);
    Route::post('/admin/pengajuan/setor/{id}/tolak', [AdminController::class, 'tolakSetor']);

    Route::get('/admin/laporan', [AdminController::class, 'laporan']);
    Route::get('/admin/laporan/cetak', [AdminController::class, 'cetakLaporan']);
    Route::get('/admin/riwayat', [AdminController::class, 'riwayat']);
    Route::get('/admin/kategori', [KategoriController::class, 'index']);
    Route::get('/admin/kategori/tambah', [KategoriController::class, 'create']);
    Route::post('/admin/kategori', [KategoriController::class, 'store']);
    Route::get('/admin/kategori/{id}/edit', [KategoriController::class, 'edit']);
    Route::post('/admin/kategori/{id}', [KategoriController::class, 'update']);
    Route::delete('/admin/kategori/{id}', [KategoriController::class, 'destroy']);

    
});