<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\zk_client_p6;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/checker', function (Request $request) {
    return response()->json(['message' => 'API Zaky']);
});

Route::resource('biodata', App\Http\Controllers\biodata::class);
Route::resource('bisindo', App\Http\Controllers\BisindoClientController::class);
Route::resource('zk_client_p6', zk_client_p6::class);
