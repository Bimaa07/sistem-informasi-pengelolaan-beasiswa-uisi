<?php

use App\Http\Controllers\Admin\ManagementMahasiswaController;
use App\Http\Controllers\Admin\ManajemenBeasiswaController;
use App\Http\Controllers\Admin\ManajemenPeriodeMonitoringController;
use App\Http\Controllers\Auth\AdminAuthenticationController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Admin Authentication Routes
Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminAuthenticationController::class, 'showLoginForm'])
        ->name('admin.login');
    Route::post('/login', [AdminAuthenticationController::class, 'login'])
        ->name('admin.login.submit');
    Route::post('/logout', [AdminAuthenticationController::class, 'logout'])
        ->name('admin.logout');

    // Protected Admin Routes
    Route::middleware(['auth', 'role:admin'])->group(function () {
        Route::get('/', function () {
            return redirect()->route('admin.dashboard');
        })->name('admin.home');
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('admin.dashboard');

        Route::get('/manajemen-mahasiswa', [ManagementMahasiswaController::class,'index'])->name('admin.manajemen-mahasiswa.index');

        Route::resource('beasiswa', ManajemenBeasiswaController::class)->names([
            'index' => 'admin.beasiswa.index',
            'create' => 'admin.beasiswa.create',
            'store' => 'admin.beasiswa.store',
            'show' => 'admin.beasiswa.show',
            'edit' => 'admin.beasiswa.edit',
            'update' => 'admin.beasiswa.update',
            'destroy' => 'admin.beasiswa.destroy',
        ]);


        Route::resource('periode-monitoring', ManajemenPeriodeMonitoringController::class)->names([
            'index' => 'admin.periode-monitoring.index',
            'create' => 'admin.periode-monitoring.create',
            'store' => 'admin.periode-monitoring.store',
            'edit' => 'admin.periode-monitoring.edit',
            'update' => 'admin.periode-monitoring.update',
            'destroy' => 'admin.periode-monitoring.destroy',
        ]);

        Route::get('/registered-scholarships', function () {
            return view('admin.registered-scholarships');
        })->name('admin.registered-scholarships');

        Route::get('/announcement-management', function () {
            return view('admin.announcement-management');
        })->name('admin.announcement-management');

        Route::get('/statistics', function () {
            return view('admin.statistics');
        })->name('admin.statistics');
    });

    Route::post('/logout-admin', function () {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect()->route('admin.login')->with('success', 'Anda telah berhasil logout.');
    })->name('admin.logout-admin');
});
