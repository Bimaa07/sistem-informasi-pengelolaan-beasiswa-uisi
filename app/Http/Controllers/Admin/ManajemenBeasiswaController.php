<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Beasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ManajemenBeasiswaController extends Controller
{
    /**
     * Display a listing of scholarships
     */
    public function index()
    {
        $beasiswa = Beasiswa::latest()->paginate(10);
        return view('admin.beasiswa.index', compact('beasiswa'));
    }

    /**
     * Show the form for creating a new scholarship
     */
    public function create()
    {
        return view('admin.beasiswa.create');
    }

    /**
     * Store a newly created scholarship
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'status' => 'required|in:aktif,nonaktif,ditutup',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after:tanggal_mulai',
            'tahun_ajaran' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        Beasiswa::create($request->all());

        return redirect()
            ->route('admin.beasiswa.index')
            ->with('success', 'Beasiswa berhasil ditambahkan');
    }

    /**
     * Display the specified scholarship
     */
    public function show(Beasiswa $beasiswa)
    {
        return view('admin.beasiswa.show', compact('beasiswa'));
    }

    /**
     * Show the form for editing the specified scholarship
     */
    public function edit(Beasiswa $beasiswa)
    {
        return view('admin.beasiswa.edit', compact('beasiswa'));
    }

    /**
     * Update the specified scholarship
     */
    public function update(Request $request, Beasiswa $beasiswa)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'status' => 'required|in:aktif,nonaktif,ditutup',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after:tanggal_mulai',
            'tahun_ajaran' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $beasiswa->update($request->all());

        return redirect()
            ->route('admin.beasiswa.index')
            ->with('success', 'Beasiswa berhasil diperbarui');
    }

    /**
     * Remove the specified scholarship
     */
    public function destroy(Beasiswa $beasiswa)
    {
        $beasiswa->delete();

        return redirect()
            ->route('admin.beasiswa.index')
            ->with('success', 'Beasiswa berhasil dihapus');
    }
}
