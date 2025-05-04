<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class MahasiswaApiService
{
    protected $baseUrl;
    protected $apiKey;

    public function __construct()
    {
        $this->baseUrl = config('services.mahasiswa_api.url');
        $this->apiKey = config('services.mahasiswa_api.key');
    }

    public function getMahasiswaByEmail($email)
    {
        try {
            $response = Http::timeout(5) // 5 detik timeout
                ->retry(3, 100) // retry 3x dengan jeda 100ms
                ->withHeaders([
                    'Authorization' => 'Bearer ' . $this->apiKey,
                ])
                ->get($this->baseUrl . '/mahasiswa', [
                    'email' => $email
                ]);

            if ($response->successful()) {
                return $response->json()['data'] ?? null;
            }

            Log::warning('API response error: ' . $response->body());
            return null;
        } catch (\Exception $e) {
            Log::error('Error fetching mahasiswa data: ' . $e->getMessage());
            return null;
        }
    }
}
