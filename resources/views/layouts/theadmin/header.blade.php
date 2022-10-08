<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="TheAdmin - Responsive Bootstrap 4 Admin, Dashboard &amp; WebApp Template">
    <meta name="keywords" content="dashboard, index, main">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Arsip Surat Online</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,300i|Dosis:300,500" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('vendor/bootstrap-theadmin-master') }}/assets/css/core.min.css" rel="stylesheet">
    <link href="{{ asset('vendor/bootstrap-theadmin-master') }}/assets/css/app.min.css" rel="stylesheet">
    <link href="{{ asset('vendor/bootstrap-theadmin-master') }}/assets/css/style.min.css" rel="stylesheet">
    <link href="{{ asset('assets') }}/css/custom.css" rel="stylesheet">

    {{-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css"/> --}}
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('vendor/bootstrap-theadmin-master') }}/assets/vendor/datatables/css/jquery.dataTables_themeroller.css"/> --}}
    {{-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.11.3/datatables.min.css" /> --}}
    <link rel="stylesheet" href="{{ asset('vendor/dataTables') }}/datatables.min.css">

    <link rel="stylesheet" href="{{ asset('vendor/sweetalert2') }}/sweetalert2.min.css" />

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="{{ asset('vendor/bootstrap-theadmin-master') }}/assets/img/apple-touch-icon.png">
    <!-- <link rel="icon" href="{{ asset('assets') }}/img/logo.png"> -->

    <!--  Open Graph Tags -->
    <meta property="og:title" content="The Admin Template of 2018!">
    <meta property="og:description"
        content="TheAdmin is a responsive, professional, and multipurpose admin template powered with Bootstrap 4.">
    <meta property="og:image" content="http://thetheme.io/theadmin/assets/img/og-img.jpg">
    <meta property="og:url" content="http://thetheme.io/theadmin/">
    <meta name="twitter:card" content="summary_large_image">
</head>

<body class="d-flex flex-column min-vh-100 pace-done">

    <!-- Preloader -->
    <div class="preloader">
        <div class="row">
            <div class="col">
                <i class="fa fa-spinner fa-pulse fa-5x fa-fw my-spinner" role="status"></i>
            </div>
            <div class="col">
                <i class="fa fa-spinner fa-pulse fa-5x fa-fw my-spinner" role="status"></i>
            </div>
            <div class="col">
                <i class="fa fa-spinner fa-pulse fa-5x fa-fw my-spinner" role="status"></i>
            </div>
        </div>
    </div>
    <!-- Sidebar -->
    @include('layouts.theadmin.sidebar')
    <!-- END Sidebar -->

    <!-- Topbar -->
    @include('layouts.theadmin.topbar')
    <!-- END Topbar -->

    <main>
        <!-- Content -->
        @yield('content')
        <!-- End Content -->
        <!-- Footer -->
        @include('layouts.theadmin.footer')
        <!-- END Footer -->
    </main>

    <!-- Global quickview -->
    <div id="qv-global" class="quickview"
        data-url="{{ asset('vendor/bootstrap-theadmin-master') }}/assets/data/quickview-global-for-index.html">
        <div class="spinner-linear">
            <div class="line"></div>
        </div>
    </div>
    <!-- END Global quickview -->

    <!-- Scripts -->

    <script src="{{ asset('vendor/bootstrap-theadmin-master') }}/assets/js/core.min.js"></script>

    <script src="{{ asset('vendor/bootstrap-theadmin-master') }}/assets/js/app.min.js"></script>

    <script src="{{ asset('vendor/bootstrap-theadmin-master') }}/assets/js/script.min.js"></script>

    <script src="{{ asset('vendor/dataTables') }}/datatables.min.js"></script>

    <script src="{{ asset('vendor/sweetalert2') }}/sweetalert2.min.js"></script>

    {{-- <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.11.3/datatables.min.js"></script> --}}

    {{-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script> --}}
    {{-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script> --}}
    {{-- <script type="text/javascript"
        src="https://cdn.datatables.net/v/bs4/dt-1.11.3/b-2.1.1/b-html5-2.1.1/b-print-2.1.1/fc-4.0.1/r-2.2.9/sc-2.0.5/datatables.min.js">
    </script> --}}

    @yield('js')

    @include('sweetalert::alert')

</body>

</html>
