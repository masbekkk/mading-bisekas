<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Mading Bisekas</title>
    <link rel="shortcut icon" type="image/png" href="assets/img/logo_putih.png" />
    <link rel="icon" type="image/png" href="assets/img/logo_putih.png">
    <link rel="stylesheet" href="admin/assets/css/styles.min.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
    integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    @stack('styles')
</head>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <!-- Sidebar Start -->
        @include('admin.layouts.sidebar')
        <!--  Sidebar End -->
        <!--  Main wrapper -->
        <div class="body-wrapper">
            <!--  Header Start -->
            @include('admin.layouts.header')
            <!--  Header End -->
            @yield('content')
            @include('admin.layouts.footer')
        </div>
        <script src="admin/assets/libs/jquery/dist/jquery.min.js"></script>
        <script src="admin/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

        <script src="admin/assets/libs/simplebar/dist/simplebar.js"></script>
        <script src="admin/assets/js/sidebarmenu.js"></script>
        <script src="admin/assets/js/app.min.js"></script>
        {{-- <script src="admin/assets/js/dashboard.js"></script> --}}
        {{-- <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script> --}}

        <script src="https://cdn.datatables.net/2.1.3/js/dataTables.js"></script>
        <script src="https://cdn.datatables.net/2.1.3/js/dataTables.bootstrap5.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="admin/assets/js/custom-datatable.js"></script>
        <script type="text/javascript">
            $("#button-logout").click(function() {
                Swal.fire({
                    title: 'Logout?',
                    text: "Anda akan keluar dari aplikasi!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya',
                    cancelButtonText: 'Tidak'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $("#logout-form").submit();
                    }
                });
                $(this).removeClass('active')
            });
        </script>

       @stack('scripts')
</body>

</html>
