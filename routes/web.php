<?php

use App\Http\Controllers\BuzoController;
use Illuminate\Support\Facades\Route;

Route::get('/', [BuzoController::class, 'index'])->name('buzo.index');
Route::post('/votar', [BuzoController::class, 'votar'])->name('buzo.votar');
