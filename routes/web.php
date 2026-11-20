
<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\RuanganController;
use Illuminate\Support\Facades\Route;

// Halaman utama
Route::redirect('/', '/dokter');

// Login dan logout
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// Modul Ruangan Poliklinik dari main
Route::resource('ruangan', RuanganController::class)
    ->except('show')
    ->parameters(['ruangan' => 'ruangan']);

// Semua user yang sudah login boleh melihat daftar dokter
Route::middleware('auth')->group(function () {
    Route::resource('dokter', DokterController::class)->only('index');
});

// Hanya admin yang boleh tambah, ubah, dan hapus dokter
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('dokter', DokterController::class)
        ->except(['index', 'show']);
});
