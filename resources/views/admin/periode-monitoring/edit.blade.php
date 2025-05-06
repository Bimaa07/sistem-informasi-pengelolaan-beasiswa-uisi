@extends('layouts.admin')

@section('content')
    <!--begin::Toolbar-->
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                    Edit Periode Monitoring
                </h1>
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <li class="breadcrumb-item text-muted">
                        <a href="{{ route('admin.dashboard') }}" class="text-muted text-hover-primary">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        <a href="{{ route('admin.periode-monitoring.index') }}" class="text-muted text-hover-primary">
                            Periode Monitoring
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">Edit</li>
                </ul>
            </div>
        </div>
    </div>
    <!--end::Toolbar-->

    <!--begin::Content-->
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-fluid">
            <div class="card">
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.periode-monitoring.update', $period->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <label class="required fw-semibold fs-6 mb-2">Tahun Ajaran</label>
                            <input type="text" name="tahun_ajaran" class="form-control form-control-solid mb-3 mb-lg-0"
                                placeholder="Contoh: 2024/2025" value="{{ old('tahun_ajaran', $period->tahun_ajaran) }}"
                                required />
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <label class="required fw-semibold fs-6 mb-2">Semester Akademik</label>
                            <select name="semester_akademik" class="form-select form-select-solid" required>
                                <option value="">Pilih semester</option>
                                <option value="ganjil"
                                    {{ old('semester_akademik', $period->semester_akademik) == 'ganjil' ? 'selected' : '' }}>
                                    Ganjil
                                </option>
                                <option value="genap"
                                    {{ old('semester_akademik', $period->semester_akademik) == 'genap' ? 'selected' : '' }}>
                                    Genap
                                </option>
                            </select>
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <label class="required fw-semibold fs-6 mb-2">Tanggal Mulai</label>
                            <input type="date" name="tanggal_mulai" class="form-control form-control-solid mb-3 mb-lg-0"
                                value="{{ old('tanggal_mulai', $period->tanggal_mulai) }}" required />
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <label class="required fw-semibold fs-6 mb-2">Status</label>
                            <select name="status" class="form-select form-select-solid" required>
                                <option value="">Pilih status</option>
                                <option value="dibuka" {{ old('status', $period->status) == 'dibuka' ? 'selected' : '' }}>
                                    Dibuka
                                </option>
                                <option value="ditutup" {{ old('status', $period->status) == 'ditutup' ? 'selected' : '' }}>
                                    Ditutup
                                </option>
                            </select>
                        </div>
                        <!--end::Input group-->

                        <!--begin::Actions-->
                        <div class="text-center pt-15">
                            <a href="{{ route('admin.periode-monitoring.index') }}" class="btn btn-light me-3">Batal</a>
                            <button type="submit" class="btn btn-primary">
                                <span class="indicator-label">Update</span>
                            </button>
                        </div>
                        <!--end::Actions-->
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--end::Content-->
@endsection
