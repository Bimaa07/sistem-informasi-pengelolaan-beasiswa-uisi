@extends('layouts.admin')

@php
    // Dummy data for notifications
    $notifications = [
        [
            'id' => 1,
            'time' => '2025-03-28 09:30:00',
            'recipient' => 'Mahasiswa - Bima',
            'title' => 'Akun Terverifikasi',
            'content' => 'Akun Anda telah diverifikasi oleh Admin',
            'status' => 'sent',
            'type' => 'system',
        ],
        [
            'id' => 2,
            'time' => '2025-03-29 14:15:00',
            'recipient' => 'Prodi - SI',
            'title' => 'Mahasiswa Baru Diterima',
            'content' => 'Ada mahasiswa yang diterima beasiswa',
            'status' => 'sent',
            'type' => 'system',
        ],
    ];

    // Dummy data for announcements
    $announcements = [
        [
            'id' => 1,
            'date' => '2025-03-25',
            'title' => 'Pendaftaran Beasiswa Prestasi Dibuka',
            'target' => 'Semua Mahasiswa',
            'status' => 'active',
            'content' => 'Pendaftaran Beasiswa Prestasi 2025 telah dibuka. Silakan mendaftar melalui sistem.',
        ],
        [
            'id' => 2,
            'date' => '2025-03-20',
            'title' => 'Maintenance Sistem',
            'target' => 'Semua Pengguna',
            'status' => 'expired',
            'content' => 'Sistem akan mengalami maintenance pada tanggal 22 Maret 2025.',
        ],
    ];
@endphp

@section('content')
    <div class="container-fluid px-4">
        <!-- Header Section -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="mt-4">Notifikasi & Pengumuman</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active">Notifikasi & Pengumuman</li>
                    </ol>
                </nav>
            </div>
            <div class="d-flex gap-2">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createAnnouncementModal">
                    <i class="fas fa-plus"></i> Buat Pengumuman
                </button>
                <button class="btn btn-secondary">
                    <i class="fas fa-sync"></i> Refresh
                </button>
                <button class="btn btn-success">
                    <i class="fas fa-file-export"></i> Export
                </button>
            </div>
        </div>

        <!-- Navigation Tabs -->
        <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="notifications-tab" data-bs-toggle="tab" data-bs-target="#notifications"
                    type="button" role="tab">
                    <i class="fas fa-bell"></i> Notifikasi Sistem
                    <span class="badge bg-danger">2</span>
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="announcements-tab" data-bs-toggle="tab" data-bs-target="#announcements"
                    type="button" role="tab">
                    <i class="fas fa-bullhorn"></i> Pengumuman Umum
                </button>
            </li>
        </ul>

        <!-- Tab Content -->
        <div class="tab-content" id="myTabContent">
            <!-- Notifications Tab -->
            <div class="tab-pane fade show active" id="notifications" role="tabpanel">
                <div class="card mb-4">
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Waktu</th>
                                    <th>Penerima</th>
                                    <th>Judul</th>
                                    <th>Isi Singkat</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($notifications as $index => $notification)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ date('d M Y H:i', strtotime($notification['time'])) }}</td>
                                        <td>{{ $notification['recipient'] }}</td>
                                        <td>{{ $notification['title'] }}</td>
                                        <td>{{ $notification['content'] }}</td>
                                        <td>
                                            <span class="badge bg-success">
                                                <i class="fas fa-envelope"></i> Terkirim
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Announcements Tab -->
            <div class="tab-pane fade" id="announcements" role="tabpanel">
                <div class="card mb-4">
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Judul</th>
                                    <th>Tujuan</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($announcements as $index => $announcement)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ date('d M Y', strtotime($announcement['date'])) }}</td>
                                        <td>{{ $announcement['title'] }}</td>
                                        <td>{{ $announcement['target'] }}</td>
                                        <td>
                                            @if ($announcement['status'] === 'active')
                                                <span class="badge bg-success">Aktif</span>
                                            @else
                                                <span class="badge bg-danger">Selesai</span>
                                            @endif
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-info"
                                                onclick="viewAnnouncement({{ $announcement['id'] }})">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            @if ($announcement['status'] === 'active')
                                                <button class="btn btn-sm btn-warning"
                                                    onclick="editAnnouncement({{ $announcement['id'] }})">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="btn btn-sm btn-danger"
                                                    onclick="deleteAnnouncement({{ $announcement['id'] }})">
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
        </div>

        <!-- Create Announcement Modal -->
        <div class="modal fade" id="createAnnouncementModal" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Buat Pengumuman Baru</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form id="announcementForm">
                            <div class="mb-3">
                                <label class="form-label">Judul Pengumuman</label>
                                <input type="text" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Isi Pengumuman</label>
                                <textarea class="form-control" rows="5" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Tujuan</label>
                                <select class="form-select">
                                    <option>Semua Mahasiswa</option>
                                    <option>Mahasiswa Tertentu</option>
                                    <option>Kepala Prodi</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">File Lampiran</label>
                                <input type="file" class="form-control">
                            </div>
                            <div class="d-flex justify-content-end gap-2">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Kirim Pengumuman</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function viewAnnouncement(id) {
            alert('Melihat pengumuman ID: ' + id);
        }

        function editAnnouncement(id) {
            alert('Edit pengumuman ID: ' + id);
        }

        function deleteAnnouncement(id) {
            if (confirm('Apakah Anda yakin ingin menghapus pengumuman ini?')) {
                alert('Pengumuman ID: ' + id + ' telah dihapus');
            }
        }

        // Form submission handler
        document.getElementById('announcementForm').onsubmit = function(e) {
            e.preventDefault();
            alert('Pengumuman berhasil dibuat (simulasi)');
            $('#createAnnouncementModal').modal('hide');
        };
    </script>
@endpush
