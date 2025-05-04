<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use App\Models\Role;
use App\Models\User;
use App\Services\MahasiswaApiService;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{
    protected $mahasiswaApiService;

    public function __construct(MahasiswaApiService $mahasiswaApiService)
    {
        $this->mahasiswaApiService = $mahasiswaApiService;
    }
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
                    'password' => bcrypt('password123'),
                    'role_id' => $studentRole->id,
                ]
            );

            // Jika user baru dibuat, cek data mahasiswa dari API
            if ($user->wasRecentlyCreated || !$user->mahasiswa) {
                $mahasiswaData = $this->mahasiswaApiService->getMahasiswaByEmail($user->email);
                Log::debug($mahasiswaData);

                if ($mahasiswaData) {
                    // Simpan atau update data mahasiswa
                    Mahasiswa::updateOrCreate(
                        ['user_id' => $user->id],
                        [
                            'nim' => $mahasiswaData['nim'],
                            'nama' => $mahasiswaData['nama'],
                            'prodi' => $mahasiswaData['prodi'],
                            'penerima_beasiswa_full' => $mahasiswaData['penerima_beasiswa_full'] ?? false,
                        ]
                    );
                } else {
                    // Jika data API tidak ditemukan, redirect ke halaman lengkapi profil
                    Auth::login($user);
                    return redirect()->route('home')
                        ->with('warning', 'Silakan lengkapi data profil Anda.');
                }
            }

            Auth::login($user);
            return redirect('/home')->with('success', 'Login berhasil!');
        } catch (Exception $e) {
            Log::error('Google Auth Error: ' . $e->getMessage());
            return redirect('/login')
                ->with('error', 'Terjadi kesalahan saat login dengan Google.');
        }
    }
}
