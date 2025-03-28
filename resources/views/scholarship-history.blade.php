@extends('layouts.app')

@section('content')
    <!--begin::Content container-->
    <div class="d-flex flex-column flex-column-fluid container-fluid">
        <!--begin::Toolbar-->
        <div class="toolbar mb-5 mb-lg-7" id="kt_toolbar">
            <!--begin::Page title-->
            <div class="page-title d-flex flex-column me-3">
                <!--begin::Title-->
                <h1 class="d-flex text-dark fw-bold my-1 fs-3">Riwayat Pendaftaran Beasiswa</h1>
                <!--end::Title-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-dot fw-semibold text-gray-600 fs-7 my-1">
                    <li class="breadcrumb-item text-gray-600">
                        <a href="{{ route('home') }}" class="text-gray-600 text-hover-primary">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item text-gray-600">Riwayat Pendaftaran</li>
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page title-->
        </div>
        <!--end::Toolbar-->

        <!--begin::Filter Section-->
        <div class="card mb-7">
            <div class="card-body">
                <div class="d-flex flex-stack gap-5">
                    <!--begin::Search-->
                    <div class="d-flex align-items-center position-relative">
                        <i class="ki-outline ki-magnifier fs-3 position-absolute ms-4"></i>
                        <input type="text" class="form-control form-control-solid w-250px ps-12"
                            placeholder="Cari Beasiswa...">
                    </div>
                    <!--end::Search-->

                    <!--begin::Filters-->
                    <div class="d-flex flex-shrink-0 gap-2">
                        <select class="form-select form-select-solid w-150px">
                            <option value="">Status</option>
                            <option value="accepted">Diterima</option>
                            <option value="pending">Sedang Diproses</option>
                            <option value="rejected">Ditolak</option>
                        </select>

                        <select class="form-select form-select-solid w-150px">
                            <option value="">Periode</option>
                            <option value="this_month">Bulan Ini</option>
                            <option value="last_month">Bulan Lalu</option>
                            <option value="last_3_months">3 Bulan Terakhir</option>
                        </select>
                    </div>
                    <!--end::Filters-->
                </div>
            </div>
        </div>
        <!--end::Filter Section-->

        <!--begin::Card-->
        <div class="card">
            <!--begin::Card body-->
            <div class="card-body pt-0">
                <!--begin::Table-->
                <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_scholarships">
                    <thead>
                        <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                            <th class="min-w-125px">Nama Beasiswa</th>
                            <th class="min-w-125px">Institusi</th>
                            <th class="min-w-125px">Tanggal Pendaftaran</th>
                            <th class="min-w-125px">Status</th>
                            <th class="text-end min-w-100px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="fw-semibold text-gray-600">
                        <!--begin::Table row-->
                        <tr>
                            <td>
                                <span class="text-dark fw-bold text-hover-primary fs-6">Beasiswa Unggulan</span>
                            </td>
                            <td>Kemendikbud</td>
                            <td>10 Mar 2025</td>
                            <td>
                                <div class="badge badge-success">Diterima</div>
                            </td>
                            <td class="text-end">
                                <button class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary"
                                    data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                    Aksi
                                    <i class="ki-outline ki-down fs-5 ms-1"></i>
                                </button>
                                <!--begin::Menu-->
                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                    data-kt-menu="true">
                                    <div class="menu-item px-3">
                                        <a href="#" class="menu-link px-3">Lihat Detail</a>
                                    </div>
                                    <div class="menu-item px-3">
                                        <a href="#" class="menu-link px-3">Download SK</a>
                                    </div>
                                </div>
                                <!--end::Menu-->
                            </td>
                        </tr>
                        <!--end::Table row-->

                        <!--begin::Table row-->
                        <tr>
                            <td>
                                <span class="text-dark fw-bold text-hover-primary fs-6">Beasiswa Prestasi</span>
                            </td>
                            <td>Bank Indonesia</td>
                            <td>15 Apr 2025</td>
                            <td>
                                <div class="badge badge-warning">Sedang Diproses</div>
                            </td>
                            <td class="text-end">
                                <a href="#" class="btn btn-sm btn-light btn-active-light-primary">
                                    Lihat Detail
                                </a>
                            </td>
                        </tr>
                        <!--end::Table row-->

                        <!--begin::Table row-->
                        <tr>
                            <td>
                                <span class="text-dark fw-bold text-hover-primary fs-6">Beasiswa PPA</span>
                            </td>
                            <td>Kemdikbud</td>
                            <td>5 Feb 2025</td>
                            <td>
                                <div class="badge badge-danger">Ditolak</div>
                                <div class="fs-7 text-muted">IPK Tidak Mencukupi</div>
                            </td>
                            <td class="text-end">
                                <a href="#" class="btn btn-sm btn-light btn-active-light-primary">
                                    Lihat Detail
                                </a>
                            </td>
                        </tr>
                        <!--end::Table row-->
                    </tbody>
                </table>
                <!--end::Table-->
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Card-->

        <!--begin::Notification Section-->
        <div class="card mt-7">
            <div class="card-header">
                <h3 class="card-title">Pengumuman Terkait</h3>
            </div>
            <div class="card-body">
                <div class="notice d-flex bg-light-primary rounded border-primary border border-dashed p-6">
                    <i class="ki-outline ki-information fs-2tx text-primary me-4"></i>
                    <div class="d-flex flex-stack flex-grow-1">
                        <div class="fw-semibold">
                            <h4 class="text-gray-900 fw-bold">Wawancara Beasiswa Prestasi</h4>
                            <div class="fs-6 text-gray-700">Anda terjadwal untuk wawancara Beasiswa Prestasi Bank Indonesia
                                pada tanggal 20 April 2025. Silakan persiapkan dokumen yang diperlukan.</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Notification Section-->
    </div>
    <!--end::Content container-->
@endsection

@push('scripts')
    <script>
        // Initialize DataTable
        $(document).ready(function() {
            const table = $('#kt_table_scholarships').DataTable({
                "pageLength": 10,
                "order": [
                    [2, "desc"]
                ],
                "language": {
                    "lengthMenu": "Show _MENU_",
                }
            });
        });
    </script>
@endpush
