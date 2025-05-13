<?php

use App\Http\Controllers\Admin\ApiMahasiswaController;
use App\Http\Controllers\Admin\BeasiswaController;
use App\Http\Controllers\Admin\ManagementMahasiswaController;
use App\Http\Controllers\Admin\ManajemenBeasiswaController;
use App\Http\Controllers\Admin\ManajemenBeasiswaMahasiswaController;
use App\Http\Controllers\Admin\ManajemenPeriodeMonitoringController;
use App\Http\Controllers\Admin\UserManagementController;
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
    Route::get('/api-mahasiswa', [ManagementMahasiswaController::class, 'index'])
        ->name('admin.api-mahasiswa.index');

    // Protected Admin Routes
    Route::middleware(['auth', 'role:admin'])->group(function () {
        Route::resource('users', UserManagementController::class)
            ->except(['show', 'create', 'edit'])
            ->names([
                'index' => 'admin.users.index',
                'store' => 'admin.users.store',
                'update' => 'admin.users.update',
                'destroy' => 'admin.users.destroy',
            ]);

        Route::get('/', function () {
            return redirect()->route('admin.dashboard');
        })->name('admin.home');
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('admin.dashboard');



        Route::get('/manajemen-mahasiswa', [ManagementMahasiswaController::class, 'index'])
            ->name('admin.manajemen-mahasiswa.index');
        Route::post('/manajemen-mahasiswa/import', [ManagementMahasiswaController::class, 'import'])
            ->name('admin.manajemen-mahasiswa.import');
        Route::post('/manajemen-mahasiswa/store', [ManagementMahasiswaController::class, 'store'])
            ->name('admin.manajemen-mahasiswa.store');

        Route::get('/manajemen-beasiswa-mahasiswa', [ManajemenBeasiswaMahasiswaController::class, 'index'])
            ->name('admin.manajemen-beasiswa-mahasiswa.index');

        Route::post('/manajemen-beasiswa-mahasiswa/store', [ManajemenBeasiswaMahasiswaController::class, 'store'])
            ->name('admin.manajemen-beasiswa-mahasiswa.store');

        Route::resource('beasiswa', BeasiswaController::class)->names([
            'index' => 'admin.beasiswa.index',
            'create' => 'admin.beasiswa.create',
            'store' => 'admin.beasiswa.store',
            'show' => 'admin.beasiswa.show',
            'edit' => 'admin.beasiswa.edit',
            'update' => 'admin.beasiswa.update',
            'destroy' => 'admin.beasiswa.destroy',
        ]);


        Route::resource('periode-monitoring', ManajemenPeriodeMonitoringController::class)
            ->except(['create', 'edit', 'update', 'show'])
            ->names([
                'index' => 'admin.periode-monitoring.index',
                'store' => 'admin.periode-monitoring.store',
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
