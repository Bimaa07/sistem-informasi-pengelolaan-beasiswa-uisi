@extends('layouts.app')

@section('content')
<!--begin::Toolbar-->
<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
    <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
            <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                Monitoring dan Evaluasi Beasiswa
            </h1>
            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                <li class="breadcrumb-item text-muted">
                    <a href="{{ route('home') }}" class="text-muted text-hover-primary">Beranda</a>
                </li>
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-400 w-5px h-2px"></span>
                </li>
                <li class="breadcrumb-item text-muted">Monitoring Evaluasi</li>
            </ul>
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

        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <div class="card">
            <div class="card-header border-0 pt-6">
                <div class="card-title">
                    <div class="d-flex align-items-center position-relative my-1">
                        <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-5">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                        <input type="text" data-kt-monitoring-table-filter="search"
                            class="form-control form-control-solid w-250px ps-13"
                            placeholder="Cari Periode Monitoring" />
                    </div>
                </div>
            </div>

            <div class="card-body pt-0">
                <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_monitoring_table">
                    <thead>
                        <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                            <th class="min-w-125px">Tahun Ajaran</th>
                            <th class="min-w-125px">Semester</th>
                            <th class="min-w-125px">Tanggal Mulai</th>
                            <th class="min-w-125px">Status Pengisian</th>
                            <th class="text-end min-w-70px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="fw-semibold text-gray-600">
                        @if($activePeriod)
                            <tr>
                                <td>{{ $activePeriod->tahun_ajaran }}</td>
                                <td>{{ $activePeriod->semester_akademik }}</td>
                                <td>{{ \Carbon\Carbon::parse($activePeriod->tanggal_mulai)->format('d F Y') }}</td>
                                <td>
                                    @if($monitoringEvaluasi)
                                        <span class="badge badge-light-{{ $monitoringEvaluasi->status === 'diterima' ? 'success' :
                                            ($monitoringEvaluasi->status === 'ditolak' ? 'danger' : 'warning') }}">
                                            {{ ucfirst($monitoringEvaluasi->status) }}
                                        </span>
                                    @else
                                        <span class="badge badge-light-primary">Belum Mengisi</span>
                                    @endif
                                </td>
                                <td class="text-end">
                                    @if(!$monitoringEvaluasi)
                                        <a href="#" class="btn btn-sm btn-primary" data
                                            data-bs-toggle="modal" data-bs-target="#kt_modal_monitoring">
                                            <i class="ki-duotone ki-plus-square fs-2">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                            Isi Monitoring
                                        </a>
                                    @else
                                        <a href="{{ route('mahasiswa.monitoring-evaluasi.show', $monitoringEvaluasi->id) }}"
                                            class="btn btn-sm btn-light-primary">
                                            <i class="ki-duotone ki-eye fs-2">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                            Lihat Detail
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @else
                            <tr>
                                <td colspan="5" class="text-center">Tidak ada periode monitoring yang aktif saat ini</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!--end::Content-->

<!--begin::Modal-->
<div class="modal fade" id="kt_modal_monitoring" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <form class="form" action="{{ route('mahasiswa.monitoring-evaluasi.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h2 class="fw-bold">Isi Form Monitoring Evaluasi</h2>
                    <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                        <i class="ki-duotone ki-cross fs-1">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                    </div>
                </div>

                <div class="modal-body py-10 px-lg-17">
                    <div class="row mb-5">
                        <div class="col-md-4">
                            <label class="required fw-semibold fs-6 mb-2">IPS</label>
                            <input type="number" name="ips" class="form-control form-control-solid"
                                step="0.01" min="0" max="4" required />
                        </div>
                        <div class="col-md-4">
                            <label class="required fw-semibold fs-6 mb-2">IPK</label>
                            <input type="number" name="ipk" class="form-control form-control-solid"
                                step="0.01" min="0" max="4" required />
                        </div>
                        <div class="col-md-4">
                            <label class="required fw-semibold fs-6 mb-2">Semester</label>
                            <input type="number" name="semester" class="form-control form-control-solid"
                                min="1" max="8" required />
                        </div>
                    </div>

                    <div class="row mb-5">
                        <div class="col-md-6">
                            <label class="required fw-semibold fs-6 mb-2">File KHS</label>
                            <input type="file" name="file_khs" class="form-control form-control-solid"
                                accept=".pdf" required />
                            <div class="form-text">Format file: PDF, Maksimal 2MB</div>
                        </div>
                        <div class="col-md-6">
                            <label class="fw-semibold fs-6 mb-2">File Sertifikat</label>
                            <input type="file" name="file_sertifikat" class="form-control form-control-solid"
                                accept=".pdf" />
                            <div class="form-text">Format file: PDF, Maksimal 2MB (Opsional)</div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer flex-center">
                    <button type="button" class="btn btn-light me-3" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">
                        <span class="indicator-label">Kirim</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--end::Modal-->
@endsection

@push('scripts')
<script>
// Search functionality
var table = document.querySelector('#kt_monitoring_table');
var searchInput = document.querySelector('[data-kt-monitoring-table-filter="search"]');
var rows = table.querySelectorAll('tbody tr');

searchInput.addEventListener('keyup', function(e) {
    var text = e.target.value.toLowerCase();

    rows.forEach(row => {
        var visible = false;
        row.querySelectorAll('td').forEach(cell => {
            if (cell.textContent.toLowerCase().indexOf(text) > -1) {
                visible = true;
            }
        });
        row.style.display = visible ? '' : 'none';
    });
});

// Auto-hide alerts
setTimeout(function() {
    document.querySelectorAll('.alert').forEach(function(alert) {
        if (alert.querySelector('.btn-close')) {
            alert.querySelector('.btn-close').click();
        }
    });
}, 5000);
</script>
@endpush
