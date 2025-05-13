<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Beasiswa;
use App\Models\Mahasiswa;
use App\Models\PenerimaBeasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ManajemenBeasiswaMahasiswaController extends Controller
{
    public function index(Request $request)
    {
        $query = Mahasiswa::with(['user']);

        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nim', 'like', "%{$search}%")
                    ->orWhere('nama', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $mahasiswa = $query->paginate(10);
        $beasiswa = Beasiswa::all();

        return view('admin.manajemen-beasiswa-mahasiswa.index', compact('mahasiswa', 'beasiswa'));
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'mahasiswa_id' => 'required|exists:mahasiswa,id',
                'beasiswa_id' => 'required|exists:beasiswa,id',
                'keterangan' => 'nullable|string'
            ]);

            // Check if student already has active scholarship
            $existingBeasiswa = PenerimaBeasiswa::where('mahasiswa_id', $validated['mahasiswa_id'])
                ->where('status', 'aktif')
                ->first();

            if ($existingBeasiswa) {
                return response()->json([
                    'success' => false,
                    'message' => 'Mahasiswa sudah terdaftar pada beasiswa lain yang masih aktif.'
                ], 422);
            }

            DB::beginTransaction();

            $penerimaBeasiswa = PenerimaBeasiswa::create([
                'mahasiswa_id' => $validated['mahasiswa_id'],
                'beasiswa_id' => $validated['beasiswa_id'],
                'status' => 'aktif',
                'keterangan' => $validated['keterangan'] ?? null
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Mahasiswa berhasil didaftarkan ke beasiswa',
                'data' => $penerimaBeasiswa
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function nonaktif(PenerimaBeasiswa $penerimaBeasiswa)
    {
        try {
            DB::beginTransaction();

            $penerimaBeasiswa->update([
                'status' => 'nonaktif'
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Status beasiswa berhasil dinonaktifkan'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
    public function aktif(PenerimaBeasiswa $penerimaBeasiswa)
    {
        try {
            // Check if student has other active scholarship
            $existingActive = PenerimaBeasiswa::where('mahasiswa_id', $penerimaBeasiswa->mahasiswa_id)
                ->where('id', '!=', $penerimaBeasiswa->id)
                ->where('status', 'aktif')
                ->exists();

            if ($existingActive) {
                return response()->json([
                    'success' => false,
                    'message' => 'Mahasiswa sudah memiliki beasiswa aktif lainnya'
                ], 422);
            }

            DB::beginTransaction();

            $penerimaBeasiswa->update([
                'status' => 'aktif'
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Status beasiswa berhasil diaktifkan kembali'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
}
