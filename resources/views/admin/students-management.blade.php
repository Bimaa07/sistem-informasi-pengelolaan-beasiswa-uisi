@extends('layouts.admin')

@section('content')
    <!--begin::Content container-->
    <div class="container-fluid">
        <!--begin::Page title-->
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 pt-4 pb-4">
            <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                Manajemen Mahasiswa
            </h1>
            <div class="breadcrumb fw-semibold fs-7 my-0 pt-1">
                <span class="text-muted">Dashboard</span>
                <i class="ki-outline ki-right fs-7 text-muted mx-3"></i>
                <span class="text-muted">Manajemen Mahasiswa</span>
            </div>
        </div>
        <!--end::Page title-->

        <!--begin::Card-->
        <div class="card">
            <!--begin::Card header-->
            <div class="card-header border-0 pt-6">
                <!--begin::Card title-->
                <div class="card-title">
                    <!--begin::Search-->
                    <div class="d-flex align-items-center position-relative my-1">
                        <i class="ki-outline ki-magnifier fs-3 position-absolute ms-5"></i>
                        <input type="text" class="form-control form-control-solid w-250px ps-12"
                            placeholder="Cari Mahasiswa...">
                    </div>
                    <!--end::Search-->
                </div>
                <!--end::Card title-->

                <!--begin::Card toolbar-->
                <div class="card-toolbar">
                    <!--begin::Toolbar-->
                    <div class="d-flex justify-content-end">
                        <!--begin::Filter-->
                        <button type="button" class="btn btn-light-primary me-3" data-kt-menu-trigger="click">
                            <i class="ki-outline ki-filter fs-2"></i>Filter
                        </button>
                        <!--end::Filter-->

                        <!--begin::Export-->
                        <button type="button" class="btn btn-light-primary me-3">
                            <i class="ki-outline ki-exit-down fs-2"></i>Export
                        </button>
                        <!--end::Export-->

                        <!--begin::Refresh-->
                        <button type="button" class="btn btn-light-primary">
                            <i class="ki-outline ki-arrows-circle fs-2"></i>Refresh
                        </button>
                        <!--end::Refresh-->
                    </div>
                    <!--end::Toolbar-->
                </div>
                <!--end::Card toolbar-->
            </div>
            <!--end::Card header-->

            <!--begin::Card body-->
            <div class="card-body py-4">
                <!--begin::Table-->
                <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_mahasiswa">
                    <thead>
                        <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                            <th>Nama Mahasiswa</th>
                            <th>NIM</th>
                            <th>Program Studi</th>
                            <th>Semester</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 fw-semibold">
                        <tr>
                            <td>Rafli Setiawan</td>
                            <td>21111001</td>
                            <td>Sistem Informasi</td>
                            <td>6</td>
                            <td><span class="badge badge-light-success">Terverifikasi</span></td>
                            <td>
                                <button type="button" class="btn btn-sm btn-icon btn-light-primary me-2"
                                    data-bs-toggle="modal" data-bs-target="#kt_modal_detail">
                                    <i class="ki-outline ki-eye fs-2"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-icon btn-light-danger">
                                    <i class="ki-outline ki-lock fs-2"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>Siti Aminah</td>
                            <td>21111002</td>
                            <td>Teknik Industri</td>
                            <td>4</td>
                            <td><span class="badge badge-light-warning">Belum Diverifikasi</span></td>
                            <td>
                                <button type="button" class="btn btn-sm btn-icon btn-light-primary me-2"
                                    data-bs-toggle="modal" data-bs-target="#kt_modal_detail">
                                    <i class="ki-outline ki-eye fs-2"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-icon btn-light-success">
                                    <i class="ki-outline ki-check fs-2"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <!--end::Table-->
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Card-->
    </div>
    <!--end::Content container-->

    <!--begin::Modal - Detail Mahasiswa-->
    <div class="modal fade" id="kt_modal_detail" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <div class="modal-content">
                <div class="modal-header">
                    <h2>Detail Mahasiswa</h2>
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                        <i class="ki-outline ki-cross fs-1"></i>
                    </div>
                </div>

                <div class="modal-body py-10 px-lg-17">
                    <!--begin::Details-->
                    <div class="d-flex flex-column mb-8">
                        <div class="row mb-5">
                            <label class="col-4 fw-semibold text-muted">Nama Lengkap</label>
                            <div class="col-8">
                                <span class="fw-bold fs-6 text-gray-800">Bima Fahrudin Yusup</span>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <label class="col-4 fw-semibold text-muted">NIM</label>
                            <div class="col-8">
                                <span class="fw-bold fs-6 text-gray-800">123456789</span>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <label class="col-4 fw-semibold text-muted">Program Studi</label>
                            <div class="col-8">
                                <span class="fw-bold fs-6 text-gray-800">Informatika</span>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <label class="col-4 fw-semibold text-muted">Email</label>
                            <div class="col-8">
                                <span class="fw-bold fs-6 text-gray-800">rafli@example.com</span>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <label class="col-4 fw-semibold text-muted">IPK</label>
                            <div class="col-8">
                                <span class="fw-bold fs-6 text-gray-800">3.85</span>
                            </div>
                        </div>
                    </div>
                    <!--end::Details-->

                    <!--begin::Documents-->
                    <div class="mb-8">
                        <h3 class="mb-4">Dokumen Pendukung</h3>
                        <div class="d-flex flex-column">
                            <div class="d-flex align-items-center mb-3">
                                <i class="ki-outline ki-file fs-2 me-3 text-primary"></i>
                                <div class="d-flex flex-column">
                                    <a href="#" class="text-gray-800 text-hover-primary">KHS_Semester_5.pdf</a>
                                    <span class="text-muted">Uploaded 2 days ago</span>
                                </div>
                            </div>
                            <div class="d-flex align-items-center">
                                <i class="ki-outline ki-file fs-2 me-3 text-primary"></i>
                                <div class="d-flex flex-column">
                                    <a href="#" class="text-gray-800 text-hover-primary">Surat_Aktif_Kuliah.pdf</a>
                                    <span class="text-muted">Uploaded 2 days ago</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Documents-->
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary">Verifikasi</button>
                </div>
            </div>
        </div>
    </div>
    <!--end::Modal-->

    @push('scripts')
        <script>
            $(document).ready(function() {
                $("#kt_table_mahasiswa").DataTable({
                    "language": {
                        "lengthMenu": "Show _MENU_",
                    },
                    "dom": "<'row'" +
                        "<'col-sm-6 d-flex align-items-center justify-content-start'l>" +
                        "<'col-sm-6 d-flex align-items-center justify-content-end'f>" +
                        ">" +
                        "<'table-responsive'tr>" +
                        "<'row'" +
                        "<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'i>" +
                        "<'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>" +
                        ">"
                });
            });
        </script>
    @endpush
@endsection
