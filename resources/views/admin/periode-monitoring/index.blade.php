@extends('layouts.admin')

@section('content')
<!--begin::Toolbar-->
<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
    <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
            <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                Manajemen Periode Monitoring
            </h1>
            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                <li class="breadcrumb-item text-muted">
                    <a href="{{ route('admin.dashboard') }}" class="text-muted text-hover-primary">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-400 w-5px h-2px"></span>
                </li>
                <li class="breadcrumb-item text-muted">Periode Monitoring</li>
            </ul>
        </div>
    </div>
</div>
<!--end::Toolbar-->

<!--begin::Content-->
<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container container-fluid">
        <div class="card">
            <div class="card-header border-0 pt-6">
                <div class="card-title">
                    <div class="d-flex align-items-center position-relative my-1">
                        <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-5">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                        <input type="text" data-kt-period-table-filter="search"
                            class="form-control form-control-solid w-250px ps-13"
                            placeholder="Cari Periode Monitoring" />
                    </div>
                </div>
                <div class="card-toolbar">
                    <div class="d-flex justify-content-end" data-kt-period-table-toolbar="base">
                        <a href="{{ route('admin.periode-monitoring.create') }}" class="btn btn-primary">
                            <i class="ki-duotone ki-plus fs-2"></i>
                            Tambah Periode
                        </a>
                    </div>
                </div>
            </div>

            <div class="card-body pt-0">
                @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif

                @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
                @endif

                <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_periods_table">
                    <thead>
                        <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                            <th class="min-w-125px">Tahun Ajaran</th>
                            <th class="min-w-125px">Semester</th>
                            <th class="min-w-125px">Tanggal Mulai</th>
                            <th class="min-w-125px">Status</th>
                            <th class="text-end min-w-70px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="fw-semibold text-gray-600">
                        @forelse ($periods as $period)
                        <tr>
                            <td>{{ $period->tahun_ajaran }}</td>
                            <td>{{ $period->semester_akademik }}</td>
                            <td>{{ \Carbon\Carbon::parse($period->tanggal_mulai)->format('d F Y') }}</td>
                            <td>
                                <div class="badge badge-{{ $period->status === 'Dibuka' ? 'success' : 'danger' }}">
                                    {{ $period->status }}
                                </div>
                            </td>
                            <td class="text-end">
                                <div class="d-flex justify-content-end">
                                    <a href="{{ route('admin.periode-monitoring.edit', $period->id) }}"
                                        class="btn btn-icon btn-primary me-2">
                                        <i class="ki-duotone ki-pencil fs-2">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </a>
                                    <form action="{{ route('admin.periode-monitoring.destroy', $period->id) }}"
                                        method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-icon btn-danger"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus periode ini?')">
                                            <i class="ki-duotone ki-trash fs-2">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="path3"></span>
                                                <span class="path4"></span>
                                                <span class="path5"></span>
                                            </i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">Tidak ada data periode monitoring</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!--end::Content-->
@endsection

@push('scripts')
<script>
// Search functionality
var searchInput = document.querySelector('[data-kt-period-table-filter="search"]');
var tableRows = document.querySelectorAll('#kt_periods_table tbody tr');

searchInput.addEventListener('keyup', function(e) {
    var searchText = e.target.value.toLowerCase();

    tableRows.forEach(function(row) {
        var text = row.textContent.toLowerCase();
        row.style.display = text.includes(searchText) ? '' : 'none';
    });
});
</script>
@endpush
