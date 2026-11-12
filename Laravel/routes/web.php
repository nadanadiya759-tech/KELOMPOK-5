<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\AuthController;

Route::get('/', [AnggotaController::class, 'index'])->name('anggota.index');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/anggota/tambah', [AnggotaController::class, 'create'])->name('anggota.create');
    Route::post('/anggota', [AnggotaController::class, 'store'])->name('anggota.store');
    Route::get('/anggota/{nomor_kartu}/edit', [AnggotaController::class, 'edit'])->name('anggota.edit');
    Route::put('/anggota/{nomor_kartu}', [AnggotaController::class, 'update'])->name('anggota.update');
    Route::delete('/anggota/{nomor_kartu}', [AnggotaController::class, 'destroy'])->name('anggota.destroy');
});