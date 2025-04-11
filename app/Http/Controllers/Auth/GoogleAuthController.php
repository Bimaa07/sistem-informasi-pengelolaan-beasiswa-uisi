<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use App\Models\Role;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{
    /**
     * Redirect to Google OAuth.
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Handle Google OAuth callback.
     */
    public function handleGoogleCallback()
    {
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
                    'password' => bcrypt('password123'), // Default password
                    'role_id' => $studentRole->id, // Atur role sebagai mahasiswa
                ]
            );

            // Jika user baru dibuat, tambahkan ke tabel mahasiswa
            if ($user->wasRecentlyCreated) {
                Mahasiswa::create([
                    'user_id' => $user->id,
                    'nim' => '301211234',
                    'nama' => $user->name,
                    'prodi' => 'Informatika',
                    'penerima_beasiswa_full' => true,
                ]);
            }

            Auth::login($user);
            return redirect('/home')->with('success', 'Login berhasil!');

        } catch (Exception $e) {
            return redirect('/login')->with('error', 'Terjadi kesalahan saat login dengan Google.');
        }
    }
}
