@extends('layouts.admin')

@php
    // Dummy data for scholarships
    $scholarships = [
        [
            'id' => 1,
            'name' => 'Beasiswa BUMN 2025',
            'quota' => 10,
            'deadline' => '2025-04-30',
            'status' => 'active',
            'applicants_count' => 8,
            'description' => 'Beasiswa untuk mahasiswa berprestasi dengan IPK minimal 3.5',
        ],
        [
            'id' => 2,
            'name' => 'Beasiswa PPA 2025',
            'quota' => 20,
            'deadline' => '2025-05-15',
            'status' => 'closed',
            'applicants_count' => 20,
            'description' => 'Program beasiswa Peningkatan Prestasi Akademik',
        ],
        [
            'id' => 3,
            'name' => 'Beasiswa Ongoing 2025',
            'quota' => 5,
            'deadline' => '2025-06-01',
            'status' => 'inactive',
            'applicants_count' => 0,
            'description' => 'Beasiswa khusus riset dan penelitian',
        ],
    ];
@endphp

@section('content')
    <div class="container-fluid px-4">
        <!-- Header Section -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="mt-4">Manajemen Beasiswa</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active">Manajemen Beasiswa</li>
                    </ol>
                </nav>
            </div>
            <div class="d-flex gap-2">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addScholarshipModal">
                    <i class="fas fa-plus"></i> Tambah Beasiswa
                </button>
                <button class="btn btn-success">
                    <i class="fas fa-file-export"></i> Export Data
                </button>
            </div>
        </div>

        <!-- Filter Section -->
        <div class="card mb-4">
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-4">
                        <input type="text" class="form-control" placeholder="Cari beasiswa...">
                    </div>
                    <div class="col-md-2">
                        <select class="form-select">
                            <option value="">Semua Status</option>
                            <option value="active">Aktif</option>
                            <option value="closed">Ditutup</option>
                            <option value="inactive">Tidak Aktif</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <input type="date" class="form-control" placeholder="Deadline Dari">
                    </div>
                    <div class="col-md-3">
                        <input type="date" class="form-control" placeholder="Deadline Sampai">
                    </div>
                </div>
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
                            <th>Kuota</th>
                            <th>Deadline</th>
                            <th>Status</th>
                            <th>Jumlah Pendaftar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($scholarships as $index => $scholarship)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $scholarship['name'] }}</td>
                                <td>{{ $scholarship['quota'] }}</td>
                                <td>{{ date('d M Y', strtotime($scholarship['deadline'])) }}</td>
                                <td>
                                    @if ($scholarship['status'] === 'active')
                                        <span class="badge bg-success">Aktif</span>
                                    @elseif($scholarship['status'] === 'closed')
                                        <span class="badge bg-warning">Ditutup</span>
                                    @else
                                        <span class="badge bg-danger">Tidak Aktif</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="progress" style="height: 20px;">
                                        <div class="progress-bar" role="progressbar"
                                            style="width: {{ ($scholarship['applicants_count'] / $scholarship['quota']) * 100 }}%">
                                            {{ $scholarship['applicants_count'] }}/{{ $scholarship['quota'] }}
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-info" onclick="showDetail({{ $scholarship['id'] }})">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <button class="btn btn-sm btn-warning"
                                        onclick="editScholarship({{ $scholarship['id'] }})">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    @if ($scholarship['status'] !== 'closed')
                                        <button class="btn btn-sm btn-danger"
                                            onclick="deleteScholarship({{ $scholarship['id'] }})">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Add Scholarship Modal -->
    <div class="modal fade" id="addScholarshipModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Beasiswa Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="addScholarshipForm">
                        <div class="mb-3">
                            <label class="form-label">Nama Beasiswa</label>
                            <input type="text" class="form-control" required>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Kuota</label>
                                <input type="number" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Deadline</label>
                                <input type="date" class="form-control" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Deskripsi & Syarat</label>
                            <textarea class="form-control" rows="4"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">File Panduan (PDF)</label>
                            <input type="file" class="form-control" accept=".pdf">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select class="form-select">
                                <option value="active">Aktif</option>
                                <option value="inactive">Tidak Aktif</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function showDetail(id) {
            alert('Menampilkan detail beasiswa ID: ' + id);
        }

        function editScholarship(id) {
            alert('Edit beasiswa ID: ' + id);
        }

        function deleteScholarship(id) {
            if (confirm('Apakah Anda yakin ingin menghapus beasiswa ini?')) {
                alert('Beasiswa ID: ' + id + ' telah dihapus');
            }
        }

        // Form submission handler
        document.getElementById('addScholarshipForm').onsubmit = function(e) {
            e.preventDefault();
            alert('Beasiswa baru telah ditambahkan (simulasi)');
            $('#addScholarshipModal').modal('hide');
        };
    </script>
@endpush
