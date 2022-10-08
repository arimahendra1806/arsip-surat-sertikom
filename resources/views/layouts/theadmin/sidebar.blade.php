<!-- Sidebar -->
<aside class="sidebar sidebar-expand-lg sidebar-icons-right sidebar-icons-boxed">
    <header class="sidebar-header">
        {{-- <a class="logo-icon" href="index.html"><img
                src="{{ asset('vendor/bootstrap-theadmin-master') }}/assets/img/logo-icon-light.png" alt="logo icon"></a> --}}
        <!-- <span class="logo"> -->
        <!-- <a class="logo-icon" href="index.html"><img src="{{ asset('vendor/bootstrap-theadmin-master') }}/assets/img/logo-icon-light.png" alt="logo icon"></a> -->
        <a href="#">ARSIP ONLINE KARANGDUREN</a>
        <!-- </span> -->
        <span class="sidebar-toggle-fold"></span>
    </header>

    <nav class="my-subcolor sidebar-navigation">
        <ul class="menu">

            <li class="menu-category">Menu Kelola Arsip</li>

            <li class="menu-item">
                {{-- <a class="menu-link" href="{{ route('dashboard.koor') }}"> --}}
                <a class="menu-link" href="{{ route('arsip.index') }}">
                    <span class="icon fa fa-archive"></span>
                    <span class="title">Arsip</span>
                </a>
            </li>

            <li class="menu-item">
                <a class="menu-link" href="{{ route('about.index') }}">
                    <span class="icon fa fa-info"></span>
                    <span class="title">About</span>
                </a>
            </li>
        </ul>
    </nav>

</aside>
<!-- END Sidebar -->
