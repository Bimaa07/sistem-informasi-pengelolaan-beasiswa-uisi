@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-4">
        <!-- Header Section -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="mt-4">Manajemen Beasiswa</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Manajemen Beasiswa</li>
                    </ol>
                </nav>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('admin.beasiswa.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Tambah Beasiswa
                </a>
            </div>
        </div>

        <!-- Alert Messages -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Filter Section -->
        <div class="card mb-4">
            <div class="card-body">
                <form action="{{ route('admin.beasiswa.index') }}" method="GET" class="row g-3">
                    <div class="col-md-4">
                        <input type="text" name="search" class="form-control" placeholder="Cari beasiswa..."
                            value="{{ request('search') }}">
                    </div>
                    <div class="col-md-2">
                        <select name="status" class="form-select">
                            <option value="">Semua Status</option>
                            <option value="aktif" {{ request('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="nonaktif" {{ request('status') == 'nonaktif' ? 'selected' : '' }}>Tidak Aktif</option>
                            <option value="ditutup" {{ request('status') == 'ditutup' ? 'selected' : '' }}>Ditutup</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}">
                    </div>
                    <div class="col-md-3">
                        <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}">
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Filter</button>
                        <a href="{{ route('admin.beasiswa.index') }}" class="btn btn-secondary">Reset</a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Scholarships Table -->
        <div class="card mb-4">
            <div class="card-body">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Beasiswa</th>
                            <th>Status</th>
                            <th>Tanggal Mulai</th>
                            <th>Tanggal Selesai</th>
                            <th>Tahun Ajaran</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($beasiswa as $index => $item)
                            <tr>
                                <td>{{ $beasiswa->firstItem() + $index }}</td>
                                <td>{{ $item->nama }}</td>
                                <td>
                                    @if($item->status === 'aktif')
                                        <span class="badge bg-success">Aktif</span>
                                    @elseif($item->status === 'nonaktif')
                                        <span class="badge bg-danger">Tidak Aktif</span>
                                    @else
                                        <span class="badge bg-warning">Ditutup</span>
                                    @endif
                                </td>
                                <td>{{ $item->tanggal_mulai ? date('d M Y', strtotime($item->tanggal_mulai)) : '-' }}</td>
                                <td>{{ $item->tanggal_selesai ? date('d M Y', strtotime($item->tanggal_selesai)) : '-' }}</td>
                                <td>{{ $item->tahun_ajaran }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.beasiswa.show', $item->id) }}"
                                           class="btn btn-sm btn-info">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.beasiswa.edit', $item->id) }}"
                                           class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.beasiswa.destroy', $item->id) }}"
                                              method="POST"
                                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus beasiswa ini?');"
                                              class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">Tidak ada data beasiswa</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <!-- Pagination -->
                <div class="d-flex justify-content-end">
                    {{ $beasiswa->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    // Auto-hide alerts after 5 seconds
    setTimeout(function() {
        $('.alert').fadeOut('slow');
    }, 5000);
</script>
@endpush
