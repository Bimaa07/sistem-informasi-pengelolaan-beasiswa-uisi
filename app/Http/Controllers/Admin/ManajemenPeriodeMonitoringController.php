<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PeriodeMonitoring;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class ManajemenPeriodeMonitoringController extends Controller
{
    /**
     * Display a listing of monitoring periods
     */
    public function index()
    {
        try {
            $periods = PeriodeMonitoring::orderBy('created_at', 'desc')->get();
            return view('admin.periode-monitoring.index', compact('periods'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan dalam memuat data periode monitoring');
        }
    }

    /**
     * Show the form for creating a new monitoring period
     */
    public function create()
    {
        return view('admin.periode-monitoring.create');
    }

    /**
     * Store a newly created monitoring period
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'tahun_ajaran' => 'required|string',
                'semester_akademik' => 'required|in:ganjil,genap',
                'tanggal_mulai' => 'required|date',
                'status' => 'required|in:dibuka,ditutup'
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            DB::beginTransaction();

            PeriodeMonitoring::create([
                'tahun_ajaran' => $request->tahun_ajaran,
                'semester_akademik' => $request->semester_akademik,
                'tanggal_mulai' => $request->tanggal_mulai,
                'status' => $request->status
            ]);

            DB::commit();

            return redirect()->route('admin.periode-monitoring.index')
                ->with('success', 'Periode monitoring berhasil ditambahkan');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan dalam menambahkan periode monitoring')
                ->withInput();
        }
    }

    /**
     * Show the form for editing the specified monitoring period
     */
    public function edit($id)
    {
        try {
            $period = PeriodeMonitoring::findOrFail($id);
            return view('admin.periode-monitoring.edit', compact('period'));
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Periode monitoring tidak ditemukan');
        }
    }

    /**
     * Update the specified monitoring period
     */
    public function update(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'tahun_ajaran' => 'required|string',
                'semester_akademik' => 'required|in:ganjil,genap',
                'tanggal_mulai' => 'required|date',
                'status' => 'required|in:dibuka,ditutup'
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            DB::beginTransaction();

            $period = PeriodeMonitoring::findOrFail($id);
            $period->update([
                'tahun_ajaran' => $request->tahun_ajaran,
                'semester_akademik' => $request->semester_akademik,
                'tanggal_mulai' => $request->tanggal_mulai,
                'status' => $request->status
            ]);

            DB::commit();

            return redirect()->route('admin.periode-monitoring.index')
                ->with('success', 'Periode monitoring berhasil diperbarui');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan dalam memperbarui periode monitoring')
                ->withInput();
        }
    }

    /**
     * Remove the specified monitoring period
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $period = PeriodeMonitoring::findOrFail($id);
            $period->delete();

            DB::commit();

            return redirect()->route('admin.periode-monitoring.index')
                ->with('success', 'Periode monitoring berhasil dihapus');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan dalam menghapus periode monitoring');
        }
    }
}
