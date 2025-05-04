@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-4">
        <!-- Header Section -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="mt-4">Data Mahasiswa API</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active">Data Mahasiswa API</li>
                    </ol>
                </nav>
            </div>
            <div>
                <form action="{{ route('admin.manajemen-mahasiswa.import') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-file-import"></i> Import Semua Data
                    </button>
                </form>
            </div>
        </div>

        @if (isset($error))
            <div class="alert alert-danger">
                {{ $error }}
            </div>
        @endif

        <!-- Data Table -->
        <div class="card mb-4">
            <div class="card-body">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIM</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Program Studi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($mahasiswas as $index => $mahasiswa)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $mahasiswa['nim'] }}</td>
                                <td>{{ $mahasiswa['nama'] }}</td>
                                <td>{{ $mahasiswa['email'] ?? '-' }}</td>
                                <td>{{ $mahasiswa['prodi'] }}</td>
                                <td>
                                    <form action="{{ route('admin.manajemen-mahasiswa.import') }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        <input type="hidden" name="nim" value="{{ $mahasiswa['nim'] }}">
                                        <button type="submit" class="btn btn-sm btn-primary">
                                            <i class="fas fa-download"></i> Import
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">Tidak ada data mahasiswa dari API</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Tambahkan konfirmasi sebelum import
        document.querySelectorAll('form').forEach(form => {
            form.addEventListener('submit', function(e) {
                if (!confirm('Apakah Anda yakin ingin mengimport data ini?')) {
                    e.preventDefault();
                }
            });
        });
    </script>
@endpush
