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
                                    <input type="text" class="form-control form-control-solid w-250px ps-14"
                                        id="search" name="search" placeholder="Cari Mahasiswa..." />
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
                                            <td>
                                                <button type="button" class="btn btn-sm btn-light-primary btn-set-beasiswa"
                                                    data-mahasiswa-id="{{ $mhs->id }}"
                                                    data-mahasiswa-nama="{{ $mhs->nama }}">
                                                    <i class="ki-outline ki-plus-square fs-2"></i>
                                                    Atur Beasiswa
                                                </button>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-icon btn-light-info"
                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="Detail Mahasiswa">
                                                    <i class="ki-outline ki-eye fs-2"></i>
                                                </button>
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
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            const modal = new bootstrap.Modal(document.getElementById('modal_set_beasiswa'));

            // Search functionality
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

                modal.show();
            });

            // Form submission
            $('#form_set_beasiswa').submit(function(e) {
                e.preventDefault();

                const submitButton = $(this).find('[type="submit"]');
                submitButton.attr('data-kt-indicator', 'on');

                $.ajax({
                    url: "{{ route('admin.manajemen-beasiswa-mahasiswa.store') }}",
                    type: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        mahasiswa_id: $('#mahasiswa_id').val(),
                        beasiswa_id: $('[name="beasiswa_id"]').val()
                    },
                    success: function(response) {
                        if (response.success) {
                            modal.hide();
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
                    }
                });
            });
        });
    </script>
@endpush
