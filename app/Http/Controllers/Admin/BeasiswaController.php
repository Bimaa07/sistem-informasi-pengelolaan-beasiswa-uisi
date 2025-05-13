<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Beasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BeasiswaController extends Controller
{
    public function index()
    {
        $beasiswa = Beasiswa::all();
        return view('admin.beasiswa.index', compact('beasiswa'));
    }

    public function create()
    {
        return view('admin.beasiswa.create');
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'nama' => 'required|string|max:255|unique:beasiswa,nama',
                'jenis' => 'required|in:full,ongoing'
            ]);

            DB::beginTransaction();

            Beasiswa::create($validated);

            DB::commit();

            return redirect()
                ->route('admin.beasiswa.index')
                ->with('success', 'Beasiswa berhasil ditambahkan');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    // Remove update method since deskripsi is auto-generated
    public function update(Request $request, Beasiswa $beasiswa)
    {
        try {
            $validated = $request->validate([
                'nama' => 'required|string|max:255|unique:beasiswa,nama,' . $beasiswa->id,
                'jenis' => 'required|in:full,ongoing'
            ]);

            DB::beginTransaction();

            $beasiswa->update($validated);

            DB::commit();

            return redirect()
                ->route('admin.beasiswa.index')
                ->with('success', 'Beasiswa berhasil diperbarui');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function edit(Beasiswa $beasiswa)
    {
        return view('admin.beasiswa.edit', compact('beasiswa'));
    }

    public function destroy(Beasiswa $beasiswa)
    {
        try {
            DB::beginTransaction();
            $beasiswa->delete();
            DB::commit();

            return redirect()
                ->route('admin.beasiswa.index')
                ->with('success', 'Beasiswa berhasil dihapus');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
