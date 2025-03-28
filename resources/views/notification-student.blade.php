@extends('layouts.app')

@section('content')
    <!--begin::Content container-->
    <div class="d-flex flex-column flex-column-fluid container-fluid">
        <!--begin::Toolbar-->
        <div class="toolbar mb-5 mb-lg-7" id="kt_toolbar">
            <!--begin::Page title-->
            <div class="page-title d-flex flex-column me-3">
                <!--begin::Title-->
                <h1 class="d-flex text-dark fw-bold my-1 fs-3">
                    Notifikasi Beasiswa
                    <span class="badge badge-circle badge-danger ms-2">3</span>
                </h1>
                <!--end::Title-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-dot fw-semibold text-gray-600 fs-7 my-1">
                    <li class="breadcrumb-item text-gray-600">
                        <a href="{{ route('home') }}" class="text-gray-600 text-hover-primary">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item text-gray-600">Notifikasi</li>
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page title-->

            <!--begin::Actions-->
            <div class="d-flex align-items-center gap-2">
                <button type="button" class="btn btn-sm btn-light-primary">
                    <i class="ki-outline ki-check fs-7 me-1"></i>Tandai Semua Dibaca
                </button>
                <button type="button" class="btn btn-sm btn-light-danger">
                    <i class="ki-outline ki-trash fs-7 me-1"></i>Hapus Semua
                </button>
            </div>
            <!--end::Actions-->
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
                            placeholder="Cari notifikasi...">
                    </div>
                    <!--end::Search-->

                    <!--begin::Filters-->
                    <div class="d-flex flex-shrink-0 gap-2">
                        <select class="form-select form-select-solid w-150px">
                            <option value="">Semua Status</option>
                            <option value="unread">Belum Dibaca</option>
                            <option value="read">Sudah Dibaca</option>
                        </select>

                        <select class="form-select form-select-solid w-150px">
                            <option value="">Kategori</option>
                            <option value="status">Status Beasiswa</option>
                            <option value="announcement">Pengumuman</option>
                            <option value="document">Dokumen</option>
                        </select>

                        <select class="form-select form-select-solid w-150px">
                            <option value="">Periode</option>
                            <option value="today">Hari Ini</option>
                            <option value="week">Minggu Ini</option>
                            <option value="month">Bulan Ini</option>
                        </select>
                    </div>
                    <!--end::Filters-->
                </div>
            </div>
        </div>
        <!--end::Filter Section-->

        <!--begin::Notifications List-->
        <div class="card">
            <div class="card-body p-0">
                <!--begin::Notifications-->
                <div class="table-responsive">
                    <table class="table table-flush align-middle table-row-bordered table-row-solid gy-4 gs-9">
                        <tbody>
                            <!--begin::Notification Item-->
                            <tr>
                                <td class="min-w-25px">
                                    <div class="symbol symbol-35px me-3">
                                        <span class="symbol-label bg-light-success">
                                            <i class="ki-outline ki-check-circle fs-2 text-success"></i>
                                        </span>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <a href="#"
                                            class="text-gray-800 text-hover-primary mb-1 fw-bold fs-6">Selamat! Anda
                                            diterima di Beasiswa Prestasi</a>
                                        <span class="text-gray-400 fw-semibold fs-7">Silakan unduh SK Penerimaan dan lakukan
                                            penandatanganan kontrak sebelum 20 Maret 2025</span>
                                    </div>
                                </td>
                                <td class="text-end">
                                    <span class="text-gray-800 fw-bold fs-6 me-2">10 Mar 2025</span>
                                    <span class="badge badge-light">Sudah Dibaca</span>
                                </td>
                            </tr>
                            <!--end::Notification Item-->

                            <!--begin::Notification Item-->
                            <tr class="bg-light-warning bg-opacity-75">
                                <td class="min-w-25px">
                                    <div class="symbol symbol-35px me-3">
                                        <span class="symbol-label bg-light-warning">
                                            <i class="ki-outline ki-abstract-26 fs-2 text-warning"></i>
                                        </span>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <a href="#" class="text-gray-800 text-hover-primary mb-1 fw-bold fs-6">Dokumen
                                            Tambahan Diperlukan</a>
                                        <span class="text-gray-400 fw-semibold fs-7">Mohon lengkapi berkas surat rekomendasi
                                            untuk Beasiswa Unggulan</span>
                                    </div>
                                </td>
                                <td class="text-end">
                                    <span class="text-gray-800 fw-bold fs-6 me-2">8 Mar 2025</span>
                                    <span class="badge badge-warning">Belum Dibaca</span>
                                </td>
                            </tr>
                            <!--end::Notification Item-->

                            <!--begin::Notification Item-->
                            <tr>
                                <td class="min-w-25px">
                                    <div class="symbol symbol-35px me-3">
                                        <span class="symbol-label bg-light-danger">
                                            <i class="ki-outline ki-cross-circle fs-2 text-danger"></i>
                                        </span>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <a href="#"
                                            class="text-gray-800 text-hover-primary mb-1 fw-bold fs-6">Pendaftaran Beasiswa
                                            PPA Tidak Lolos Seleksi</a>
                                        <span class="text-gray-400 fw-semibold fs-7">IPK tidak memenuhi syarat minimal.
                                            Silakan coba di periode berikutnya.</span>
                                    </div>
                                </td>
                                <td class="text-end">
                                    <span class="text-gray-800 fw-bold fs-6 me-2">5 Mar 2025</span>
                                    <span class="badge badge-light">Sudah Dibaca</span>
                                </td>
                            </tr>
                            <!--end::Notification Item-->
                        </tbody>
                    </table>
                </div>
                <!--end::Notifications-->
            </div>
        </div>
        <!--end::Notifications List-->

        <!--begin::Preferences Card-->
        <div class="card mt-7">
            <div class="card-header">
                <h3 class="card-title">Pengaturan Notifikasi</h3>
            </div>
            <div class="card-body">
                <div class="d-flex flex-column gap-5">
                    <div class="d-flex flex-stack">
                        <div>
                            <div class="fs-5 fw-bold">Notifikasi Email</div>
                            <div class="fs-7 text-gray-600">Terima notifikasi melalui email</div>
                        </div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="emailNotif" checked>
                        </div>
                    </div>
                    <div class="d-flex flex-stack">
                        <div>
                            <div class="fs-5 fw-bold">Notifikasi Status Beasiswa</div>
                            <div class="fs-7 text-gray-600">Update tentang status pendaftaran beasiswa</div>
                        </div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="statusNotif" checked>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Preferences Card-->
    </div>
    <!--end::Content container-->
@endsection

@push('scripts')
    <script>
        // Initialize notification features
        $(document).ready(function() {
            // Mark all as read
            $('.btn-light-primary').click(function() {
                // Add your logic here
                toastr.success('Semua notifikasi telah ditandai sebagai dibaca');
            });

            // Delete all notifications
            $('.btn-light-danger').click(function() {
                // Add your confirmation dialog here
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Semua notifikasi akan dihapus",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Add your delete logic here
                        toastr.success('Semua notifikasi telah dihapus');
                    }
                });
            });
        });
    </script>
@endpush
