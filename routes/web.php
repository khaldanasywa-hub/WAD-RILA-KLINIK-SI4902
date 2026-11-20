
<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\RuanganController;
use Illuminate\Support\Facades\Route;

// Halaman utama
Route::redirect('/', '/dokter');

// Login dan logout
Route::middleware('guest')->group(function () {
    // Login
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    // Register
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])
    ->name('register.store');
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// Modul Ruangan Poliklinik
Route::resource('ruangan', RuanganController::class)
    ->except('show')
    ->parameters(['ruangan' => 'ruangan']);

// Semua user yang sudah login boleh melihat daftar dokter
Route::middleware('auth')->group(function () {
    Route::resource('dokter', DokterController::class)->only('index');

    // Modul Katalog Farmasi
    Route::resource('obat', ObatController::class)->except('show');
});

// Hanya admin yang boleh tambah, ubah, dan hapus dokter
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('dokter', DokterController::class)
        ->except(['index', 'show']);
});
