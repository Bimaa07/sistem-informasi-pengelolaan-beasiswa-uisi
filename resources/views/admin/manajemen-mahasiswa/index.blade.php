@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="mt-4">Database Mahasiswa</h1>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Search and Import Section -->
        <div class="card mb-4">
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Cari Data Mahasiswa</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="searchNim" placeholder="Masukkan NIM"
                                pattern="\d{10}">
                            <button class="btn btn-primary" type="button" id="searchButton">
                                <i class="fas fa-search me-1"></i> Cari
                            </button>
                        </div>
                        <small class="form-text text-muted">Format: 10 digit angka (contoh: 3012110009)</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Preview Card -->
        <div class="card mb-4 d-none" id="previewCard">
            <div class="card-header">
                <h5 class="card-title mb-0">Preview Data Mahasiswa</h5>
            </div>
            <div class="card-body">
                <form id="importForm">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">NIM</label>
                            <input type="text" class="form-control" id="nim" name="nim" readonly>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama" readonly>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Program Studi</label>
                            <input type="text" class="form-control" id="program_studi" name="program_studi" readonly>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" readonly>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Tahun Masuk</label>
                            <input type="text" class="form-control" id="tahun_masuk" name="tahun_masuk" readonly>
                        </div>
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="create_user" name="create_user" checked>
                                <label class="form-check-label" for="create_user">
                                    Buat akun user untuk mahasiswa ini
                                </label>
                            </div>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save me-1"></i> Simpan ke Database
                            </button>
                            <button type="button" class="btn btn-secondary" id="cancelButton">
                                <i class="fas fa-times me-1"></i> Batal
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Data Table -->
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>NIM</th>
                                <th>Nama</th>
                                <th>Program Studi</th>
                                <th>Email</th>
                                <th>Status User</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($mahasiswa as $mhs)
                                <tr>
                                    <td>{{ $mhs->nim }}</td>
                                    <td>{{ $mhs->nama }}</td>
                                    <td>{{ $mhs->program_studi }}</td>
                                    <td>{{ $mhs->email }}</td>
                                    <td>
                                        @if ($mhs->user_id)
                                            <span class="badge bg-success">Aktif</span>
                                        @else
                                            <span class="badge bg-warning">Belum Ada Akun</span>
                                        @endif
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-info">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">Tidak ada data</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                {{ $mahasiswa->links() }}
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            const searchButton = $('#searchButton');
            const searchNim = $('#searchNim');
            const previewCard = $('#previewCard');
            const importForm = $('#importForm');
            const cancelButton = $('#cancelButton');

            searchButton.click(function() {
                const nim = searchNim.val();
                if (nim.length !== 10) {
                    alert('NIM harus 10 digit');
                    return;
                }

                $.ajax({
                    url: "{{ route('admin.manajemen-mahasiswa.import') }}",
                    type: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        nim: nim
                    },
                    beforeSend: function() {
                        searchButton.prop('disabled', true);
                        searchButton.html(
                            '<i class="fas fa-spinner fa-spin me-1"></i> Mencari...');
                    },
                    success: function(response) {
                        if (response.success) {
                            const data = response.data;
                            console.log(data);
                            $('#nim').val(data.NIM);
                            $('#nama').val(data['Nama Mahasiswa']);
                            $('#program_studi').val(data['Program Studi']);
                            $('#email').val(data.Email);
                            $('#tahun_masuk').val(data['Tahun Masuk']);
                            $('#jenis_kelamin').val(data['Jenis Kelamin']);
                            $('#mahasiswa_transfer').val(data['Mahasiswa Transfer']);
                            $('#dosen_wali').val(data['Dosen Wali']);
                            previewCard.removeClass('d-none');
                        } else {
                            alert(response.message);
                        }
                    },
                    error: function(xhr) {
                        alert(xhr.responseJSON?.message || 'Terjadi kesalahan');
                    },
                    complete: function() {
                        searchButton.prop('disabled', false);
                        searchButton.html('<i class="fas fa-search me-1"></i> Cari');
                    }
                });
            });

            cancelButton.click(function() {
                previewCard.addClass('d-none');
                searchNim.val('');
                importForm[0].reset();
            });

            importForm.submit(function(e) {
                e.preventDefault();

                $.ajax({
                    url: "{{ route('admin.manajemen-mahasiswa.store') }}",
                    type: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        ...Object.fromEntries(new FormData(this))
                    },
                    beforeSend: function() {
                        $(e.target).find('button[type="submit"]').prop('disabled', true);
                    },
                    success: function(response) {
                        if (response.success) {
                            window.location.reload();
                        } else {
                            alert(response.message);
                        }
                    },
                    error: function(xhr) {
                        alert(xhr.responseJSON?.message || 'Terjadi kesalahan');
                    },
                    complete: function() {
                        $(e.target).find('button[type="submit"]').prop('disabled', false);
                    }
                });
            });
        });
    </script>
@endpush
