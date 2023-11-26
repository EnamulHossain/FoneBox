<!DOCTYPE html>
<html lang="en" class="light-style layout-wide  customizer-hide" dir="ltr" data-theme="theme-default" data-assets-path="/backend/" data-template="vertical-menu-template">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

        <title>{{ config('app.name') }}</title>

        <meta name="description" content="Most Powerful &amp; Comprehensive Bootstrap 5 HTML Admin Dashboard Template built for developers!" />
        <meta name="keywords" content="dashboard, bootstrap 5 dashboard, bootstrap 5 design, bootstrap 5">
        <!-- Canonical SEO -->
        <link rel="canonical" href="https://themeselection.com/item/sneat-bootstrap-html-admin-template/">
 
        <!-- ? PROD Only: Google Tag Manager (Default ThemeSelection: GTM-5DDHKGP, PixInvent: GTM-5J3LMKC) -->

        {{-- <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-5DDHKGP');</script> --}}

        <!-- End Google Tag Manager -->

        
        <!-- Favicon -->
        <link rel="icon" type="image/x-icon" href="{{ asset('/backend/img/favicon/fonebox.png') }}" />

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

        <!-- Icons -->
        <link rel="stylesheet" href="{{ asset('/backend/vendor/fonts/boxicons.css') }}" />
        <link rel="stylesheet" href="{{ asset('/backend/vendor/fonts/fontawesome.css') }}" />
        <link rel="stylesheet" href="{{ asset('/backend/vendor/fonts/flag-icons.css') }}" />

        <!-- Core CSS -->
        <link rel="stylesheet" href="{{ asset('/backend/vendor/css/rtl/core.css') }}" class="template-customizer-core-css" />
        <link rel="stylesheet" href="{{ asset('/backend/vendor/css/rtl/theme-default.css') }}" class="template-customizer-theme-css" />
        <link rel="stylesheet" href="{{ asset('/backend/css/demo.css') }}" />
        
        <!-- Vendors CSS -->
        <link rel="stylesheet" href="{{ asset('/backend/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
        <link rel="stylesheet" href="{{ asset('/backend/vendor/libs/typeahead-js/typeahead.css') }}" /> 
        <!-- Vendor -->
        <link rel="stylesheet" href="{{ asset('/backend/vendor/libs/@form-validation/umd/styles/index.min.css') }}" />

        <!-- Page CSS -->
        <!-- Page -->
        <link rel="stylesheet" href="{{ asset('/backend/vendor/css/pages/page-auth.css') }}">

        <!-- Helpers -->
        <script src="{{ asset('/backend/vendor/js/helpers.js') }}"></script>
        <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
        <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
        <script src="{{ asset('/backend/vendor/js/template-customizer.js') }}"></script>
        <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
        <script src="{{ asset('/backend/js/config.js') }}"></script>
        
    </head>

    <body>
        <!-- Content -->

        @yield('content')

        <!-- / Content -->

        <!-- Core JS -->
        <!-- build:js assets/vendor/js/core.js -->

        <script src="{{ asset('/backend/vendor/libs/jquery/jquery.js') }}"></script>
        <script src="{{ asset('/backend/vendor/libs/popper/popper.js') }}"></script>
        <script src="{{ asset('/backend/vendor/js/bootstrap.js') }}"></script>
        <script src="{{ asset('/backend/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
        <script src="{{ asset('/backend/vendor/libs/hammer/hammer.js') }}"></script>
        <script src="{{ asset('/backend/vendor/libs/i18n/i18n.js') }}"></script>
        <script src="{{ asset('/backend/vendor/libs/typeahead-js/typeahead.js') }}"></script>
        <script src="{{ asset('/backend/vendor/js/menu.js') }}"></script>

        <!-- endbuild -->

        <!-- Vendors JS -->
        <script src="{{ asset('/backend/vendor/libs/@form-validation/umd/bundle/popular.min.js') }}"></script>
        <script src="{{ asset('/backend/vendor/libs/@form-validation/umd/plugin-bootstrap5/index.min.js') }}"></script>
        <script src="{{ asset('/backend/vendor/libs/@form-validation/umd/plugin-auto-focus/index.min.js') }}"></script>

        <!-- Main JS -->
        <script src="{{ asset('/backend/js/main.js') }}"></script>

        <!-- Page JS -->
        <script src="{{ asset('/backend/js/pages-auth.js') }}"></script>

    </body>

</html>
