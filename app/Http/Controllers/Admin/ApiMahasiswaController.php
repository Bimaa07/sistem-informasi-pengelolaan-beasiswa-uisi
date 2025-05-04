<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class ApiMahasiswaController extends Controller
{
    public function index()
    {
        try {
            $response = Http::timeout(5)
                ->get(config('services.mahasiswa_api.url') . '/mahasiswa/all');

            if (!$response->successful()) {
                return view('admin.api-mahasiswa.index', [
                    'mahasiswas' => [],
                    'error' => 'Failed to fetch data from API'
                ]);
            }

            $mahasiswas = $response->json()['data'] ?? [];

            return view('admin.api-mahasiswa.index', [
                'mahasiswas' => $mahasiswas
            ]);
        } catch (\Exception $e) {
            return view('admin.api-mahasiswa.index', [
                'mahasiswas' => [],
                'error' => 'Error: ' . $e->getMessage()
            ]);
        }
    }
}
