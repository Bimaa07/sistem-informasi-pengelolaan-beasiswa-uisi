@extends('layouts.app')

@section('content')
    <!--begin::Content container-->
    <div class="d-flex flex-column flex-column-fluid container-fluid">
        <!--begin::Row-->
        <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
            <!--begin::Student Info-->
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Ringkasan Informasi Mahasiswa</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <h6 class="text-muted">Nama Lengkap</h6>
                                <p class="fs-6 fw-bold">{{ auth()->user()->name }}</p>
                            </div>
                            <div class="col-md-3 mb-3">
                                <h6 class="text-muted">NIM</h6>
                                <p class="fs-6 fw-bold">{{ auth()->user()->nim }}</p>
                            </div>
                            <div class="col-md-3 mb-3">
                                <h6 class="text-muted">Program Studi</h6>
                                <p class="fs-6 fw-bold">{{ auth()->user()->program_study }}</p>
                            </div>
                            <div class="col-md-3 mb-3">
                                <h6 class="text-muted">IPK Terkini</h6>
                                <p class="fs-6 fw-bold">{{ number_format(auth()->user()->gpa, 2) }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Student Info-->

            <!--begin::Available Scholarships-->
            <div class="col-xl-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Beasiswa Tersedia</h3>
                    </div>
                    <div class="card-body">
                        <div class="d-flex flex-column flex-md-row border-bottom py-4">
                            <div class="flex-grow-1">
                                <h4 class="fs-5">Beasiswa Ongoing</h4>
                                <p class="text-muted mb-2">BUMN</p>
                                <div class="d-flex gap-3 mb-2">
                                    <span class="badge badge-light-primary">
                                        Deadline: 24 Agusutus 2024
                                    </span>
                                </div>
                                <p class="mb-0">Syarat Beasiswa</p>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Magnam cupiditate tempora
                                    reiciendis quidem exercitationem adipisci iste architecto magni, suscipit quod.</p>
                            </div>
                            <div class="d-flex align-items-center mt-3 mt-md-0">
                                <a href="" class="btn btn-primary">Daftar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Available Scholarships-->

            <!--begin::Right Sidebar-->
            <div class="col-xl-4">
                <!--begin::Application Status-->
                <div class="card mb-5">
                    <div class="card-header">
                        <h3 class="card-title">Status Pendaftaran</h3>
                    </div>
                    <div class="card-body">
                        <div class="d-flex flex-column border-bottom py-3">
                            <h5 class="fs-6">Nama Beasiswa</h5>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="text-muted">dibuat tanggal 20 agustus 2024</span>
                                <span class="badge badge-light-warning">Sedang Diproses</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::Application Status-->

                <!--begin::Notifications-->
                <div class="card mb-5">
                    <div class="card-header">
                        <h3 class="card-title">Notifikasi & Pengumuman</h3>
                    </div>
                    <div class="card-body">
                        <div class="d-flex flex-column border-bottom py-3">
                            <p class="mb-1">Pesan Notifikasi</p>
                            <span class="text-muted small">20 agustus 2024</span>
                        </div>
                    </div>
                </div>
                <!--end::Notifications-->

                <!--begin::Help Section-->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Bantuan</h3>
                    </div>
                    <div class="card-body">
                        <div class="d-flex flex-column gap-3">
                            <a href="" class="text-dark text-hover-primary">
                                <i class="ki-outline ki-book fs-2 me-2"></i>Panduan Pendaftaran
                            </a>
                            <a href="" class="text-dark text-hover-primary">
                                <i class="ki-outline ki-question fs-2 me-2"></i>FAQ
                            </a>
                            <a href="" class="text-dark text-hover-primary">
                                <i class="ki-outline ki-message-text-2 fs-2 me-2"></i>Kontak Admin
                            </a>
                        </div>
                    </div>
                </div>
                <!--end::Help Section-->
            </div>
            <!--end::Right Sidebar-->
        </div>
        <!--end::Row-->
    </div>
    <!--end::Content container-->
@endsection
