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
    <base href="../../../" />
    <title>Login - Sistem Beasiswa UISI</title>
    <meta charset="utf-8" />
    <meta name="description" content="" />
    <meta name="keywords" content="uisi, beasiswa, beasiswa uisi, uisi beasiswa" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="Login - Sistem Beasiswa UISI" />
    <meta property="og:url" content="https://keenthemes.com/metronic" />
    <meta property="og:site_name" content="Metronic by Keenthemes" />
    {{-- <link rel="canonical" href="http://authentication/layouts/creative/sign-in.html" /> --}}
    <link rel="shortcut icon" href="assets/media/logos/favicon.ico" />
    <!--begin::Fonts(mandatory for all pages)-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
    @vite(['resources/css/style.bundle.css', 'resources/css/plugins.bundle.css'])
    <!--end::Global Stylesheets Bundle-->
    <script>
        // Frame-busting to prevent site from being loaded within a frame without permission (click-jacking) if (window.top != window.self) { window.top.location.replace(window.self.location.href); }
    </script>
    <style>
        .logo-enhance {
            max-width: 220px;
            height: auto;
            transition: all 0.3s ease;
            padding: 15px;
            background: rgba(255, 255, 255, 0.9);
            /* semi-transparan putih */
            border-radius: 12px;
            /* sudut membulat */
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            /* bayangan halus */
        }

        .logo-enhance:hover {
            transform: scale(1.02);
            background: rgba(255, 255, 255, 1);
            /* putih solid saat hover */
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
        }
    </style>
</head>
<!--end::Head-->
<!--begin::Body-->

<body id="kt_body" class="app-blank bgi-size-cover bgi-attachment-fixed bgi-position-center bgi-no-repeat">
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
    <!--begin::Root-->
    <div class="d-flex flex-column flex-root" id="kt_app_root">
        <!--begin::Page bg image-->
        <style>
            body {
                background-image: url('{{ Vite::asset('resources/assets/media/auth/bg4.jpg') }}');
            }

            [data-bs-theme="dark"] body {
                background-image: url('{{ Vite::asset('resources/assets/media/auth/bg4-dark.jpg') }}');
            }
        </style>
        <!--end::Page bg image-->
        <!--begin::Authentication - Sign-in -->
        <div class="d-flex flex-column flex-column-fluid flex-lg-row">
            <!--begin::Aside-->
            <div class="d-flex flex-center w-lg-50 pt-15 pt-lg-0 px-10">
                <!--begin::Aside-->
                <div class="d-flex flex-center flex-lg-start flex-column">
                    <!--begin::Logo-->
                    <a href="/" class="mb-7">
                        <img alt="Logo" src="{{ Vite::asset('resources/assets/media/logos/logo-uisi.png') }}"
                            class="logo-enhance" />
                    </a>
                    <!--end::Logo-->
                    <!--begin::Title-->
                    <h2 class="text-white fw-normal m-0">Sistem Informasi Beasiswa UISI</h2>
                    <!--end::Title-->
                </div>
                <!--begin::Aside-->
            </div>
            <!--begin::Aside-->
            <!--begin::Body-->
            <div
                class="d-flex flex-column-fluid flex-lg-row-auto justify-content-center justify-content-lg-end p-12 p-lg-20">
                <!--begin::Card-->
                <div class="bg-body d-flex flex-column align-items-stretch flex-center rounded-4 w-md-600px p-20">
                    <!--begin::Wrapper-->
                    <div class="d-flex flex-center flex-column flex-column-fluid px-lg-10 pb-15 pb-lg-20">
                        <!--begin::Form-->
                        @yield('content')
                        <!--end::Form-->
                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Card-->
            </div>
            <!--end::Body-->
        </div>
        <!--end::Authentication - Sign-in-->
    </div>
    <!--end::Root-->
    <!--begin::Javascript-->
    <script src="{{ Vite::asset('resources/js/plugins.bundle.js') }}"></script>
    <script src=" {{ Vite::asset('resources/js/scripts.bundle.js') }}"></script>

    <!--begin::Global Javascript Bundle(mandatory for all pages)-->
    <!--end::Global Javascript Bundle-->
    <!--begin::Custom Javascript(used for this page only)-->
    <!--end::Custom Javascript-->
    <!--end::Javascript-->
    @stack('scripts')
</body>
<!--end::Body-->

</html>
