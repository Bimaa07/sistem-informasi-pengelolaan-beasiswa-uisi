@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="mt-4">Manajemen Beasiswa Ongoing</h1>
            <a href="{{ route('admin.beasiswa-ongoing.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Beasiswa
            </a>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <div class="card mb-4">
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Jenis Beasiswa</th>
                            <th>Status</th>
                            <th>Tahun Ajaran</th>
                            <th>Tanggal Mulai</th>
                            <th>Tanggal Selesai</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($beasiswaOngoing as $item)
                            <tr>
                                <td>{{ $item->beasiswa->getNamaBeasiswaLabel() }}</td>
                                <td>
                                    <span
                                        class="badge bg-{{ $item->status === 'aktif' ? 'success' : ($item->status === 'nonaktif' ? 'warning' : 'danger') }}">
                                        {{ ucfirst($item->status) }}
                                    </span>
                                </td>
                                <td>{{ $item->tahun_ajaran }}</td>
                                <td>{{ $item->tanggal_mulai->format('d/m/Y') }}</td>
                                <td>{{ $item->tanggal_selesai->format('d/m/Y') }}</td>
                                <td>
                                    <a href="{{ route('admin.beasiswa-ongoing.edit', $item->id) }}"
                                        class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.beasiswa-ongoing.destroy', $item->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Tidak ada data beasiswa ongoing</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $beasiswaOngoing->links() }}
            </div>
        </div>
    </div>
@endsection
