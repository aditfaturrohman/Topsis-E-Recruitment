<?php

use App\Http\Controllers\PelamarController;
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [PelamarController::class, 'dashboard']);
// Route::get('/', [PelamarController::class, 'dashboard']);
Route::get('/lowongan', [PelamarController::class, 'daftarLowongan']);
Route::get('/lowongan/{id}', [PelamarController::class, 'detailLowongan']);
Route::get('/lamar/{id}', [PelamarController::class, 'formLamar']);
Route::post('/lamar/{id}', [PelamarController::class, 'kirimLamaran']);

use App\Http\Controllers\Admin\LowonganController;

Route::prefix('admin/lowongan')->group(function () {
    Route::get('/', [LowonganController::class, 'index']);
    Route::get('/create', [LowonganController::class, 'create']);
    Route::post('/', [LowonganController::class, 'store']);
    Route::get('/{id}/edit', [LowonganController::class, 'edit']);
    Route::put('/{id}', [LowonganController::class, 'update']);
    Route::delete('/{id}', [LowonganController::class, 'destroy']);
});

use App\Http\Controllers\Admin\LamaranController;

Route::prefix('admin/lamaran')->group(function () {
    Route::get('/', [LamaranController::class, 'index']);
    Route::put('/{id}', [LamaranController::class, 'updateStatus']);
});

use App\Http\Controllers\Admin\AdminController;

Route::get('/admin', [AdminController::class, 'dashboard']);

use App\Http\Controllers\Admin\TopsisController;

Route::get('/admin/topsis', [TopsisController::class, 'pilihLowongan']);
Route::get('/admin/topsis/{id}/awal', [TopsisController::class, 'prosesAwal']);
Route::get('/admin/topsis/{id}/wawancara', [TopsisController::class, 'formWawancara']);
Route::post('/admin/topsis/{id}/wawancara', [TopsisController::class, 'simpanWawancara']);
Route::get('/admin/topsis/{id}/final', [TopsisController::class, 'prosesFinal']);


Route::get('/admin/topsis/{id}/input-wawancara', [TopsisController::class, 'formWawancara']);
Route::post('/admin/topsis/{id}/simpan-wawancara', [TopsisController::class, 'simpanWawancara']);

Route::get('/admin/topsis/{id}/final', [TopsisController::class, 'hasilFinal']);

Route::get('/dashboard', [PelamarController::class, 'dashboard']);
Route::get('/lamaran', [PelamarController::class, 'lamaranSaya']);
Route::get('/admin/topsis/{id}/final', [TopsisController::class, 'hasilFinal']);
