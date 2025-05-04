<?php

namespace App\Services;

use App\Models\Mahasiswa;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class ImportMahasiswaService
{
    protected $mahasiswaApiService;

    public function __construct(MahasiswaApiService $mahasiswaApiService)
    {
        $this->mahasiswaApiService = $mahasiswaApiService;
    }

    public function import()
    {
        try {
            $response = Http::timeout(5)
                ->get(config('services.mahasiswa_api.url') . '/mahasiswa/all');

            if (!$response->successful()) {
                throw new \Exception('Failed to fetch data from API');
            }

            $mahasiswaData = $response->json()['data'] ?? [];
            $imported = 0;
            $errors = [];

            DB::beginTransaction();

            foreach ($mahasiswaData as $data) {
                try {
                    // Create or update user
                    $user = User::updateOrCreate(
                        ['email' => $data['email']],
                        [
                            'name' => $data['nama'],
                            'password' => Hash::make('password123'), // Default password
                            'role_id' => Role::where('name', 'student')->first()->id
                        ]
                    );

                    // Create or update mahasiswa
                    Mahasiswa::updateOrCreate(
                        ['nim' => $data['nim']],
                        [
                            'user_id' => $user->id,
                            'nama' => $data['nama'],
                            'prodi' => $data['prodi'],
                            'penerima_beasiswa_full' => $data['penerima_beasiswa_full'] ?? false
                        ]
                    );

                    $imported++;
                } catch (\Exception $e) {
                    $errors[] = "Error importing {$data['nim']}: {$e->getMessage()}";
                }
            }

            DB::commit();

            return [
                'success' => true,
                'imported' => $imported,
                'errors' => $errors
            ];
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Import failed: ' . $e->getMessage());

            return [
                'success' => false,
                'message' => 'Import failed: ' . $e->getMessage()
            ];
        }
    }
}
