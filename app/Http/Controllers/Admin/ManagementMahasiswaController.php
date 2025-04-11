<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class ManagementMahasiswaController extends Controller
{
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


}
