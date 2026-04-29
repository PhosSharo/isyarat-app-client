<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\zk_client_p6;
use App\Http\Controllers\BisindoClientController;

Route::get('/', [BisindoClientController::class, 'index'])->name('bisindo.dashboard');
Route::post('/store', [BisindoClientController::class, 'store'])->name('bisindo.store');

// Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('zk_client_p6', zk_client_p6::class);
