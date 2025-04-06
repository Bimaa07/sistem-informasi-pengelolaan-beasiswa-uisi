@extends('layouts.admin')

@php
    // Dummy data for statistics
    $statistics = [
        'total_students' => 120,
        'active_scholarships' => 8,
        'total_applicants' => 230,
        'accepted' => 97,
        'rejected' => 45,
        'processing' => 88,
    ];

    // Dummy data for scholarship applications
    $scholarshipData = [
        'Beasiswa Prestasi' => 45,
        'Beasiswa PPA' => 65,
        'Beasiswa BUMN' => 35,
        'Beasiswa Unggulan' => 85,
    ];

    // Dummy data for detailed table
    $applications = [
        [
            'id' => 1,
            'student_name' => 'Bima Fahrudin Yusuo',
            'scholarship' => 'Beasiswa Prestasi',
            'status' => 'accepted',
            'date' => '2025-03-25',
            'gpa' => 3.8,
            'program' => 'Informatika',
        ],
        // Add more dummy data here
    ];
@endphp

@section('content')
    <div class="container-fluid px-4">
        <!-- Header Section -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="mt-4">Laporan & Statistik</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active">Laporan & Statistik</li>
                    </ol>
                </nav>
            </div>
            <div class="d-flex gap-2">
                <button class="btn btn-primary">
                    <i class="fas fa-download"></i> Download PDF
                </button>
                <button class="btn btn-success">
                    <i class="fas fa-chart-bar"></i> Export Grafik
                </button>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="row mb-4">
            <div class="col-xl-2 col-md-4">
                <div class="card bg-primary text-white mb-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="small">Total Mahasiswa</div>
                                <h2>{{ $statistics['total_students'] }}</h2>
                            </div>
                            <i class="fas fa-users fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-2 col-md-4">
                <div class="card bg-success text-white mb-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="small">Beasiswa Aktif</div>
                                <h2>{{ $statistics['active_scholarships'] }}</h2>
                            </div>
                            <i class="fas fa-graduation-cap fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-2 col-md-4">
                <div class="card bg-info text-white mb-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="small">Total Pendaftar</div>
                                <h2>{{ $statistics['total_applicants'] }}</h2>
                            </div>
                            <i class="fas fa-file-alt fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-2 col-md-4">
                <div class="card bg-success text-white mb-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="small">Diterima</div>
                                <h2>{{ $statistics['accepted'] }}</h2>
                            </div>
                            <i class="fas fa-check-circle fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-2 col-md-4">
                <div class="card bg-danger text-white mb-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="small">Ditolak</div>
                                <h2>{{ $statistics['rejected'] }}</h2>
                            </div>
                            <i class="fas fa-times-circle fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-2 col-md-4">
                <div class="card bg-warning text-white mb-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="small">Diproses</div>
                                <h2>{{ $statistics['processing'] }}</h2>
                            </div>
                            <i class="fas fa-clock fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Section -->
        <div class="row mb-4">
            <div class="col-xl-8">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-chart-bar me-1"></i>
                        Jumlah Pendaftar per Beasiswa
                    </div>
                    <div class="card-body">
                        <canvas id="applicationsChart" width="100%" height="40"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-xl-4">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-chart-pie me-1"></i>
                        Status Pendaftaran
                    </div>
                    <div class="card-body">
                        <canvas id="statusPieChart" width="100%" height="50"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Data Table Section -->
        <div class="card mb-4">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <i class="fas fa-table me-1"></i>
                        Data Pendaftaran Detil
                    </div>
                    <div class="d-flex gap-2">
                        <button class="btn btn-sm btn-success">
                            <i class="fas fa-file-excel"></i> Export Excel
                        </button>
                        <button class="btn btn-sm btn-danger">
                            <i class="fas fa-file-pdf"></i> Export PDF
                        </button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-striped" id="applicationsTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Mahasiswa</th>
                            <th>Beasiswa</th>
                            <th>Status</th>
                            <th>Tanggal Daftar</th>
                            <th>IPK</th>
                            <th>Program Studi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($applications as $index => $application)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $application['student_name'] }}</td>
                                <td>{{ $application['scholarship'] }}</td>
                                <td>
                                    @if ($application['status'] === 'accepted')
                                        <span class="badge bg-success">Diterima</span>
                                    @elseif($application['status'] === 'rejected')
                                        <span class="badge bg-danger">Ditolak</span>
                                    @else
                                        <span class="badge bg-warning">Diproses</span>
                                    @endif
                                </td>
                                <td>{{ date('d M Y', strtotime($application['date'])) }}</td>
                                <td>{{ $application['gpa'] }}</td>
                                <td>{{ $application['program'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Bar Chart
        const applicationsCtx = document.getElementById('applicationsChart');
        new Chart(applicationsCtx, {
            type: 'bar',
            data: {
                labels: {!! json_encode(array_keys($scholarshipData)) !!},
                datasets: [{
                    label: 'Jumlah Pendaftar',
                    data: {!! json_encode(array_values($scholarshipData)) !!},
                    backgroundColor: 'rgba(0, 123, 255, 0.5)',
                    borderColor: 'rgba(0, 123, 255, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Pie Chart
        const statusCtx = document.getElementById('statusPieChart');
        new Chart(statusCtx, {
            type: 'pie',
            data: {
                labels: ['Diterima', 'Ditolak', 'Diproses'],
                datasets: [{
                    data: [
                        {{ $statistics['accepted'] }},
                        {{ $statistics['rejected'] }},
                        {{ $statistics['processing'] }}
                    ],
                    backgroundColor: [
                        'rgba(40, 167, 69, 0.8)',
                        'rgba(220, 53, 69, 0.8)',
                        'rgba(255, 193, 7, 0.8)'
                    ]
                }]
            }
        });
    </script>
@endpush
