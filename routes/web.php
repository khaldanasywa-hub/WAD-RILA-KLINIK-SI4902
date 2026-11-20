<?php

use App\Http\Controllers\RuanganController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/ruangan');


Route::resource('ruangan', RuanganController::class)
    ->except('show')
    ->parameters(['ruangan' => 'ruangan']);
