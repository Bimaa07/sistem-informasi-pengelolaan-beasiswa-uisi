@extends('layouts.admin')

@section('content')
<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
    <div class="d-flex flex-column flex-column-fluid">
        <!--begin::Toolbar-->
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                        Edit Beasiswa
                    </h1>
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

                        <form action="{{ route('admin.beasiswa.update', $beasiswa) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-5">
                                <label class="form-label required">Nama Beasiswa</label>
                                <input type="text" name="nama"
                                    class="form-control form-control-solid @error('nama') is-invalid @enderror"
                                    value="{{ old('nama', $beasiswa->nama) }}" required>
                                @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-5">
                                <label class="form-label required">Jenis Beasiswa</label>
                                <select name="jenis"
                                    class="form-select form-select-solid @error('jenis') is-invalid @enderror" required>
                                    <option value="">Pilih Jenis Beasiswa</option>
                                    <option value="full" {{ old('jenis', $beasiswa->jenis) == 'full' ? 'selected' : ''
                                        }}>
                                        Full
                                    </option>
                                    <option value="ongoing" {{ old('jenis', $beasiswa->jenis) == 'ongoing' ? 'selected'
                                        : '' }}>
                                        Ongoing
                                    </option>
                                </select>
                                @error('jenis')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="text-end">
                                <a href="{{ route('admin.beasiswa.index') }}" class="btn btn-light me-3">
                                    <i class="ki-outline ki-arrow-left fs-2"></i>
                                    Kembali
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="ki-outline ki-check fs-2"></i>
                                    Perbarui
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Content-->
    </div>
</div>
@endsection