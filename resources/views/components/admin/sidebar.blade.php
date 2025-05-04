<!--begin::Sidebar-->
<div id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true" data-kt-drawer-name="app-sidebar"
    data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="225px"
    data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">

    <!--begin::Logo-->
    <div class="app-sidebar-logo px-6" id="kt_app_sidebar_logo">
        <a href="{{ route('admin.dashboard') }}">
            <img alt="Logo" src="{{ Vite::asset('resources/assets/media/logos/logo-uisi.png') }}"
                class="h-50px app-sidebar-logo-default" />
        </a>
        <div id="kt_app_sidebar_toggle" class="app-sidebar-toggle btn btn-icon btn-sm h-30px w-30px rotate">
            <i class="ki-outline ki-black-left-line fs-3 rotate-180"></i>
        </div>
    </div>
    <!--end::Logo-->

    <!--begin::Sidebar menu-->
    <div class="app-sidebar-menu overflow-hidden flex-column-fluid">
        <div class="menu menu-column menu-rounded menu-sub-indention fw-semibold" id="kt_app_sidebar_menu">

            <!--begin::Menu item-->
            <div class="menu-item">
                <a class="menu-link" href="{{ route('admin.dashboard') }}">
                    <span class="menu-icon"><i class="ki-outline ki-element-11 fs-2"></i></span>
                    <span class="menu-title">Dashboard</span>
                </a>
            </div>

            <!--begin::Mahasiswa Management Section-->
            <div class="menu-item">
                <div class="menu-link custom-popover" data-bs-toggle="popover" data-bs-trigger="click"
                    data-bs-placement="right" data-bs-html="true"
                    data-bs-title="<h3 class='popover-custom-title'>Manajemen Data</h3>"
                    data-bs-content='
                        <div class="menu-sub-items p-3">
                            <a href="{{ route('admin.users.index') }}" class="menu-sub-link d-flex align-items-center mb-3">
                                <span class="menu-sub-icon me-3">
                                    <i class="ki-outline ki-people fs-2"></i>
                                </span>
                                <span class="menu-sub-text">
                                    <span class="d-block fw-bold mb-1">Data Pengguna</span>
                                    <span class="text-muted fs-7">Kelola data pengguna sistem</span>
                                </span>
                            </a>
                            <a href="{{ route('admin.api-mahasiswa.index') }}" class="menu-sub-link d-flex align-items-center mb-3">
                                <span class="menu-sub-icon me-3">
                                    <i class="fas fa-cloud-download-alt fs-2"></i>
                                </span>
                                <span class="menu-sub-text">
                                    <span class="d-block fw-bold mb-1">Data API Mahasiswa</span>
                                    <span class="text-muted fs-7">Sinkronisasi data dari API</span>
                                </span>
                            </a>
                            <a href="{{ route('admin.manajemen-mahasiswa.index') }}" class="menu-sub-link d-flex align-items-center">
                                <span class="menu-sub-icon me-3">
                                    <i class="ki-outline ki-profile-user fs-2"></i>
                                </span>
                                <span class="menu-sub-text">
                                    <span class="d-block fw-bold mb-1">Database Mahasiswa</span>
                                    <span class="text-muted fs-7">Kelola data mahasiswa lokal</span>
                                </span>
                            </a>
                        </div>
                    '>
                    <span class="menu-icon"><i class="ki-outline ki-profile-circle fs-2"></i></span>
                    <span class="menu-title">Manajemen Data</span>
                    <span class="menu-arrow"></span>
                </div>
            </div>
            <!--begin::Menu item-->
            <div class="menu-item">
                <a class="menu-link" href="{{ route('admin.periode-monitoring.index') }}">
                    <span class="menu-icon"><i class="ki-outline ki-award fs-2"></i></span>
                    <span class="menu-title">Manajemen Periode Monitoring</span>
                </a>
            </div>
            <!--begin::Menu item-->
            <div class="menu-item">
                <a class="menu-link" href="{{ route('admin.beasiswa.index') }}">
                    <span class="menu-icon"><i class="ki-outline ki-award fs-2"></i></span>
                    <span class="menu-title">Manajemen Beasiswa</span>
                </a>
            </div>

            <!--begin::Menu item-->
            <div class="menu-item">
                <a class="menu-link" href="{{ route('admin.registered-scholarships') }}">
                    <span class="menu-icon"><i class="ki-outline ki-document fs-2"></i></span>
                    <span class="menu-title">Pendaftaran Beasiswa</span>
                </a>
            </div>

            <!--begin::Menu item-->
            <div class="menu-item">
                <a class="menu-link" href="{{ route('admin.announcement-management') }}">
                    <span class="menu-icon"><i class="ki-outline ki-notification fs-2"></i></span>
                    <span class="menu-title">Notifikasi & Pengumuman</span>
                </a>
            </div>

            <!--begin::Menu item-->
            <div class="menu-item">
                <a class="menu-link" href="{{ route('admin.statistics') }}">
                    <span class="menu-icon"><i class="ki-outline ki-chart-line fs-2"></i></span>
                    <span class="menu-title">Laporan & Statistik</span>
                </a>
            </div>

            <!--begin::Menu item-->
            <div class="menu-item">
                <a class="menu-link" href="">
                    <span class="menu-icon"><i class="ki-outline ki-setting-2 fs-2"></i></span>
                    <span class="menu-title">Pengaturan Sistem</span>
                </a>
            </div>

            <!--begin:Menu item-->
            <div class="menu-item">
                <!--begin:Menu link-->
                <form method="POST" action="{{ route('admin.logout-admin') }}" id="logout-form">
                    @csrf
                    <a class="menu-link" href="#"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <span class="menu-icon">
                            <i class="fa-solid fa-right-from-bracket"></i>
                        </span>
                        <span class="menu-title">Logout admin</span>
                    </a>
                </form>
                <!--end:Menu link-->
            </div>
        </div>
    </div>
    <!--end::Sidebar menu-->

</div>
<!--end::Sidebar-->

@push('scripts')
    <script>
        // Initialize all popovers
        document.addEventListener('DOMContentLoaded', function() {
            var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
            var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
                return new bootstrap.Popover(popoverTriggerEl, {
                    template: '<div class="popover" role="tooltip">' +
                        '<div class="popover-arrow"></div>' +
                        '<h3 class="popover-header fw-bold p-2"></h3>' +
                        '<div class="popover-body"></div>' +
                        '</div>'
                });
            });

            // Close popover when clicking outside
            document.addEventListener('click', function(e) {
                popoverTriggerList.forEach(function(popoverTriggerEl) {
                    var popover = bootstrap.Popover.getInstance(popoverTriggerEl);
                    if (popover && !popoverTriggerEl.contains(e.target)) {
                        popover.hide();
                    }
                });
            });
        });
    </script>
@endpush
