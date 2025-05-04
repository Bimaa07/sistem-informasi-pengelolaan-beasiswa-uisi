@extends('layouts.admin')

@push('styles')
    <style>
        .form-switch {
            padding-left: 2.5em;
        }

        .form-check-input {
            cursor: pointer;
        }

        .scholarship-toggle:checked {
            background-color: #198754;
            border-color: #198754;
        }
    </style>
@endpush
@section('content')
    <div class="container-fluid px-4">
        <!-- Header Section -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="mt-4">Manajemen Mahasiswa</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active">Manajemen Mahasiswa</li>
                    </ol>
                </nav>
            </div>
        </div>

        <!-- Search & Filter Section -->
        <div class="card mb-4">
            <div class="card-body">
                <form action="{{ route('admin.manajemen-mahasiswa.index') }}" method="GET">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <input type="text" name="search" class="form-control" placeholder="Cari NIM/Nama/Prodi..."
                                value="{{ request('search') }}">
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-search"></i> Cari
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Students Table -->
        <div class="card mb-4">
            <div class="card-body">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIM</th>
                            <th>Nama</th>
                            <th>Program Studi</th>
                            <th>Email</th>
                            <th>Status Beasiswa Full</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($mahasiswas as $index => $mahasiswa)
                            <tr>
                                <td>{{ $mahasiswas->firstItem() + $index }}</td>
                                <td>{{ $mahasiswa->nim }}</td>
                                <td>{{ $mahasiswa->nama }}</td>
                                <td>{{ $mahasiswa->prodi }}</td>
                                <td>{{ $mahasiswa->user->email }}</td>
                                <td>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input scholarship-toggle" type="checkbox"
                                            id="scholarship-{{ $mahasiswa->id }}" data-id="{{ $mahasiswa->id }}"
                                            {{ $mahasiswa->penerima_beasiswa_full ? 'checked' : '' }}>
                                        <select class="form-select scholarship-type" data-id="{{ $mahasiswa->id }}"
                                            {{ !$mahasiswa->penerima_beasiswa_full ? 'disabled' : '' }}>
                                            <option value="">Pilih Jenis Beasiswa</option>
                                            <option value="aperti_bumn"
                                                {{ $mahasiswa->jenis_beasiswa_full === 'aperti_bumn' ? 'selected' : '' }}>
                                                Beasiswa Aperti BUMN
                                            </option>
                                            <option value="kip"
                                                {{ $mahasiswa->jenis_beasiswa_full === 'kip' ? 'selected' : '' }}>
                                                Beasiswa KIP
                                            </option>
                                            <option value="unggulan"
                                                {{ $mahasiswa->jenis_beasiswa_full === 'unggulan' ? 'selected' : '' }}>
                                                Beasiswa Unggulan
                                            </option>
                                        </select>
                                        <label class="form-check-label" for="scholarship-{{ $mahasiswa->id }}">
                                            <span
                                                class="badge bg-{{ $mahasiswa->penerima_beasiswa_full ? 'success' : 'secondary' }}">
                                                {{ $mahasiswa->getBeasiswaFullLabel() }}
                                            </span>
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-info" data-bs-toggle="modal"
                                        data-bs-target="#kt_modal_detail" data-mahasiswa-id="{{ $mahasiswa->id }}">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="btn btn-sm btn-warning" onclick="editMahasiswa({{ $mahasiswa->id }})">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger" onclick="deleteMahasiswa({{ $mahasiswa->id }})">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">Tidak ada data mahasiswa</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <!-- Pagination -->
                <div class="d-flex justify-content-end">
                    {{ $mahasiswas->links() }}
                </div>
            </div>
        </div>
    </div>

    <!-- Detail Modal -->
    <div class="modal fade" id="kt_modal_detail" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail Mahasiswa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="text-center mb-4">
                        <img id="mahasiswa-avatar" src="" alt="Avatar" class="rounded-circle"
                            style="width: 100px; height: 100px;">
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">NIM</div>
                        <div class="col-md-8" id="detail-nim"></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Nama</div>
                        <div class="col-md-8" id="detail-nama"></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Program Studi</div>
                        <div class="col-md-8" id="detail-prodi"></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Email</div>
                        <div class="col-md-8" id="detail-email"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function editMahasiswa(id) {
            alert('Edit mahasiswa dengan ID: ' + id);
        }

        function deleteMahasiswa(id) {
            if (confirm('Apakah Anda yakin ingin menghapus data mahasiswa ini?')) {
                alert('Menghapus mahasiswa dengan ID: ' + id);
            }
        }

        // Handle modal detail
        $('#kt_modal_detail').on('show.bs.modal', function(event) {
            const button = $(event.relatedTarget);
            const mahasiswaId = button.data('mahasiswa-id');

            // Simulate loading data (replace with actual AJAX call)
            const mahasiswa = {
                nim: 'Loading...',
                nama: 'Loading...',
                prodi: 'Loading...',
                email: 'Loading...',
                avatar: 'path/to/default/avatar.jpg'
            };

            $('#detail-nim').text(mahasiswa.nim);
            $('#detail-nama').text(mahasiswa.nama);
            $('#detail-prodi').text(mahasiswa.prodi);
            $('#detail-email').text(mahasiswa.email);
            $('#mahasiswa-avatar').attr('src', mahasiswa.avatar);
        });

        $('.scholarship-toggle').on('change', function() {
            const id = $(this).data('id');
            const isChecked = $(this).prop('checked');
            const select = $(this).siblings('.scholarship-type');
            const badge = $(this).siblings('label').find('.badge');

            // Enable/disable select based on toggle
            select.prop('disabled', !isChecked);

            if (!isChecked) {
                select.val('');
            }

            updateScholarshipStatus(id, isChecked, select.val(), badge, select);
        });

        $('.scholarship-type').on('change', function() {
            const id = $(this).data('id');
            const toggle = $(this).siblings('.scholarship-toggle');
            const badge = $(this).siblings('label').find('.badge');

            if (toggle.prop('checked')) {
                updateScholarshipStatus(id, true, $(this).val(), badge, $(this));
            }
        });

        function updateScholarshipStatus(id, isChecked, type, badge, element) {
            $.ajax({
                url: `/admin/manajemen-mahasiswa/${id}/scholarship-status`,
                type: 'PATCH',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                data: JSON.stringify({
                    penerima_beasiswa_full: isChecked,
                    jenis_beasiswa_full: type
                }),
                success: function(response) {
                    if (response.success) {
                        badge.removeClass('bg-success bg-secondary')
                            .addClass(isChecked ? 'bg-success' : 'bg-secondary')
                            .text(response.data.jenis_beasiswa_full ?
                                getBeasiswaLabel(response.data.jenis_beasiswa_full) :
                                'Tidak');
                        toastr.success(response.message);
                    }
                },
                error: function(xhr) {
                    element.prop('checked', !isChecked);
                    toastr.error(xhr.responseJSON?.message || 'Gagal memperbarui status beasiswa');
                }
            });
        }

        function getBeasiswaLabel(type) {
            const labels = {
                'aperti_bumn': 'Beasiswa Aperti BUMN',
                'kip': 'Beasiswa KIP',
                'unggulan': 'Beasiswa Unggulan'
            };
            return labels[type] || 'Tidak';
        }
    </script>
@endpush
