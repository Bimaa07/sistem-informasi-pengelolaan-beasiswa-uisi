<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Beasiswa;
use App\Models\PeriodeMonitoring;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ManajemenPeriodeMonitoringController extends Controller
{
    public function index(Request $request)
    {
        $query = PeriodeMonitoring::with(['beasiswa']);

        if ($request->has('beasiswa_id')) {
            $query->where('beasiswa_id', $request->beasiswa_id);
        }

        $periodeMonitoring = $query->latest()->paginate(10);
        $beasiswa = Beasiswa::all();

        return view('admin.periode-monitoring.index', compact('periodeMonitoring', 'beasiswa'));
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'beasiswa_id' => 'required|exists:beasiswa,id',
                'tahun_ajaran' => [
                    'required',
                    'string',
                    'regex:/^\d{4}\/\d{4}$/', // Format: "2024/2025"
                ],
                'semester' => 'required|in:ganjil,genap',
                'status' => 'required|in:aktif,nonaktif'
            ]);

            // Validate that end year is start year + 1
            $tahunAwal = (int) substr($validated['tahun_ajaran'], 0, 4);
            $tahunAkhir = (int) substr($validated['tahun_ajaran'], 5, 4);

            if ($tahunAkhir !== $tahunAwal + 1) {
                throw new \Exception('Format tahun ajaran tidak valid. Tahun akhir harus tahun awal + 1');
            }

            DB::beginTransaction();
            $periodeMonitoring = PeriodeMonitoring::create($validated);
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Periode monitoring berhasil ditambahkan',
                'data' => $periodeMonitoring
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy(PeriodeMonitoring $periodeMonitoring)
    {
        try {
            DB::beginTransaction();
            $periodeMonitoring->delete();
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Periode monitoring berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function edit(PeriodeMonitoring $periodeMonitoring)
    {
        return response()->json([
            'success' => true,
            'data' => $periodeMonitoring
        ]);
    }

    public function update(Request $request, PeriodeMonitoring $periodeMonitoring)
    {
        try {
            $validated = $request->validate([
                'beasiswa_id' => 'required|exists:beasiswa,id',
                'tahun_ajaran' => [
                    'required',
                    'string',
                    'regex:/^\d{4}\/\d{4}$/', // Format: "2024/2025"
                ],
                'semester' => 'required|in:ganjil,genap',
                'status' => 'required|in:aktif,nonaktif',
            ]);

            DB::beginTransaction();

            $periodeMonitoring->update($validated);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Periode monitoring berhasil diperbarui',
                'data' => $periodeMonitoring
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
