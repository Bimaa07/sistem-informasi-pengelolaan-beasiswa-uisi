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
                <a class="menu-link" href="">
                    <span class="menu-icon"><i class="ki-outline ki-profile-user fs-2"></i></span>
                    <span class="menu-title">Manajemen Mahasiswa</span>
                </a>
            </div>

            <!--begin::Menu item-->
            <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                <span class="menu-link">
                    <span class="menu-icon"><i class="ki-outline ki-award fs-2"></i></span>
                    <span class="menu-title">Manajemen Beasiswa</span>
                    <span class="menu-arrow"></span>
                </span>
                <div class="menu-sub menu-sub-accordion">
                    <div class="menu-item">
                        <a class="menu-link" href="">
                            <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                            <span class="menu-title">Daftar Beasiswa</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a class="menu-link" href="">
                            <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                            <span class="menu-title">Tambah Beasiswa</span>
                        </a>
                    </div>
                </div>
            </div>

            <!--begin::Menu item-->
            <div class="menu-item">
                <a class="menu-link" href="">
                    <span class="menu-icon"><i class="ki-outline ki-document fs-2"></i></span>
                    <span class="menu-title">Pendaftaran Beasiswa</span>
                </a>
            </div>

            <!--begin::Menu item-->
            <div class="menu-item">
                <a class="menu-link" href="">
                    <span class="menu-icon"><i class="ki-outline ki-notification fs-2"></i></span>
                    <span class="menu-title">Notifikasi & Pengumuman</span>
                </a>
            </div>

            <!--begin::Menu item-->
            <div class="menu-item">
                <a class="menu-link" href="">
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

            <!--begin::Menu item-->
            <div class="menu-item">
                <form method="POST" action="{{ route('logout') }}" id="logout-form">
                    @csrf
                    <a class="menu-link" href="#"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <span class="menu-icon"><i class="ki-outline ki-exit fs-2"></i></span>
                        <span class="menu-title">Logout</span>
                    </a>
                </form>
            </div>

        </div>
    </div>
    <!--end::Sidebar menu-->

</div>
<!--end::Sidebar-->
