@extends('layouts.auth')

@section('content')
    <!--begin::Form-->
    <form class="form w-100" novalidate="novalidate" id="kt_sign_in_form" method="POST" action="{{ route('login') }}">
        @csrf
        <!--begin::Heading-->
        <div class="text-center mb-11">
            <!--begin::Title-->
            <h1 class="text-gray-900 fw-bolder mb-3">Sign In</h1>
            <!--end::Title-->
            <!--begin::Subtitle-->
            <div class="text-gray-500 fw-semibold fs-6">Sistem Informasi Beasiswa UISI</div>
            <!--end::Subtitle=-->
        </div>
        <!--end::Heading-->
        <form class="form w-100" novalidate="novalidate" id="kt_sign_in_form" data-kt-redirect-url="index.html"
            action="#">
            <!--begin::Login options-->
            <div class="row g-3 mb-9">
                <!--begin::Col-->
                <div class="col-md-12">
                    <!--begin::Google link=-->
                    <a href="{{ route('google.login') }}"
                        class="btn btn-flex btn-outline btn-text-gray-700 btn-active-color-primary bg-state-light flex-center text-nowrap w-100">
                        <img alt="Logo"
                            src=" {{ Vite::asset('resources/assets/media/svg/brand-logos/google-icon.svg') }} "
                            class="h-15px me-3" />Sign in
                        with Google</a>
                    <!--end::Google link=-->
                </div>
                <!--end::Col-->
                <!--begin::Col-->
            </div>
        </form>
        <!--end::Submit button-->
    </form>
    <!--end::Form-->
    @push('scripts')
        <script src=" {{ Vite::asset('resources/js/auth/general.js') }}"></script>
    @endpush
@endsection
