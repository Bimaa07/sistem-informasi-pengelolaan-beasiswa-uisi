@extends('layouts.admin')

@section('content')
<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
    <div class="d-flex flex-column flex-column-fluid">
        <!--begin::Toolbar-->
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                        Manajemen Periode Monitoring
                    </h1>
                </div>
                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <button type="button" class="btn btn-primary" id="tambah_periode">
                        <i class="ki-outline ki-plus-square fs-2"></i>
                        Tambah Periode
                    </button>
                </div>
            </div>
        </div>
        <!--end::Toolbar-->
        <!--begin::Content-->
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <div id="kt_app_content_container" class="app-container container-fluid">
                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                <div class="card">
                    <div class="card-header border-0 pt-6">
                        <div class="card-title">
                            <div class="d-flex align-items-center position-relative">
                                <select class="form-select" id="filter_beasiswa">
                                    <option value="">Semua Beasiswa</option>
                                    @foreach($beasiswa as $item)
                                    <option value="{{ $item->id }}" {{ request('beasiswa_id')==$item->id ? 'selected' :
                                        '' }}>
                                        {{ $item->nama }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="card-body pt-0">
                        <table class="table align-middle table-row-dashed fs-6 gy-5">
                            <thead>
                                <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                    <th>Beasiswa</th>
                                    <th>Tahun Ajaran</th>
                                    <th>Semester</th>
                                    <th>Status</th>
                                    <th class="text-end">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 fw-semibold">
                                @forelse($periodeMonitoring as $periode)
                                <tr>
                                    <td>{{ $periode->beasiswa->nama }}</td>
                                    <td>{{ $periode->tahun_ajaran }}</td>
                                    <td>{{ ucfirst($periode->semester) }}</td>
                                    <td>
                                        <div
                                            class="badge badge-light-{{ $periode->status === 'aktif' ? 'success' : 'warning' }}">
                                            {{ ucfirst($periode->status) }}
                                        </div>
                                    </td>
                                    <td class="text-end">
                                        <button class="btn btn-sm btn-icon btn-light-warning me-2 edit-periode"
                                            data-id="{{ $periode->id }}" data-bs-toggle="tooltip" title="Edit Periode">
                                            <i class="ki-outline ki-notepad-edit fs-2"></i>
                                        </button>
                                        <button class="btn btn-sm btn-icon btn-light-danger delete-periode"
                                            data-id="{{ $periode->id }}" data-bs-toggle="tooltip" title="Hapus Periode">
                                            <i class="ki-outline ki-trash fs-2"></i>
                                        </button>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center text-gray-500">
                                        Tidak ada data periode monitoring
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>

                        <div class="d-flex justify-content-end mt-6">
                            {{ $periodeMonitoring->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Content-->
    </div>
</div>
<!--begin::Modal-->
<div class="modal fade" tabindex="-1" id="modal_tambah_periode">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="form_tambah_periode">
                @csrf
                <div class="modal-header">
                    <h3 class="modal-title">Tambah Periode Monitoring</h3>
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal">
                        <i class="ki-outline ki-cross fs-1"></i>
                    </div>
                </div>

                <div class="modal-body">
                    <div class="mb-5">
                        <label class="form-label required">Beasiswa</label>
                        <select name="beasiswa_id" class="form-select" required>
                            <option value="">Pilih Beasiswa</option>
                            @foreach($beasiswa as $item)
                            <option value="{{ $item->id }}" {{ request('beasiswa_id')==$item->id ? 'selected' : '' }}>
                                {{ $item->nama }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-5">
                        <label class="form-label required">Tahun</label>
                        <input type="number" name="tahun" class="form-control" value="{{ date('Y') }}" required>
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
<!--begin::Edit Modal-->
<div class="modal fade" tabindex="-1" id="modal_edit_periode">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="form_edit_periode">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" id="edit_id">

                <div class="modal-header">
                    <h3 class="modal-title">Edit Periode Monitoring</h3>
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal">
                        <i class="ki-outline ki-cross fs-1"></i>
                    </div>
                </div>

                <div class="modal-body">
                    <div class="mb-5">
                        <label class="form-label required">Beasiswa</label>
                        <select name="beasiswa_id" class="form-select" required>
                            <option value="">Pilih Beasiswa</option>
                            @foreach($beasiswa as $item)
                            <option value="{{ $item->id }}">{{ $item->nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-5">
                        <label class="form-label required">Tahun</label>
                        <input type="number" name="tahun" class="form-control" required>
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
                        <span class="indicator-label">Perbarui</span>
                        <span class="indicator-progress">
                            Memperbarui... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--end::Edit Modal-->
<!--end::Modal-->
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
    $('[data-bs-toggle="tooltip"]').tooltip();
    const internalUrls = [
    "{{ route('admin.periode-monitoring.store') }}",
    "/admin/periode-monitoring"
    ];

$(document).ajaxSend(function(e, xhr, options) {
// Check if this is an internal route
if (options.url.startsWith('/admin/')) {
xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));
}
});
    // Show modal
    $('#tambah_periode').click(function() {
    new bootstrap.Modal('#modal_tambah_periode').show();
    });

    // Form submission
    $('#form_tambah_periode').submit(function(e) {
    e.preventDefault();

    const form = $(this);
    const submitButton = form.find('[type="submit"]');

    submitButton.attr('data-kt-indicator', 'on');
    submitButton.prop('disabled', true);

    $.ajax({
    url: "{{ route('admin.periode-monitoring.store') }}",
    type: 'POST',
    data: form.serialize(),
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
    submitButton.attr('data-kt-indicator', 'off');
    submitButton.prop('disabled', false);
    }
    });
    });
    // Filter change handler
    $('#filter_beasiswa').change(function() {
        const beasiswaId = $(this).val();
        const url = new URL(window.location.href);

        if (beasiswaId) {
            url.searchParams.set('beasiswa_id', beasiswaId);
        } else {
            url.searchParams.delete('beasiswa_id');
        }

        window.location.href = url.toString();
    });

    // Delete handler
    $('.delete-periode').click(function() {
    if (!confirm('Apakah Anda yakin ingin menghapus periode ini?')) {
    return;
    }

    const button = $(this);
    const id = button.data('id');

    $.ajax({
    url: `/admin/periode-monitoring/${id}`,
    type: 'DELETE',
    success: function(response) {
    if (response.success) {
    window.location.reload();
    } else {
    alert(response.message);
    }
    },
    error: function(xhr) {
    alert(xhr.responseJSON?.message || 'Terjadi kesalahan');
    }
    });
    });

        // Add this to your existing $(document).ready function
    // Edit handler
    $('.edit-periode').click(function() {
        const id = $(this).data('id');

        // Get periode data
        $.ajax({
            url: `/admin/periode-monitoring/${id}/edit`,
            type: 'GET',
            success: function(response) {
                if (response.success) {
                    const data = response.data;

                    // Fill form
                    $('#edit_id').val(data.id);
                    $('#form_edit_periode select[name="beasiswa_id"]').val(data.beasiswa_id);
                    $('#form_edit_periode input[name="tahun"]').val(data.tahun);
                    $('#form_edit_periode select[name="tahun_ajaran"]').val(data.tahun_ajaran);
                    $('#form_edit_periode select[name="semester"]').val(data.semester);
                    $('#form_edit_periode select[name="status"]').val(data.status);

                    // Show modal
                    new bootstrap.Modal('#modal_edit_periode').show();
                } else {
                    alert(response.message);
                }
            },
            error: function(xhr) {
                alert(xhr.responseJSON?.message || 'Terjadi kesalahan');
            }
        });
    });

    // Edit form submission
    $('#form_edit_periode').submit(function(e) {
        e.preventDefault();

        const form = $(this);
        const submitButton = form.find('[type="submit"]');
        const id = $('#edit_id').val();

        submitButton.attr('data-kt-indicator', 'on');
        submitButton.prop('disabled', true);

        $.ajax({
            url: `/admin/periode-monitoring/${id}`,
            type: 'PUT',
            data: form.serialize(),
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
                submitButton.attr('data-kt-indicator', 'off');
                submitButton.prop('disabled', false);
            }
        });
    });
});
</script>
@endpush