<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\PeriodeMonitoring;
use App\Models\MonitoringEvaluasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MonitoringEvaluasiController extends Controller
{

    /**
     * Display monitoring evaluation page
     */
    public function index()
    {
        try {
            $activePeriod = PeriodeMonitoring::where('status', 'dibuka')->first();

            if (!$activePeriod) {
                return view('mahasiswa.monitoring-evaluasi.index', [
                    'message' => 'Tidak ada periode monitoring yang aktif saat ini.'
                ]);
            }

            $mahasiswa = Auth::user()->mahasiswa;
            $monitoringEvaluasi = MonitoringEvaluasi::where('mahasiswa_id', $mahasiswa->id)
                ->where('periode_monitoring_id', $activePeriod->id)
                ->first();

            return view('mahasiswa.monitoring-evaluasi.index', compact('activePeriod', 'monitoringEvaluasi'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan dalam memuat data monitoring evaluasi');
        }
    }

    /**
     * Store monitoring evaluation data
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'ips' => 'required|numeric|min:0|max:4',
                'ipk' => 'required|numeric|min:0|max:4',
                'semester' => 'required|integer|min:1|max:8',
                'file_khs' => 'required|file|mimes:pdf|max:2048',
                'file_sertifikat' => 'nullable|file|mimes:pdf|max:2048',
            ]);

            $activePeriod = PeriodeMonitoring::where('status', 'dibuka')->firstOrFail();
            $mahasiswa = Auth::user()->mahasiswa;

            // Check if already submitted
            $existing = MonitoringEvaluasi::where('mahasiswa_id', $mahasiswa->id)
                ->where('periode_monitoring_id', $activePeriod->id)
                ->first();

            if ($existing) {
                return redirect()->back()->with('error', 'Anda sudah mengisi monitoring evaluasi untuk periode ini');
            }

            // Handle file uploads
            $khsPath = $request->file('file_khs')->store('monitoring-evaluasi/khs');
            $sertifikatPath = null;
            if ($request->hasFile('file_sertifikat')) {
                $sertifikatPath = $request->file('file_sertifikat')->store('monitoring-evaluasi/sertifikat');
            }

            // Create monitoring evaluasi
            MonitoringEvaluasi::create([
                'mahasiswa_id' => $mahasiswa->id,
                'periode_monitoring_id' => $activePeriod->id,
                'ips' => $request->ips,
                'ipk' => $request->ipk,
                'semester' => $request->semester,
                'file_khs' => $khsPath,
                'file_sertifikat' => $sertifikatPath,
                'status' => 'menunggu',
            ]);

            return redirect()->route('mahasiswa.monitoring-evaluasi.index')
                ->with('success', 'Data monitoring evaluasi berhasil dikirim');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan dalam mengirim data monitoring evaluasi')
                ->withInput();
        }
    }

    /**
     * Show monitoring evaluation detail
     */
    public function show($id)
    {
        try {
            $mahasiswa = Auth::user()->mahasiswa;
            $monitoringEvaluasi = MonitoringEvaluasi::where('mahasiswa_id', $mahasiswa->id)
                ->where('id', $id)
                ->firstOrFail();

            return view('mahasiswa.monitoring-evaluasi.show', compact('monitoringEvaluasi'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Data monitoring evaluasi tidak ditemukan');
        }
    }
}
