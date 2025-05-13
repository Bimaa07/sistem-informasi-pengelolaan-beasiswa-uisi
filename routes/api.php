<?php

use App\Http\Controllers\Admin\ApiMahasiswaController;
use App\Http\Controllers\Api\DummyMahasiswaApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
