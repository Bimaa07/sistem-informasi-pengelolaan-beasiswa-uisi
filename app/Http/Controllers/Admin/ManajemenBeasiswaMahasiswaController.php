<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Beasiswa;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;

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
}
