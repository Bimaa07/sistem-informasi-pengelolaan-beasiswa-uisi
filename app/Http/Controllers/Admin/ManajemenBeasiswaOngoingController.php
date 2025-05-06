<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Beasiswa;
use App\Models\PendaftaranBeasiswaOngoing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ManajemenBeasiswaOngoingController extends Controller
{
    public function index()
    {
        $beasiswaOngoing = PendaftaranBeasiswaOngoing::with('beasiswa')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.beasiswa-ongoing.index', compact('beasiswaOngoing'));
    }

    public function create()
    {
        $beasiswa = Beasiswa::all();
        return view('admin.beasiswa-ongoing.create', compact('beasiswa'));
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'beasiswa_id' => 'required|exists:beasiswa,id',
                'tanggal_mulai' => 'required|date',
                'tanggal_selesai' => 'required|date|after:tanggal_mulai',
                'tahun_ajaran' => 'required|string',
                'content' => 'required|string',
                'status' => 'required|in:aktif,nonaktif,ditutup'
            ]);

            DB::beginTransaction();

            PendaftaranBeasiswaOngoing::create($validated);

            DB::commit();

            return redirect()
                ->route('admin.beasiswa-ongoing.index')
                ->with('success', 'Beasiswa ongoing berhasil dibuat');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $beasiswaOngoing = PendaftaranBeasiswaOngoing::findOrFail($id);
        $beasiswa = Beasiswa::all();
        return view('admin.beasiswa-ongoing.edit', compact('beasiswaOngoing', 'beasiswa'));
    }

    public function update(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'beasiswa_id' => 'required|exists:beasiswa,id',
                'tanggal_mulai' => 'required|date',
                'tanggal_selesai' => 'required|date|after:tanggal_mulai',
                'tahun_ajaran' => 'required|string',
                'content' => 'required|string',
                'status' => 'required|in:aktif,nonaktif,ditutup'
            ]);

            DB::beginTransaction();

            $beasiswaOngoing = PendaftaranBeasiswaOngoing::findOrFail($id);
            $beasiswaOngoing->update($validated);

            DB::commit();

            return redirect()
                ->route('admin.beasiswa-ongoing.index')
                ->with('success', 'Beasiswa ongoing berhasil diperbarui');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $beasiswaOngoing = PendaftaranBeasiswaOngoing::findOrFail($id);
            $beasiswaOngoing->delete();

            DB::commit();

            return redirect()
                ->route('admin.beasiswa-ongoing.index')
                ->with('success', 'Beasiswa ongoing berhasil dihapus');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
