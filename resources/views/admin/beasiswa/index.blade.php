@extends('layouts.admin')

@section('content')
<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
    <div class="d-flex flex-column flex-column-fluid">
        <!--begin::Toolbar-->
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                        Manajemen Beasiswa
                    </h1>
                </div>
                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <a href="{{ route('admin.beasiswa.create') }}" class="btn btn-primary">
                        <i class="ki-outline ki-plus-square fs-2"></i>
                        Tambah Beasiswa
                    </a>
                </div>
            </div>
        </div>
        <!--end::Toolbar-->

        <!--begin::Content-->
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <div id="kt_app_content_container" class="app-container container-fluid">
                @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                <div class="card">
                    <div class="card-body pt-0">
                        <table class="table align-middle table-row-dashed fs-6 gy-5" id="beasiswa_table">
                            <thead>
                                <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                    <th>Nama Beasiswa</th>
                                    <th>Jenis</th>
                                    <th>Periode Monitoring</th>
                                    <th class="text-end">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 fw-semibold">
                                @forelse($beasiswa as $item)
                                <tr>
                                    <td>{{ $item->nama }}</td>
                                    <td>
                                        @if ($item->jenis === 'full')
                                        <div class="badge badge-light-primary">Full</div>
                                        @else
                                        <div class="badge badge-light-warning">Ongoing</div>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.periode-monitoring.index', ['beasiswa_id' => $item->id]) }}"
                                            class="btn btn-sm btn-light-primary">
                                            <i class="ki-outline ki-calendar fs-2"></i>
                                            Kelola Periode ({{ $item->periodeMonitoring->count() }})
                                        </a>
                                    </td>
                                    <td class="text-end">
                                        <a href="{{ route('admin.beasiswa.edit', $item) }}"
                                            class="btn btn-icon btn-sm btn-light-primary me-2" data-bs-toggle="tooltip"
                                            title="Edit Beasiswa">
                                            <i class="ki-outline ki-notepad-edit fs-2"></i>
                                        </a>
                                        <button type="button"
                                            class="btn btn-icon btn-sm btn-light-danger delete-beasiswa"
                                            data-bs-toggle="tooltip" title="Hapus Beasiswa" data-id="{{ $item->id }}"
                                            data-name="{{ $item->nama }}">
                                            <i class="ki-outline ki-trash fs-2"></i>
                                        </button>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="text-center text-gray-500">
                                        Tidak ada data beasiswa
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Content-->
    </div>
</div>

<!--begin::Delete Modal-->
<div class="modal fade" tabindex="-1" id="delete_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="" method="POST" id="delete_form">
                @csrf
                @method('DELETE')
                <div class="modal-header">
                    <h3 class="modal-title">Hapus Beasiswa</h3>
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i class="ki-outline ki-cross fs-1"></i>
                    </div>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus beasiswa <span id="beasiswa_name" class="fw-bold"></span>?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!--begin::Modal Tambah Periode-->
<div class="modal fade" tabindex="-1" id="modal_periode">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="form_periode">
                @csrf
                <input type="hidden" name="beasiswa_id" id="beasiswa_id">

                <div class="modal-header">
                    <h3 class="modal-title">Tambah Periode Monitoring</h3>
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal">
                        <i class="ki-outline ki-cross fs-1"></i>
                    </div>
                </div>

                <div class="modal-body">
                    <div class="mb-5">
                        <label class="form-label">Beasiswa</label>
                        <input type="text" class="form-control form-control-solid" id="beasiswa_nama" readonly>
                    </div>

                    <div class="mb-5">
                        <label class="form-label required">Tahun Ajaran</label>
                        <select name="tahun_ajaran" class="form-select" required>
                            @for($i = -1; $i <= 1; $i++) @php $year=date('Y') + $i; $nextYear=$year + 1;
                                $tahunAjaran=$year . '/' . $nextYear; @endphp <option value="{{ $tahunAjaran }}">{{
                                $tahunAjaran }}</option>
                                @endfor
                        </select>
                    </div>

                    <div class="mb-5">
                        <label class="form-label required">Semester</label>
                        <select name="semester" class="form-select" required>
                            <option value="ganjil">Ganjil</option>
                            <option value="genap">Genap</option>
                        </select>
                    </div>

                    <div class="mb-5">
                        <label class="form-label required">Status</label>
                        <select name="status" class="form-select" required>
                            <option value="aktif">Aktif</option>
                            <option value="nonaktif">Non-Aktif</option>
                        </select>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">
                        <span class="indicator-label">Simpan</span>
                        <span class="indicator-progress">
                            Menyimpan... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--end::Delete Modal-->
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
            // Initialize tooltips
            $('[data-bs-toggle="tooltip"]').tooltip();

            // Delete confirmation
            $('.delete-beasiswa').click(function() {
                const id = $(this).data('id');
                const name = $(this).data('name');
                const deleteForm = $('#delete_form');

                deleteForm.attr('action', `/admin/beasiswa/${id}`);
                $('#beasiswa_name').text(name);

                new bootstrap.Modal('#delete_modal').show();
            });
        });
</script>
@endpush