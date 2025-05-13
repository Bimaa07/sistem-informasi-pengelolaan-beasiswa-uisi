<!--begin::Sidebar-->
<div id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true" data-kt-drawer-name="app-sidebar"
    data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="225px"
    data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">

    <!--begin::Sidebar menu-->
    <div class="app-sidebar-menu overflow-hidden flex-column-fluid">
        <div class="menu menu-column menu-rounded menu-sub-indention fw-semibold" id="kt_app_sidebar_menu">

            <!--begin::Menu item-->
            <div class="menu-item">
                <a class="menu-link {{ Route::is('admin.dashboard') ? 'active' : '' }}"
                    href="{{ route('admin.dashboard') }}">
                    <span class="menu-icon"><i class="ki-outline ki-element-11 fs-2"></i></span>
                    <span class="menu-title">Dashboard</span>
                </a>
            </div>

            <!--begin::Menu section-->
            <div class="menu-item pt-5">
                <div class="menu-content">
                    <span class="menu-heading fw-bold text-uppercase fs-7">Manajemen Data</span>
                </div>
            </div>

            <div class="menu-item">
                <a class="menu-link {{ Route::is('admin.users.*') ? 'active' : '' }}"
                    href="{{ route('admin.users.index') }}">
                    <span class="menu-icon"><i class="ki-outline ki-user fs-2"></i></span>
                    <span class="menu-title">Data Pengguna</span>
                </a>
            </div>

            <div class="menu-item">
                <a class="menu-link {{ Route::is('admin.api-mahasiswa.*') ? 'active' : '' }}"
                    href="{{ route('admin.manajemen-mahasiswa.index') }}">
                    <span class="menu-icon"><i class="ki-outline ki-cloud-download fs-2"></i></span>
                    <span class="menu-title">Data API Mahasiswa</span>
                </a>
            </div>

            <div class="menu-item">
                <a class="menu-link {{ Route::is('admin.manajemen-beasiswa-mahasiswa.*') ? 'active' : '' }}"
                    href="{{ route('admin.manajemen-beasiswa-mahasiswa.index') }}">
                    <span class="menu-icon"><i class="ki-outline ki-profile-user fs-2"></i></span>
                    <span class="menu-title">Database Mahasiswa</span>
                </a>
            </div>

            <!--begin::Menu section-->
            <div class="menu-item pt-5">
                <div class="menu-content">
                    <span class="menu-heading fw-bold text-uppercase fs-7">Beasiswa</span>
                </div>
            </div>

            <div class="menu-item">
                <a class="menu-link {{ Route::is('admin.beasiswa.*') ? 'active' : '' }}"
                    href="{{ route('admin.beasiswa.index') }}">
                    <span class="menu-icon"><i class="ki-outline ki-award fs-2"></i></span>
                    <span class="menu-title">Manajemen Beasiswa</span>
                </a>
            </div>

            <div class="menu-item">
                <a class="menu-link {{ Route::is('admin.beasiswa-ongoing.*') ? 'active' : '' }}"
                    href="{{ route('admin.beasiswa-ongoing.index') }}">
                    <span class="menu-icon"><i class="ki-outline ki-questionnaire-tablet fs-2"></i></span>
                    <span class="menu-title">Pendaftaran Beasiswa</span>
                </a>
            </div>

            <!--begin::Menu section-->
            <div class="menu-item pt-5">
                <div class="menu-content">
                    <span class="menu-heading fw-bold text-uppercase fs-7">Monitoring</span>
                </div>
            </div>

            <div class="menu-item">
                <a class="menu-link {{ Route::is('admin.periode-monitoring.*') ? 'active' : '' }}"
                    href="{{ route('admin.periode-monitoring.index') }}">
                    <span class="menu-icon"><i class="ki-outline ki-calendar fs-2"></i></span>
                    <span class="menu-title">Periode Monitoring</span>
                </a>
            </div>

            <!--begin::Menu section-->
            <div class="menu-item pt-5">
                <div class="menu-content">
                    <span class="menu-heading fw-bold text-uppercase fs-7">Sistem</span>
                </div>
            </div>

            <div class="menu-item">
                <a class="menu-link {{ Route::is('admin.announcement-management') ? 'active' : '' }}"
                    href="{{ route('admin.announcement-management') }}">
                    <span class="menu-icon"><i class="ki-outline ki-notification fs-2"></i></span>
                    <span class="menu-title">Notifikasi & Pengumuman</span>
                </a>
            </div>

            <div class="menu-item">
                <a class="menu-link {{ Route::is('admin.statistics') ? 'active' : '' }}"
                    href="{{ route('admin.statistics') }}">
                    <span class="menu-icon"><i class="ki-outline ki-chart-line fs-2"></i></span>
                    <span class="menu-title">Laporan & Statistik</span>
                </a>
            </div>

            <!--begin::Menu section-->
            <div class="menu-item pt-5">
                <div class="menu-content">
                    <span class="menu-heading fw-bold text-uppercase fs-7">Akun</span>
                </div>
            </div>

            <div class="menu-item">
                <form method="POST" action="{{ route('admin.logout-admin') }}" id="logout-form">
                    @csrf
                    <a class="menu-link" href="#"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <span class="menu-icon"><i class="fa-solid fa-right-from-bracket"></i></span>
                        <span class="menu-title">Logout</span>
                    </a>
                </form>
            </div>
        </div>
    </div>
    <!--end::Sidebar menu-->
</div>
<!--end::Sidebar-->
