<?php

use App\Http\Controllers\Api\AnggotaApiController;
use Illuminate\Support\Facades\Route;

// TAMU: daftar ringkas (nama + tipe) tanpa login
Route::get('/anggota', [AnggotaApiController::class, 'index']);

// butuh login (HTTP Basic: username + password)
Route::middleware('api.basic')->group(function () {
    // admin = semua, anggota = cuma datanya sendiri (dicek di controller)
    Route::get('/anggota/{anggota}', [AnggotaApiController::class, 'show']);

    // admin only
    Route::middleware('role:admin')->group(function () {
        Route::post('/anggota', [AnggotaApiController::class, 'store']);
        Route::put('/anggota/{anggota}', [AnggotaApiController::class, 'update']);
        Route::delete('/anggota/{anggota}', [AnggotaApiController::class, 'destroy']);
    });
});
