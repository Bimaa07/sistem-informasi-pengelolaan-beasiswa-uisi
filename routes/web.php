<?php

use App\Http\Controllers\Admin\BeasiswaController;
use App\Http\Controllers\Admin\ManajemenBeasiswaOngoingController;
use App\Http\Controllers\Auth\GoogleAuthController;
use App\Http\Controllers\Mahasiswa\MonitoringEvaluasiController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

Route::get('/', function () {
    return view('home');
})->middleware('auth');

Route::get('/login', function () {
    return view('auth.login');
})->name('login')->middleware('guest');

Route::get('/auth/google', [GoogleAuthController::class, 'redirectToGoogle'])
    ->name('google.login')
    ->middleware('guest');

Route::get('/auth/google/callback', [GoogleAuthController::class, 'handleGoogleCallback'])
    ->middleware('guest');

Route::get('/home', function () {
    return view('home');
})->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('/monitoring-evaluasi', [MonitoringEvaluasiController::class, 'index'])
        ->name('mahasiswa.monitoring-evaluasi.index');
    Route::post('/monitoring-evaluasi', [MonitoringEvaluasiController::class, 'store'])
        ->name('mahasiswa.monitoring-evaluasi.store');
    Route::get('/monitoring-evaluasi/{id}', [MonitoringEvaluasiController::class, 'show'])
        ->name('mahasiswa.monitoring-evaluasi.show');
});

Route::resource('beasiswa', BeasiswaController::class)->names([
    'index' => 'admin.beasiswa.index',
    'create' => 'admin.beasiswa.create',
    'store' => 'admin.beasiswa.store',
    'edit' => 'admin.beasiswa.edit',
    'update' => 'admin.beasiswa.update',
    'destroy' => 'admin.beasiswa.destroy',
]);

Route::resource('beasiswa-ongoing', ManajemenBeasiswaOngoingController::class)->names([
    'index' => 'admin.beasiswa-ongoing.index',
    'create' => 'admin.beasiswa-ongoing.create',
    'store' => 'admin.beasiswa-ongoing.store',
    'edit' => 'admin.beasiswa-ongoing.edit',
    'update' => 'admin.beasiswa-ongoing.update',
    'destroy' => 'admin.beasiswa-ongoing.destroy',
]);

Route::get('available-scholarships', function () {
    return view('available-scholarship');
})->name('available-scholarship');
Route::get('scholarship-history', function () {
    return view('scholarship-history');
})->name('scholarship-history');

Route::get('/student-notification', function () {
    return view('notification-student');
})->name('notification-student');


Route::middleware(['auth'])->group(function () {
    Route::post('/logout', function () {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect()->route('login')->with('success', 'Anda telah berhasil logout.');
    })->name('logout');
});

require __DIR__ . '/admin/admin-route.php';
