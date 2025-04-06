@extends('layouts.auth')

@section('content')
    <!--begin::Form-->
    <form class="form w-100" id="kt_sign_in_form" action="{{ route('admin.login.submit') }}" method="POST">
        @csrf
        <!--begin::Heading-->
        <div class="text-center mb-11">
            <!--begin::Title-->
            <h1 class="text-gray-900 fw-bolder mb-3">Administrator Login</h1>
            <!--end::Title-->
            <!--begin::Subtitle-->
            <div class="text-gray-500 fw-semibold fs-6">Sistem Informasi Beasiswa UISI</div>
            <!--end::Subtitle=-->
        </div>
        <!--end::Heading-->

        @if ($errors->any())
            <!--begin::Alert-->
            <div class="alert alert-danger d-flex align-items-center p-5 mb-10">
                <i class="ki-duotone ki-shield-cross fs-2hx text-danger me-4"><span class="path1"></span><span
                        class="path2"></span></i>
                <div class="d-flex flex-column">
                    <h4 class="mb-1 text-danger">Login Failed</h4>
                    <span>{{ $errors->first() }}</span>
                </div>
            </div>
            <!--end::Alert-->
        @endif

        <!--begin::Input group-->
        <div class="fv-row mb-8">
            <!--begin::Email-->
            <input type="email" placeholder="Email" name="email" autocomplete="off"
                class="form-control bg-transparent @error('email') is-invalid @enderror" value="{{ old('email') }}"
                required />
            @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
            <!--end::Email-->
        </div>
        <!--end::Input group-->

        <!--begin::Input group-->
        <div class="fv-row mb-3">
            <!--begin::Password-->
            <input type="password" placeholder="Password" name="password" autocomplete="off"
                class="form-control bg-transparent @error('password') is-invalid @enderror" required />
            @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
            <!--end::Password-->
        </div>
        <!--end::Input group-->

        <!--begin::Wrapper-->
        <div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="remember" id="remember"
                    {{ old('remember') ? 'checked' : '' }}>
                <label class="form-check-label" for="remember">
                    Remember me
                </label>
            </div>
            <!--begin::Link-->
            {{-- <a href="{{ route('password.request') }}" class="link-primary">Forgot Password ?</a> --}}
            <!--end::Link-->
        </div>
        <!--end::Wrapper-->

        <!--begin::Submit button-->
        <div class="d-grid mb-10">
            <button type="submit" id="kt_sign_in_submit" class="btn btn-primary">
                <!--begin::Indicator label-->
                <span class="indicator-label">Sign In</span>
                <!--end::Indicator label-->
                <!--begin::Indicator progress-->
                <span class="indicator-progress">Please wait...
                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                </span>
                <!--end::Indicator progress-->
            </button>
        </div>
        <!--end::Submit button-->

        <!--begin::Back to home-->
        {{-- <div class="text-center">
            <a href="{{ route('home') }}" class="link-primary fs-6">
                <i class="ki-duotone ki-arrow-left fs-7"></i> Back to home
            </a>
        </div> --}}
        <!--end::Back to home-->
    </form>
    <!--end::Form-->
@endsection
