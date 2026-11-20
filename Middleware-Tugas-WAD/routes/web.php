
<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\AuthController;

// Halaman yang dapat dilihat semua orang
Route::get('/', [AreaController::class, 'index'])->name('area.index');

// Login
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])
    ->middleware('throttle:6,1')->name('login.proses');

// Route yang membutuhkan login
Route::middleware('auth')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    
    // Admin dan petugas boleh menambah fasilitas
    Route::get('/area/tambah', [AreaController::class, 'create'])
        ->can('tambah-area')->name('area.create');

    Route::post('/area', [AreaController::class, 'store'])
        ->can('tambah-area')->name('area.store');

    // Admin dan petugas boleh mengedit fasilitas
    Route::get('/area/{area}/edit', [AreaController::class, 'edit'])
        ->can('edit-area')->name('area.edit');

    Route::put('/area/{area}', [AreaController::class, 'update'])
        ->can('edit-area')->name('area.update');

    // Hanya admin boleh menghapus fasilitas
    Route::delete('/area/{area}', [AreaController::class, 'destroy'])
        ->can('hapus-area')->name('area.destroy');
});

// Tes koneksi database
Route::get('/tes-koneksi', function () {
    try {
        DB::connection()->getPdo();
        return 'DB berhasil connect!';
    } catch (\Exception $e) {
        return 'DB gagal connect: ' . $e->getMessage();
    }
});