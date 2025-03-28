<!DOCTYPE html>
<!--
Author: Keenthemes
Product Name: MetronicProduct Version: 8.2.5
Purchase: https://1.envato.market/EA4JP
Website: http://www.keenthemes.com
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
License: For each use you must have a valid license purchased only from above link in order to legally use the theme for your project.
-->
<html lang="en">
<!--begin::Head-->

<head>
    <base href="../" />
    <title>Beranda | Sistem Informasi Beasiswa UISI</title>
    <meta charset="utf-8" />
    <meta name="description" content="Beranda | Sistem Informasi Beasiswa UISI" />
    <meta name="keywords" content="beranda, sistem informasi beasiswa uisi, uisi, beasiswa, sistem informasi" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="Beranda - Sistem Informasi Beasiswa UISI" />
    <meta property="og:site_name" content="Metronic by Keenthemes" />
    <link rel="canonical" href="http://layouts/light-sidebar.html" />
    <link rel="shortcut icon" href="assets/media/logos/favicon.ico" />
    <!--begin::Fonts(mandatory for all pages)-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Vendor Stylesheets(used for this page only)-->
    <!--end::Vendor Stylesheets-->
    <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->

    <!-- Then load other styles -->
    @vite(['resources/css/plugins.bundle.css', 'resources/css/style.bundle.css', 'resources/js/app.js'])

    @vite(['resources/assets/plugins/custom/datatables/datatables.bundle.css', 'resources/assets/plugins/custom/fullcalendar/fullcalendar.bundle.css', 'resources/assets/plugins/global/plugins.bundle.css'])
    <!--end::Global Stylesheets Bundle-->
    <script>
        // Frame-busting to prevent site from being loaded within a frame without permission (click-jacking) if (window.top != window.self) { window.top.location.replace(window.self.location.href); }
    </script>
</head>
<!--end::Head-->
<!--begin::Body-->

<body id="kt_app_body" data-kt-app-layout="light-sidebar" data-kt-app-header-fixed="true"
    data-kt-app-sidebar-enabled="true" data-kt-app-sidebar-fixed="true" data-kt-app-sidebar-hoverable="true"
    data-kt-app-sidebar-push-header="true" data-kt-app-sidebar-push-toolbar="true"
    data-kt-app-sidebar-push-footer="true" data-kt-app-toolbar-enabled="true" class="app-default">
    <!--begin::Theme mode setup on page load-->
    <script>
        var defaultThemeMode = "light";
        var themeMode;
        if (document.documentElement) {
            if (document.documentElement.hasAttribute("data-bs-theme-mode")) {
                themeMode = document.documentElement.getAttribute("data-bs-theme-mode");
            } else {
                if (localStorage.getItem("data-bs-theme") !== null) {
                    themeMode = localStorage.getItem("data-bs-theme");
                } else {
                    themeMode = defaultThemeMode;
                }
            }
            if (themeMode === "system") {
                themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
            }
            document.documentElement.setAttribute("data-bs-theme", themeMode);
        }
    </script>
    <!--end::Theme mode setup on page load-->
    <!--begin::App-->
    <div class="d-flex flex-column flex-root app-root" id="kt_app_root">
        <!--begin::Page-->
        <div class="app-page flex-column flex-column-fluid" id="kt_app_page">
            <!--begin::Header-->
            <x-layouts.header />
            <!--end::Header-->
            <!--begin::Wrapper-->
            <div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">
                <!--begin::Sidebar-->
                <x-layouts.sidebar />
                <!--end::Sidebar-->
                <!--begin::Main-->
                <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
                    <!--begin::Content wrapper-->
                    @yield('content')
                    <!--end::Content wrapper-->
                </div>
                <!--end:::Main-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Page-->
    </div>
    <!--end::App-->

    <!--begin::Global Javascript Bundle(mandatory for all pages)-->
    <!--end::Global Javascript Bundle-->
    <!--begin::Custom Javascript(used for this page only)-->
    <script src="{{ Vite::asset('resources/js/plugins.bundle.js') }}"></script>
    <script src="{{ Vite::asset('resources/js/scripts.bundle.js') }}"></script>
    {{-- <script src="plugins.bundle.js"></script> --}}
    @vite(['resources/assets/plugins/custom/fullcalendar/fullcalendar.bundle.js', 'resources/assets/js/widgets.bundle.js', 'resources/assets/js/custom/widgets.js', 'resources/assets/js/custom/apps/chat/chat.js', 'resources/assets/js/custom/utilities/modals/upgrade-plan.js', 'resources/assets/js/custom/utilities/modals/create-app.js', 'resources/assets/js/custom/utilities/modals/users-search.js'])

    <!-- Load remaining styles -->
    @vite(['resources/assets/plugins/custom/datatables/datatables.bundle.css', 'resources/assets/plugins/custom/fullcalendar/fullcalendar.bundle.css', 'resources/assets/plugins/global/plugins.bundle.css'])
    <!--end::Custom Javascript-->
    <!--end::Javascript-->
</body>
<!--end::Body-->

</html>
