<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DummyMahasiswaApiController extends Controller
{
    private $dummyData = [
        'informatika@student.uisi.ac.id' => [
            'nim' => '3012201001',
            'nama' => 'Mahasiswa Informatika',
            'prodi' => 'Informatika',
            'semester' => 6,
            'angkatan' => 2020,
            'email' => 'sistem.informasi@student.uisi.ac.id',
            'status' => 'Aktif'
        ],
        'sistem.informasi@student.uisi.ac.id' => [
            'nim' => '3022201002',
            'nama' => 'Mahasiswa Sistem Informasi',
            'prodi' => 'Sistem Informasi',
            'semester' => 4,
            'email' => 'sistem.informasi@student.uisi.ac.id',
            'angkatan' => 2021,
            'status' => 'Aktif'
        ],
        'rafli.setiawan21@student.uisi.ac.id' => [
            'nim' => '3022201002',
            'nama' => 'Mahasiswa Sistem Informasi',
            'prodi' => 'Sistem Informasi',
            'semester' => 4,
            'email' => 'sistem.informasi@student.uisi.ac.id',
            'angkatan' => 2021,
            'status' => 'Aktif'
        ],
    ];

    public function getMahasiswa(Request $request)
    {
        // Reduce delay to 100ms
        usleep(100000);

        // Validate API key
        if ($request->header('Authorization') !== 'Bearer ' . config('services.mahasiswa_api.key')) {
            return response()->json([
                'error' => 'Unauthorized',
                'message' => 'Invalid API key'
            ], 401);
        }

        $email = $request->query('email');

        if (!$email) {
            return response()->json([
                'error' => 'Bad Request',
                'message' => 'Email parameter is required'
            ], 400);
        }

        // Check if email exists in dummy data
        if (array_key_exists($email, $this->dummyData)) {
            return response()->json([
                'status' => 'success',
                'data' => $this->dummyData[$email]
            ], 200);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Mahasiswa not found'
        ], 404);
    }

    public function getAllMahasiswa()
    {
        // Simulate small delay
        usleep(100000);

        return response()->json([
            'status' => 'success',
            'data' => array_values($this->dummyData)
        ], 200);
    }
}
