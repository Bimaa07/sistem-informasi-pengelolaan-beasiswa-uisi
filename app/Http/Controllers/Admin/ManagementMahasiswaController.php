<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ManagementMahasiswaController extends Controller
{
    private $apiUrl;
    private $apiToken;
    private $maxRetries = 10; // Maximum number of retry attempts

    public function __construct()
    {
        $this->apiUrl = config('services.mahasiswa_api.url');
        $this->apiToken = config('services.mahasiswa_api.token');
    }
    public function index()
    {
        $mahasiswa = Mahasiswa::with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.manajemen-mahasiswa.index', compact('mahasiswa'));
    }

    public function import(Request $request)
    {
        try {
            $request->validate([
                'nim' => 'required|string|size:10'
            ]);

            $attempts = 0;

            do {
                $attempts++;
                $response = $this->makeApiRequest($request->nim);

                if (!$response->successful()) {
                    Log::error('API Mahasiswa Error', [
                        'status' => $response->status(),
                        'body' => $response->body(),
                        'attempt' => $attempts
                    ]);

                    return response()->json([
                        'success' => false,
                        'message' => 'Failed to fetch student data'
                    ], 500);
                }

                $data = $response->json();
                $result = $data['query_result']['data'] ?? [];

                // If we got data, break the loop
                if (!empty($result)) {
                    break;
                }

                // Log empty response attempt
                Log::info('Empty API response, retrying...', [
                    'attempt' => $attempts,
                    'nim' => $request->nim
                ]);

                // Add a small delay between retries
                if ($attempts < $this->maxRetries) {
                    sleep(1);
                }
            } while ($attempts < $this->maxRetries);

            // If we still have no data after all retries
            if (empty($result)) {
                Log::warning('API returned empty data after all retries', [
                    'nim' => $request->nim,
                    'attempts' => $attempts
                ]);
            }

            return response()->json([
                'success' => true,
                'data' => $result['rows'][0],
                'attempts' => $attempts
            ]);
        } catch (\Exception $e) {
            Log::error('API Mahasiswa Exception', [
                'message' => $e->getMessage(),
                'nim' => $request->nim
            ]);

            return response()->json([
                'success' => false,
                'message' => 'An error occurred while fetching student data'
            ], 500);
        }
    }


    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'nim' => 'required|string|size:10|unique:mahasiswa,nim',
                'nama' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'program_studi' => 'required|string',
                'tahun_masuk' => 'required|string'
            ]);

            DB::beginTransaction();

            $user = null;
            // Convert checkbox "on" value to boolean
            $createUser = $request->input('create_user') === 'on';

            if ($createUser) {
                $user = User::create([
                    'name' => $validated['nama'],
                    'email' => $validated['email'],
                    'role_id' => 1, // Mahasiswa role
                ]);
            }

            $mahasiswa = Mahasiswa::create([
                'nim' => $validated['nim'],
                'nama' => $validated['nama'],
                'email' => $validated['email'],
                'program_studi' => $validated['program_studi'],
                'tahun_masuk' => $validated['tahun_masuk'],
                'user_id' => $user ? $user->id : null
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Data mahasiswa berhasil disimpan',
                'data' => $mahasiswa
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Store Mahasiswa Error', [
                'message' => $e->getMessage(),
                'data' => $request->all()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menyimpan data'
            ], 500);
        }
    }

    private function makeApiRequest(string $nim)
    {
        return Http::withOptions([
            'verify' => false
        ])->withHeaders([
            'authorization' => $this->apiToken,
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'X-Requested-With' => 'XMLHttpRequest'
        ])->timeout(5)->post($this->apiUrl, [
            'apply_auto_limit' => false,
            'max_age' => 10,
            'parameters' => [
                'NIM' => $nim
            ]
        ]);
    }
}
