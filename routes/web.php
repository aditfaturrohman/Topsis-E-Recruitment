<?php

use App\Http\Controllers\PelamarController;
use App\Http\Controllers\Admin\LowonganController;
use App\Http\Controllers\Admin\LamaranController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\TopsisController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth; // Penting untuk Auth::routes();


// Halaman Landing Page (Akses Publik)
Route::get('/', function () {
    return view('welcome');
})->name('welcome');


// ROUTE OTENTIKASI LARAVEL UI
// Ini akan membuat route: /login, /register, /logout, /password/reset, dll.
Auth::routes();


// ROUTE UNTUK PELAMAR (BUTUH LOGIN)
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [PelamarController::class, 'dashboard'])->name('pelamar.dashboard');
    Route::get('/lamaran', [PelamarController::class, 'lamaranSaya'])->name('pelamar.lamaranSaya');

    // Route untuk proses melamar lowongan (setelah login)
    // Ingat, kita akan memunculkan modal login/register DULU, baru setelah login user bisa ke form ini.
    Route::get('/lamar/{id}', [PelamarController::class, 'formLamar'])->name('pelamar.formLamar');
    Route::post('/lamar/{id}', [PelamarController::class, 'kirimLamaran'])->name('pelamar.kirimLamaran');
});

// ROUTE UNTUK HALAMAN LOWONGAN (Bisa Diakses Publik atau Pelamar)
// Ini biasanya bisa diakses tanpa login juga, untuk lihat-lihat lowongan
Route::get('/lowongan', [PelamarController::class, 'daftarLowongan'])->name('lowongan.index');
Route::get('/lowongan/{id}', [PelamarController::class, 'detailLowongan'])->name('lowongan.detail');


// ROUTE UNTUK ADMIN (BUTUH LOGIN & ROLE ADMIN)
Route::middleware(['auth', 'auth.admin'])->prefix('admin')->group(function () {
    // Dashboard Admin
    Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // Manajemen Lowongan
    Route::prefix('lowongan')->group(function () {
        Route::get('/', [LowonganController::class, 'index'])->name('admin.lowongan.index');
        Route::get('/create', [LowonganController::class, 'create'])->name('admin.lowongan.create');
        Route::post('/', [LowonganController::class, 'store'])->name('admin.lowongan.store');
        Route::get('/{id}/edit', [LowonganController::class, 'edit'])->name('admin.lowongan.edit');
        Route::put('/{id}', [LowonganController::class, 'update'])->name('admin.lowongan.update');
        Route::delete('/{id}', [LowonganController::class, 'destroy'])->name('admin.lowongan.destroy');
    });

    // Manajemen Lamaran
    Route::prefix('lamaran')->group(function () {
        Route::get('/', [LamaranController::class, 'index'])->name('admin.lamaran.index');
        Route::put('/{id}', [LamaranController::class, 'updateStatus'])->name('admin.lamaran.updateStatus');
    });

    // Manajemen Topsis
    Route::prefix('topsis')->group(function () {
        Route::get('/', [TopsisController::class, 'pilihLowongan'])->name('admin.topsis.pilihLowongan');
        Route::get('/{id}/awal', [TopsisController::class, 'prosesAwal'])->name('admin.topsis.prosesAwal');
        Route::get('/{id}/wawancara', [TopsisController::class, 'formWawancara'])->name('admin.topsis.formWawancara');
        Route::post('/{id}/simpan-wawancara', [TopsisController::class, 'simpanWawancara'])->name('admin.topsis.simpanWawancara');
        Route::get('/{id}/final', [TopsisController::class, 'prosesFinal'])->name('admin.topsis.prosesFinal');
        // Hapus duplikasi route yang ada sebelumnya jika sudah diganti dengan ini.
    });
});