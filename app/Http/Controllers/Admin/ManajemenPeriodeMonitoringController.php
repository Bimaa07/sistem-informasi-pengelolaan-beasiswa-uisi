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
                'tahun_ajaran' => 'required|string',
                'semester' => 'required|in:ganjil,genap',
                'status' => 'required|in:aktif,nonaktif',
                'tahun' => 'required|integer'
            ]);

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
}
