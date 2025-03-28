@extends('layouts.app')

@section('content')
    <!--begin::Content container-->
    <div class="d-flex flex-column flex-column-fluid container-fluid">
        <!--begin::Toolbar-->
        <div class="toolbar mb-5 mb-lg-7" id="kt_toolbar">
            <!--begin::Page title-->
            <div class="page-title d-flex flex-column me-3">
                <!--begin::Title-->
                <h1 class="d-flex text-dark fw-bold my-1 fs-3">Daftar Beasiswa yang Tersedia</h1>
                <!--end::Title-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-dot fw-semibold text-gray-600 fs-7 my-1">
                    <li class="breadcrumb-item text-gray-600">
                        <a href="{{ route('home') }}" class="text-gray-600 text-hover-primary">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item text-gray-600">Beasiswa Tersedia</li>
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page title-->
        </div>
        <!--end::Toolbar-->

        <!--begin::Filter Section-->
        <div class="card mb-7">
            <div class="card-body">
                <div class="d-flex flex-stack gap-5 gap-lg-10">
                    <!--begin::Search-->
                    <div class="d-flex align-items-center position-relative me-4">
                        <i class="ki-outline ki-magnifier fs-3 position-absolute ms-4"></i>
                        <input type="text" class="form-control form-control-solid w-250px ps-12"
                            placeholder="Cari Beasiswa...">
                    </div>
                    <!--end::Search-->

                    <!--begin::Filters-->
                    <div class="d-flex flex-shrink-0 gap-2">
                        <select class="form-select form-select-solid w-150px">
                            <option value="">Kategori</option>
                            <option value="academic">Akademik</option>
                            <option value="non-academic">Non-Akademik</option>
                            <option value="economic">Ekonomi</option>
                            <option value="achievement">Prestasi</option>
                        </select>

                        <select class="form-select form-select-solid w-150px">
                            <option value="">Institusi</option>
                            <option value="uisi">UISI</option>
                            <option value="dikti">DIKTI</option>
                            <option value="bumn">BUMN</option>
                        </select>

                        <select class="form-select form-select-solid w-150px">
                            <option value="">Deadline</option>
                            <option value="this_week">Minggu Ini</option>
                            <option value="this_month">Bulan Ini</option>
                            <option value="next_month">Bulan Depan</option>
                        </select>
                    </div>
                    <!--end::Filters-->
                </div>
            </div>
        </div>
        <!--end::Filter Section-->

        <!--begin::Scholarships Grid-->
        <div class="row g-6 g-xl-9">
            <!--begin::Scholarship Card-->
            <div class="col-md-6 col-xl-4">
                <div class="card h-100">
                    <!--begin::Badge-->
                    <div class="position-absolute top-0 start-50 translate-middle-x">
                        <span class="badge badge-primary mt-n3">Unggulan</span>
                    </div>
                    <!--end::Badge-->

                    <div class="card-body d-flex flex-column">
                        <!--begin::Title-->
                        <div class="fs-3 fw-bold text-dark mb-5">Beasiswa BUMN</div>
                        <!--end::Title-->

                        <!--begin::Info-->
                        <div class="fs-6 fw-semibold text-gray-600 mb-5">
                            <div class="d-flex flex-stack mb-3">
                                <div class="fw-semibold">Institusi</div>
                                <div class="text-end">PT. Pertamina</div>
                            </div>
                            <div class="d-flex flex-stack mb-3">
                                <div class="fw-semibold">Kuota</div>
                                <div class="text-end">50 Mahasiswa</div>
                            </div>
                            <div class="d-flex flex-stack">
                                <div class="fw-semibold">Deadline</div>
                                <div class="text-end text-danger">24 Aug 2024</div>
                            </div>
                        </div>
                        <!--end::Info-->

                        <!--begin::Requirements-->
                        <div class="mb-5">
                            <h4 class="fs-6 fw-semibold mb-3">Persyaratan Umum:</h4>
                            <ul class="fs-6 fw-normal text-gray-700">
                                <li>IPK minimal 3.00</li>
                                <li>Mahasiswa aktif semester 4-6</li>
                                <li>Surat rekomendasi dosen</li>
                            </ul>
                        </div>
                        <!--end::Requirements-->

                        <!--begin::Actions-->
                        <div class="d-flex flex-stack mt-auto pt-3">
                            <a href="#" class="btn btn-light me-3">Detail</a>
                            <a href="#" class="btn btn-primary">Daftar</a>
                        </div>
                        <!--end::Actions-->
                    </div>
                </div>
            </div>
            <!--end::Scholarship Card-->

            <!--begin::Scholarship Card (Already Applied)-->
            <div class="col-md-6 col-xl-4">
                <div class="card h-100">
                    <div class="card-body d-flex flex-column">
                        <div class="fs-3 fw-bold text-dark mb-5">Beasiswa Prestasi UISI</div>

                        <!--begin::Status Badge-->
                        <div class="position-absolute top-0 end-0 mt-3 me-3">
                            <span class="badge badge-warning">Sedang Diproses</span>
                        </div>
                        <!--end::Status Badge-->

                        <div class="fs-6 fw-semibold text-gray-600 mb-5">
                            <div class="d-flex flex-stack mb-3">
                                <div class="fw-semibold">Institusi</div>
                                <div class="text-end">UISI</div>
                            </div>
                            <div class="d-flex flex-stack mb-3">
                                <div class="fw-semibold">Kuota</div>
                                <div class="text-end">100 Mahasiswa</div>
                            </div>
                            <div class="d-flex flex-stack">
                                <div class="fw-semibold">Deadline</div>
                                <div class="text-end text-danger">30 Aug 2024</div>
                            </div>
                        </div>

                        <div class="mb-5">
                            <h4 class="fs-6 fw-semibold mb-3">Persyaratan Umum:</h4>
                            <ul class="fs-6 fw-normal text-gray-700">
                                <li>IPK minimal 3.50</li>
                                <li>Aktif berorganisasi</li>
                                <li>Memiliki prestasi akademik/non-akademik</li>
                            </ul>
                        </div>

                        <div class="d-flex flex-stack mt-auto pt-3">
                            <a href="#" class="btn btn-light">Detail</a>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Scholarship Card-->
        </div>
        <!--end::Scholarships Grid-->

        <!--begin::Notification Section-->
        <div class="card mt-7">
            <div class="card-header">
                <h3 class="card-title">Pengumuman Penting</h3>
            </div>
            <div class="card-body">
                <div class="notice d-flex bg-light-warning rounded border-warning border border-dashed p-6">
                    <i class="ki-outline ki-information fs-2tx text-warning me-4"></i>
                    <div class="d-flex flex-stack flex-grow-1">
                        <div class="fw-semibold">
                            <h4 class="text-gray-900 fw-bold">Deadline Beasiswa BUMN!</h4>
                            <div class="fs-6 text-gray-700">Pendaftaran Beasiswa BUMN akan ditutup dalam 3 hari. Pastikan
                                berkas Anda lengkap sebelum mendaftar.</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Notification Section-->
    </div>
    <!--end::Content container-->
@endsection
