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

            <!--begin::Menu item-->
            <div class="menu-item">
                <a class="menu-link" href="{{ route('admin.student-management') }}">
                    <span class="menu-icon"><i class="ki-outline ki-profile-user fs-2"></i></span>
                    <span class="menu-title">Manajemen Mahasiswa</span>
                </a>
            </div>
            <!--begin::Menu item-->
            <div class="menu-item">
                <a class="menu-link" href="{{ route('admin.scholarships-management') }}">
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
