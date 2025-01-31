@include('dashboard.layouts.header')
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="{{ asset('assets/dist/img/AdminLTELogo.png') }}" alt="AdminLTELogo" height="60" width="60">
        </div>

        @include('dashboard.layouts.utils.navbar')

        @include('dashboard.layouts.utils.sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @yield('section')
        </div>
        <!-- /.content-wrapper -->
        @include('dashboard.layouts.footer')
</body>
</html>
