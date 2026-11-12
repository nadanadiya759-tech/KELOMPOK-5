<?php

use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// Publik: boleh dibuka tanpa login
Route::get('/', [AnggotaController::class, 'index'])->name('anggota.index');

// Hanya untuk yang BELUM login (halaman login)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.proses');
});

// Hanya untuk yang SUDAH login
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Gate: khusus anggota yang punya kartu
    Route::get('/kartu-saya', [AnggotaController::class, 'kartuSaya'])
        ->name('anggota.kartu-saya')
        ->can('kartu-saya');

    // Policy: admin (siapa pun) atau anggota (kartu sendiri)
    Route::get('/anggota/{anggota}/cetak', [AnggotaController::class, 'cetak'])
        ->name('anggota.cetak')
        ->can('cetak', 'anggota');

    // Di dalam auth: dibatasi lagi berdasarkan peran
    Route::middleware('role:admin')->group(function () {
        // Gate
        Route::get('/anggota/tambah', [AnggotaController::class, 'create'])
            ->name('anggota.create')
            ->can('kelola-anggota');
        Route::post('/anggota', [AnggotaController::class, 'store'])
            ->name('anggota.store')
            ->can('kelola-anggota');

        // Policy
        Route::get('/anggota/{anggota}/edit', [AnggotaController::class, 'edit'])
            ->name('anggota.edit')
            ->can('update', 'anggota');
        Route::put('/anggota/{anggota}', [AnggotaController::class, 'update'])
            ->name('anggota.update')
            ->can('update', 'anggota');
        Route::delete('/anggota/{anggota}', [AnggotaController::class, 'destroy'])
            ->name('anggota.destroy')
            ->can('delete', 'anggota');
    });
});