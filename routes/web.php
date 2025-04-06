<?php

use App\Http\Controllers\Auth\AdminAuthenticationController;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

Route::get('/', function () {
    return view('home');
})->middleware('auth');

Route::get('/login', function () {
    return view('auth.login');
})->name('login')->middleware('guest');

Route::get('/auth/google', function () {
    return Socialite::driver('google')->redirect();
})->name('google.login')->middleware('guest');

Route::get('/auth/google/callback', function () {
    try {
        $googleUser = Socialite::driver('google')->user();
        $studentRole = Role::where('name', 'student')->first();

        // Cari atau buat user berdasarkan email Google
        $user = User::updateOrCreate(
            ['email' => $googleUser->getEmail()],
            [
                'name' => $googleUser->getName(),
                'google_id' => $googleUser->getId(),
                'avatar' => $googleUser->getAvatar(),
                'password' => bcrypt('password123'), // Default password (bisa diubah)
                'role_id' => $studentRole, // Atur role sesuai kebutuhan
            ]
        );

        Auth::login($user);
        return redirect('/home'); // Redirect setelah login sukses

    } catch (Exception $e) {
        return redirect('/login')->with('error', 'Terjadi kesalahan saat login dengan Google.');
    }
})->middleware('guest');

Route::get('/home', function () {
    return view('home');
})->name('home');

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

Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminAuthenticationController::class, 'showLoginForm'])
        ->name('admin.login');
    Route::post('/login', [AdminAuthenticationController::class, 'login'])
        ->name('admin.login.submit');
    Route::post('/logout', [AdminAuthenticationController::class, 'logout'])
        ->name('admin.logout');

    // Protected admin routes
    Route::middleware(['auth', 'role:admin'])->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('admin.dashboard');
    });
});
