@extends('layouts.admin')

@php
    // Dummy data for scholarship registrations
    $registrations = [
        [
            'id' => 1,
            'student_name' => 'Bima Fahrudin Yusup',
            'nim' => '01234567',
            'program' => 'Informatika',
            'semester' => 6,
            'scholarship_name' => 'Beasiswa BUMN 2025',
            'register_date' => '2025-03-25',
            'status' => 'process',
            'gpa' => 3.8,
            'documents' => ['khs.pdf', 'active_letter.pdf', 'achievement.pdf'],
            'motivation' => 'Ingin fokus mengembangkan riset di bidang AI',
        ],
        [
            'id' => 2,
            'student_name' => 'Andi Saputra',
            'nim' => '01234568',
            'program' => 'Teknik Kimia',
            'semester' => 4,
            'scholarship_name' => 'Beasiswa PPA 2025',
            'register_date' => '2025-03-20',
            'status' => 'accepted',
            'gpa' => 3.5,
            'documents' => ['khs.pdf', 'active_letter.pdf'],
            'motivation' => 'Membutuhkan bantuan finansial untuk melanjutkan kuliah',
        ],
        [
            'id' => 3,
            'student_name' => 'Siti Rahma',
            'nim' => '01234569',
            'program' => 'Manajemen',
            'semester' => 5,
            'scholarship_name' => 'Beasiswa Unggulan 2025',
            'register_date' => '2025-03-22',
            'status' => 'rejected',
            'gpa' => 3.1,
            'documents' => ['khs.pdf'],
            'motivation' => 'Ingin mengembangkan potensi di bidang kewirausahaan',
        ],
    ];
@endphp

@section('content')
    <div class="container-fluid px-4">
        <!-- Header Section -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="mt-4">Pendaftaran Beasiswa</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active">Pendaftaran Beasiswa</li>
                    </ol>
                </nav>
            </div>
            <div class="d-flex gap-2">
                <button class="btn btn-primary">
                    <i class="fas fa-sync"></i> Refresh Data
                </button>
            </div>
        </div>

        <!-- Filter Section -->
        <div class="card mb-4">
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-3">
                        <input type="text" class="form-control" placeholder="Cari nama/NIM...">
                    </div>
                    <div class="col-md-3">
                        <select class="form-select">
                            <option value="">Semua Beasiswa</option>
                            <option>Beasiswa Prestasi UISI 2025</option>
                            <option>Beasiswa PPA 2025</option>
                            <option>Beasiswa Unggulan 2025</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select class="form-select">
                            <option value="">Semua Status</option>
                            <option value="process">Diproses</option>
                            <option value="accepted">Diterima</option>
                            <option value="rejected">Ditolak</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <input type="date" class="form-control" placeholder="Tanggal Dari">
                    </div>
                    <div class="col-md-2">
                        <input type="date" class="form-control" placeholder="Tanggal Sampai">
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="row mb-4">
            <div class="col-xl-3 col-md-6">
                <div class="card bg-primary text-white mb-4">
                    <div class="card-body">
                        <h4>15</h4>
                        <div>Total Pendaftar</div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-success text-white mb-4">
                    <div class="card-body">
                        <h4>8</h4>
                        <div>Diterima</div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-warning text-white mb-4">
                    <div class="card-body">
                        <h4>4</h4>
                        <div>Diproses</div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-danger text-white mb-4">
                    <div class="card-body">
                        <h4>3</h4>
                        <div>Ditolak</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Registrations Table -->
        <div class="card mb-4">
            <div class="card-body">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Mahasiswa</th>
                            <th>NIM</th>
                            <th>Beasiswa</th>
                            <th>Tanggal Daftar</th>
                            <th>Status</th>
                            <th>IPK</th>
                            <th>Dokumen</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($registrations as $index => $registration)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $registration['student_name'] }}</td>
                                <td>{{ $registration['nim'] }}</td>
                                <td>{{ $registration['scholarship_name'] }}</td>
                                <td>{{ date('d M Y', strtotime($registration['register_date'])) }}</td>
                                <td>
                                    @if ($registration['status'] === 'process')
                                        <span class="badge bg-warning">Diproses</span>
                                    @elseif($registration['status'] === 'accepted')
                                        <span class="badge bg-success">Diterima</span>
                                    @else
                                        <span class="badge bg-danger">Ditolak</span>
                                    @endif
                                </td>
                                <td>{{ $registration['gpa'] }}</td>
                                <td>
                                    <span class="badge bg-info">
                                        <i class="fas fa-paperclip"></i>
                                        {{ count($registration['documents']) }}
                                    </span>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-info" onclick="showDetail({{ $registration['id'] }})">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    @if ($registration['status'] === 'process')
                                        <button class="btn btn-sm btn-success"
                                            onclick="acceptRegistration({{ $registration['id'] }})">
                                            <i class="fas fa-check"></i>
                                        </button>
                                        <button class="btn btn-sm btn-danger"
                                            onclick="rejectRegistration({{ $registration['id'] }})">
                                            <i class="fas fa-times"></i>
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

    <!-- Detail Modal -->
    <div class="modal fade" id="detailModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail Pendaftaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <!-- Content will be loaded dynamically -->
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function showDetail(id) {
            alert('Menampilkan detail pendaftaran ID: ' + id);
        }

        function acceptRegistration(id) {
            if (confirm('Terima pendaftaran ini?')) {
                alert('Pendaftaran ID: ' + id + ' telah diterima');
            }
        }

        function rejectRegistration(id) {
            const reason = prompt('Masukkan alasan penolakan:');
            if (reason) {
                alert('Pendaftaran ID: ' + id + ' telah ditolak\nAlasan: ' + reason);
            }
        }
    </script>
@endpush
