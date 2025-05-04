<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use App\Services\ImportMahasiswaService;
use Illuminate\Http\Request;

class ManagementMahasiswaController extends Controller
{
    protected $importService;

    public function __construct(ImportMahasiswaService $importService)
    {
        $this->importService = $importService;
    }

    public function index(Request $request)
    {
        $mahasiswas = Mahasiswa::with('user')
            ->when($request->input('search'), function ($query) use ($request) {
                $query->where(function ($query) use ($request) {
                    $query->where('nim', 'like', '%' . $request->input('search') . '%')
                        ->orWhere('nama', 'like', '%' . $request->input('search') . '%')
                        ->orWhere('prodi', 'like', '%' . $request->input('search') . '%');
                });
            })
            ->paginate(10);
        return view('admin.manajemen-mahasiswa.index', compact('mahasiswas'));

        //
    }

    public function import()
    {
        $result = $this->importService->import();

        if ($result['success']) {
            return redirect()
                ->route('admin.manajemen-mahasiswa.index')
                ->with('success', "Berhasil mengimpor {$result['imported']} data mahasiswa");
        }

        return redirect()
            ->route('admin.manajemen-mahasiswa.index')
            ->with('error', $result['message']);
    }
    public function updateScholarshipStatus(Request $request, Mahasiswa $mahasiswa)
    {
        try {
            $validated = $request->validate([
                'penerima_beasiswa_full' => 'required|boolean',
                'jenis_beasiswa_full' => 'nullable|in:aperti_bumn,kip,unggulan'
            ]);

            $mahasiswa->update([
                'penerima_beasiswa_full' => $validated['penerima_beasiswa_full'],
                'jenis_beasiswa_full' => $validated['penerima_beasiswa_full'] ? $validated['jenis_beasiswa_full'] : null
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Status beasiswa berhasil diperbarui',
                'data' => $mahasiswa
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui status beasiswa: ' . $e->getMessage()
            ], 500);
        }
    }
}
