
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ObatController;

Route::get('/', [ObatController::class, 'index'])->name('obat.index');

Route::get('/obat/tambah', [ObatController::class, 'create'])->name('obat.create');

Route::post('/obat', [ObatController::class, 'store'])->name('obat.store');

Route::get('/obat/edit/{id}', [ObatController::class, 'edit'])->name('obat.edit');

Route::put('/obat/{id}', [ObatController::class, 'update'])->name('obat.update');

Route::delete('/obat/{id}', [ObatController::class, 'destroy'])->name('obat.destroy');
