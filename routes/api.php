<?php

use App\Http\Controllers\Api\DummyMahasiswaApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('v1')->group(function () {
    Route::get('/mahasiswa', [DummyMahasiswaApiController::class, 'getMahasiswa']);
    Route::get('/mahasiswa/all', [DummyMahasiswaApiController::class, 'getAllMahasiswa']);
});
