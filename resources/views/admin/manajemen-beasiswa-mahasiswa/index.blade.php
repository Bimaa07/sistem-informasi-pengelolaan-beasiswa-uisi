@extends('layouts.admin')

@section('content')
<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
    <div class="d-flex flex-column flex-column-fluid">
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                        Manajemen Beasiswa Mahasiswa
                    </h1>
                </div>
            </div>
        </div>

        <div id="kt_app_content" class="app-content flex-column-fluid">
            <div id="kt_app_content_container" class="app-container container-fluid">
                <div class="card">
                    <div class="card-header border-0 pt-6">
                        <div class="card-title">
                            <div class="d-flex align-items-center position-relative my-1">
                                <span class="svg-icon svg-icon-1 position-absolute ms-6">
                                    <i class="ki-outline ki-magnifier fs-3"></i>
                                </span>
                                <input type="text" class="form-control form-control-solid w-250px ps-14" id="search"
                                    name="search" placeholder="Cari Mahasiswa..." />
                            </div>
                        </div>
                    </div>

                    <div class="card-body pt-0">
                        <table class="table align-middle table-row-dashed fs-6 gy-5" id="mahasiswa_table">
                            <thead>
                                <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                    <th>NIM</th>
                                    <th>Nama</th>
                                    <th>Program Studi</th>
                                    <th>Beasiswa</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 fw-semibold">
                                @forelse($mahasiswa as $mhs)
                                <tr>
                                    <td>{{ $mhs->nim }}</td>
                                    <td>{{ $mhs->nama }}</td>
                                    <td>{{ $mhs->program_studi }}</td>
                                    <!-- Update the beasiswa status column -->
                                    <td>
                                        @if($mhs->penerimaBeasiswa->count() > 0)
                                        @php $latest = $mhs->penerimaBeasiswa->last() @endphp
                                        <div class="d-flex align-items-center">
                                            @if($latest->status === 'aktif')
                                            <span class="badge badge-light-success me-2">{{ $latest->beasiswa->nama
                                                }}</span>
                                            <button type="button"
                                                class="btn btn-sm btn-icon btn-light-danger nonaktif-beasiswa"
                                                data-id="{{ $latest->id }}" data-bs-toggle="tooltip"
                                                title="Nonaktifkan Beasiswa">
                                                <i class="ki-outline ki-cross-circle fs-2"></i>
                                            </button>
                                            @else
                                            <span class="badge badge-light-warning me-2">{{ $latest->beasiswa->nama }}
                                                ({{ ucfirst($latest->status)
                                                }})</span>
                                            <button type="button"
                                                class="btn btn-sm btn-icon btn-light-success aktif-beasiswa"
                                                data-id="{{ $latest->id }}" data-bs-toggle="tooltip"
                                                title="Aktifkan Kembali">
                                                <i class="ki-outline ki-check-circle fs-2"></i>
                                            </button>
                                            @endif
                                        </div>
                                        @else
                                        <button type="button" class="btn btn-sm btn-light-primary btn-set-beasiswa"
                                            data-mahasiswa-id="{{ $mhs->id }}" data-mahasiswa-nama="{{ $mhs->nama }}">
                                            <i class="ki-outline ki-plus-square fs-2"></i>
                                            Atur Beasiswa
                                        </button>
                                        @endif
                                    </td>
                                    <td>
                                        {{-- <button type="button" class="btn btn-sm btn-icon btn-light-info"
                                            data-bs-toggle="tooltip" data-bs-placement="top" title="Detail Mahasiswa">
                                            <i class="ki-outline ki-eye fs-2"></i>
                                        </button> --}}
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center text-gray-500">
                                        Tidak ada data mahasiswa
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>

                        <div class="d-flex justify-content-end mt-6">
                            {{ $mahasiswa->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Set Beasiswa -->
<div class="modal fade" tabindex="-1" id="modal_set_beasiswa">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="form_set_beasiswa">
                <div class="modal-header">
                    <h3 class="modal-title">Atur Beasiswa Mahasiswa</h3>
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i class="ki-outline ki-cross fs-1"></i>
                    </div>
                </div>

                <div class="modal-body">
                    <input type="hidden" name="mahasiswa_id" id="mahasiswa_id">

                    <div class="mb-5">
                        <label class="form-label">Nama Mahasiswa</label>
                        <input type="text" class="form-control" id="mahasiswa_nama" readonly>
                    </div>

                    <div class="mb-5">
                        <label class="form-label required">Pilih Beasiswa</label>
                        <select class="form-select" name="beasiswa_id" required>
                            <option value="">Pilih Beasiswa...</option>
                            @foreach ($beasiswa as $b)
                            <option value="{{ $b->id }}">{{ $b->nama }} ({{ ucfirst($b->jenis) }})
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-5">
                        <label class="form-label">Keterangan (Opsional)</label>
                        <textarea name="keterangan" class="form-control" rows="3"
                            placeholder="Tambahkan catatan atau keterangan..."></textarea>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">
                        <span class="indicator-label">
                            Simpan
                        </span>
                        <span class="indicator-progress">
                            Menyimpan... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Alert Modal -->
<div class="modal fade" tabindex="-1" id="kt_modal_alert">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="kt_modal_alert_title">Pemberitahuan</h3>
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                    aria-label="Close">
                    <i class="ki-outline ki-cross fs-1"></i>
                </div>
            </div>

            <div class="modal-body">
                <div class="text-center">
                    <i id="kt_modal_alert_icon" class="ki-outline ki-information-5 fs-5x text-primary mb-5"></i>
                    <p class="fw-semibold fs-6" id="kt_modal_alert_message"></p>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>

<!-- Confirmation Modal -->
<div class="modal fade" tabindex="-1" id="kt_modal_confirm">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="kt_modal_confirm_title">Konfirmasi</h3>
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                    aria-label="Close">
                    <i class="ki-outline ki-cross fs-1"></i>
                </div>
            </div>

            <div class="modal-body">
                <div class="text-center">
                    <i class="ki-outline ki-question fs-5x text-warning mb-5"></i>
                    <p class="fw-semibold fs-6" id="kt_modal_confirm_message"></p>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="kt_modal_confirm_submit">Ya</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
    // Initialize modals
    const setBeasiswaModal = new bootstrap.Modal(document.getElementById('modal_set_beasiswa'));
    const alertModal = new bootstrap.Modal(document.getElementById('kt_modal_alert'));
    const confirmModal = new bootstrap.Modal(document.getElementById('kt_modal_confirm'));

    // Helper function to show alert modal
    function showAlert(message, type = 'info') {
        const modal = document.getElementById('kt_modal_alert');
        const icon = document.getElementById('kt_modal_alert_icon');
        const messageEl = document.getElementById('kt_modal_alert_message');

        // Set icon and color based on type
        let iconClass = 'ki-information-5 text-primary';
        if (type === 'success') iconClass = 'ki-check-circle text-success';
        if (type === 'error') iconClass = 'ki-cross-circle text-danger';

        icon.className = `ki-outline ${iconClass} fs-5x mb-5`;
        messageEl.textContent = message;

        alertModal.show();
    }

    // Helper function to show confirmation modal
    function showConfirm(message, callback) {
        const messageEl = document.getElementById('kt_modal_confirm_message');
        const submitBtn = document.getElementById('kt_modal_confirm_submit');

        messageEl.textContent = message;

        // Remove existing event listener
        submitBtn.replaceWith(submitBtn.cloneNode(true));

        // Add new event listener
        document.getElementById('kt_modal_confirm_submit').addEventListener('click', function() {
            confirmModal.hide();
            callback();
        });

        confirmModal.show();
    }

    // Search functionality with debounce
    let timeoutId = null;
    $('#search').on('keyup', function() {
        clearTimeout(timeoutId);
        timeoutId = setTimeout(() => {
            const searchValue = $(this).val();
            const url = new URL(window.location.href);
            url.searchParams.set('search', searchValue);
            window.location.href = url.toString();
        }, 500);
    });

    // Set Beasiswa button click
    $('.btn-set-beasiswa').click(function() {
        const mahasiswaId = $(this).data('mahasiswa-id');
        const mahasiswaNama = $(this).data('mahasiswa-nama');

        $('#mahasiswa_id').val(mahasiswaId);
        $('#mahasiswa_nama').val(mahasiswaNama);

        setBeasiswaModal.show();
    });

    // Form submission handler
    $('#form_set_beasiswa').submit(function(e) {
        e.preventDefault();

        const form = $(this);
        const submitButton = form.find('[type="submit"]');

        submitButton.attr('data-kt-indicator', 'on');
        submitButton.prop('disabled', true);

        $.ajax({
            url: "{{ route('admin.manajemen-beasiswa-mahasiswa.store') }}",
            type: 'POST',
            data: {
                _token: "{{ csrf_token() }}",
                mahasiswa_id: $('#mahasiswa_id').val(),
                beasiswa_id: $('[name="beasiswa_id"]').val(),
                keterangan: $('[name="keterangan"]').val()
            },
            success: function(response) {
                if (response.success) {
                    setBeasiswaModal.hide();
                    showAlert(response.message, 'success');
                    setTimeout(() => window.location.reload(), 1500);
                } else {
                    showAlert(response.message, 'error');
                }
            },
            error: function(xhr) {
                showAlert(xhr.responseJSON?.message || 'Terjadi kesalahan', 'error');
            },
            complete: function() {
                submitButton.attr('data-kt-indicator', 'off');
                submitButton.prop('disabled', false);
            }
        });
    });

    // Deactivate scholarship handler
    $('.nonaktif-beasiswa').click(function() {
        const id = $(this).data('id');

        showConfirm('Apakah Anda yakin ingin menonaktifkan beasiswa ini?', function() {
            $.ajax({
                url: `/admin/manajemen-beasiswa-mahasiswa/${id}/nonaktif`,
                type: 'POST',
                data: { _token: "{{ csrf_token() }}" },
                success: function(response) {
                    if (response.success) {
                        showAlert(response.message, 'success');
                        setTimeout(() => window.location.reload(), 1500);
                    } else {
                        showAlert(response.message, 'error');
                    }
                },
                error: function(xhr) {
                    showAlert(xhr.responseJSON?.message || 'Terjadi kesalahan', 'error');
                }
            });
        });
    });

    // Activate scholarship handler
    $('.aktif-beasiswa').click(function() {
        const id = $(this).data('id');

        showConfirm('Apakah Anda yakin ingin mengaktifkan kembali beasiswa ini?', function() {
            $.ajax({
                url: `/admin/manajemen-beasiswa-mahasiswa/${id}/aktif`,
                type: 'POST',
                data: { _token: "{{ csrf_token() }}" },
                success: function(response) {
                    if (response.success) {
                        showAlert(response.message, 'success');
                        setTimeout(() => window.location.reload(), 1500);
                    } else {
                        showAlert(response.message, 'error');
                    }
                },
                error: function(xhr) {
                    showAlert(xhr.responseJSON?.message || 'Terjadi kesalahan', 'error');
                }
            });
        });
    });

    // Initialize tooltips
    $('[data-bs-toggle="tooltip"]').tooltip();
});
</script>
@endpush