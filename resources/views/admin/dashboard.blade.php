@extends('layouts.admin')

@section('content')
    <!--begin::Content container-->
    <div class="container-fluid">
        <!--begin::Row-->
        <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
            <!--begin::Col-->
            <div class="col-md-6 col-lg-6 col-xl-3 mb-5">
                <div class="card card-flush">
                    <div class="card-header pt-5">
                        <div class="card-title d-flex flex-column">
                            <span class="fs-2hx fw-bold text-dark me-2" id="totalMahasiswa">245</span>
                            <span class="text-gray-400 pt-1 fw-semibold fs-6">Total Mahasiswa</span>
                        </div>
                    </div>
                    <div class="card-body d-flex align-items-end pt-0">
                        <div class="d-flex align-items-center flex-column mt-3 w-100">
                            <div class="d-flex justify-content-between fw-bold fs-6 text-gray-400 w-100 mt-auto mb-2">
                                <span>Aktif</span>
                                <span>86%</span>
                            </div>
                            <div class="h-8px mx-3 w-100 bg-light-success rounded">
                                <div class="bg-success rounded h-8px" role="progressbar" style="width: 86%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Col-->

            <!--begin::Col-->
            <div class="col-md-6 col-lg-6 col-xl-3 mb-5">
                <div class="card card-flush">
                    <div class="card-header pt-5">
                        <div class="card-title d-flex flex-column">
                            <span class="fs-2hx fw-bold text-dark me-2" id="totalBeasiswa">8</span>
                            <span class="text-gray-400 pt-1 fw-semibold fs-6">Beasiswa Aktif</span>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <div class="d-flex align-items-center flex-column mt-3 w-100">
                            <div class="d-flex justify-content-between fw-bold fs-6 text-gray-400 w-100 mt-auto mb-2">
                                <span>Sedang Dibuka</span>
                                <span>4</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Col-->

            <!--begin::Col-->
            <div class="col-md-6 col-lg-6 col-xl-3 mb-5">
                <div class="card card-flush">
                    <div class="card-header pt-5">
                        <div class="card-title d-flex flex-column">
                            <span class="fs-2hx fw-bold text-dark me-2" id="totalPendaftar">156</span>
                            <span class="text-gray-400 pt-1 fw-semibold fs-6">Total Pendaftar</span>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <div class="d-flex align-items-center flex-column mt-3 w-100">
                            <div class="d-flex justify-content-between fw-bold fs-6 text-gray-400 w-100 mt-auto mb-2">
                                <span>Sedang Diproses</span>
                                <span>42</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Col-->

            <!--begin::Col-->
            <div class="col-md-6 col-lg-6 col-xl-3 mb-5">
                <div class="card card-flush">
                    <div class="card-header pt-5">
                        <div class="card-title d-flex flex-column">
                            <span class="fs-2hx fw-bold text-dark me-2" id="totalDiterima">98</span>
                            <span class="text-gray-400 pt-1 fw-semibold fs-6">Mahasiswa Diterima</span>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <div class="d-flex align-items-center flex-column mt-3 w-100">
                            <div class="d-flex justify-content-between fw-bold fs-6 text-gray-400 w-100 mt-auto mb-2">
                                <span>Tingkat Kelulusan</span>
                                <span>62%</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Col-->
        </div>
        <!--end::Row-->

        <!--begin::Row-->
        <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
            <!--begin::Col-->
            <div class="col-xl-8">
                <div class="card card-flush h-xl-100">
                    <div class="card-header pt-5">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bold text-dark">Grafik Pendaftaran Beasiswa</span>
                            <span class="text-gray-400 pt-2 fw-semibold fs-6">Total 2,356 pendaftar tahun ini</span>
                        </h3>
                    </div>
                    <div class="card-body pt-6">
                        <div id="chartPendaftaran" style="height: 350px;"></div>
                    </div>
                </div>
            </div>
            <!--end::Col-->

            <!--begin::Col-->
            <div class="col-xl-4">
                <div class="card card-flush h-xl-100">
                    <div class="card-header pt-5">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bold text-dark">Status Pendaftaran</span>
                            <span class="text-gray-400 pt-2 fw-semibold fs-6">Periode: Jan - Mar 2024</span>
                        </h3>
                    </div>
                    <div class="card-body pt-6">
                        <div id="chartStatus" style="height: 350px;"></div>
                    </div>
                </div>
            </div>
            <!--end::Col-->
        </div>
        <!--end::Row-->

        <!--begin::Row-->
        <div class="row g-5 g-xl-10">
            <!--begin::Col-->
            <div class="col-xl-6">
                <div class="card card-flush h-xl-100">
                    <div class="card-header pt-5">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bold text-dark">Pendaftaran Terbaru</span>
                            <span class="text-gray-400 pt-2 fw-semibold fs-6">Update 12:40 PM</span>
                        </h3>
                    </div>
                    <div class="card-body pt-5">
                        <div class="table-responsive">
                            <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                                <thead>
                                    <tr class="fw-bold text-muted">
                                        <th>Nama Mahasiswa</th>
                                        <th>Beasiswa</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Satria Bagus</td>
                                        <td>Beasiswa Prestasi</td>
                                        <td><span class="badge badge-light-warning">Diproses</span></td>
                                        <td><a href="#" class="btn btn-sm btn-light">Detail</a></td>
                                    </tr>
                                    <tr>
                                        <td>Andi Saputra</td>
                                        <td>Beasiswa PPA</td>
                                        <td><span class="badge badge-light-success">Diterima</span></td>
                                        <td><a href="#" class="btn btn-sm btn-light">Detail</a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Col-->

            <!--begin::Col-->
            <div class="col-xl-6">
                <div class="card card-flush h-xl-100">
                    <div class="card-header pt-5">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bold text-dark">Beasiswa Aktif</span>
                            <span class="text-gray-400 pt-2 fw-semibold fs-6">Periode pendaftaran masih dibuka</span>
                        </h3>
                    </div>
                    <div class="card-body pt-5">
                        <div class="table-responsive">
                            <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                                <thead>
                                    <tr class="fw-bold text-muted">
                                        <th>Nama Beasiswa</th>
                                        <th>Kuota</th>
                                        <th>Deadline</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Beasiswa Prestasi</td>
                                        <td>10 Mahasiswa</td>
                                        <td>15 April 2024</td>
                                        <td><a href="#" class="btn btn-sm btn-light">Detail</a></td>
                                    </tr>
                                    <tr>
                                        <td>Beasiswa PPA</td>
                                        <td>20 Mahasiswa</td>
                                        <td>30 April 2024</td>
                                        <td><a href="#" class="btn btn-sm btn-light">Detail</a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Col-->
        </div>
        <!--end::Row-->
    </div>
    <!--end::Content container-->

    @push('scripts')
        <script>
            // Initialize charts
            var chartPendaftaran = new ApexCharts(document.querySelector("#chartPendaftaran"), {
                chart: {
                    type: 'line',
                    height: 350
                },
                series: [{
                    name: 'Pendaftar',
                    data: [30, 40, 35, 50, 49, 60, 70, 91, 125]
                }],
                xaxis: {
                    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep']
                }
            });
            chartPendaftaran.render();

            var chartStatus = new ApexCharts(document.querySelector("#chartStatus"), {
                chart: {
                    type: 'pie',
                    height: 350
                },
                series: [44, 55, 13],
                labels: ['Diterima', 'Diproses', 'Ditolak']
            });
            chartStatus.render();
        </script>
    @endpush
@endsection
