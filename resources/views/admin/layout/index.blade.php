
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="{{asset(setting('site_favicon'))}}">
    <!-- loader-->
    <link href="{{asset('/')}}backend/assets/css/pace.min.css" rel="stylesheet" />
    <script src="{{asset('/')}}backend/assets/js/pace.min.js"></script>

    <!--plugins-->
    <link href="{{asset('/')}}backend/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
    <link href="{{asset('/')}}backend/assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
    <link href="{{asset('/')}}backend/assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />

    {{-- cdn --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">

    <!-- CSS Files -->
    <link href="{{asset('/')}}backend/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{asset('/')}}backend/assets/css/bootstrap-extended.css" rel="stylesheet">
    <link href="{{asset('/')}}backend/assets/css/style.css" rel="stylesheet">
    <link href="{{asset('/')}}backend/assets/css/icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">

    <!--Theme Styles-->
    <link href="{{asset('/')}}backend/assets/css/dark-theme.css" rel="stylesheet" />
    <link href="{{asset('/')}}backend/assets/css/semi-dark.css" rel="stylesheet" />
    <link href="{{asset('/')}}backend/assets/css/header-colors.css" rel="stylesheet" />

    <title>
        @stack('title')
    </title>
</head>
<body>
    <!--start wrapper-->
    <div class="wrapper">
        <!--start sidebar -->
        <aside class="sidebar-wrapper" data-simplebar="true">
            <div class="sidebar-header">
                <img src="{{asset(setting('site_logo'))}}" class="logo" alt="logo icon">
            </div>
            <!--navigation-->
            @include('admin.layout.sidebar')
            <!--end navigation-->
        </aside>
        <!--end sidebar -->

        <!--start top header-->
        @include('admin.layout.header')
        <!--end top header-->
        <!-- start page content wrapper-->
        <div class="page-content-wrapper">
            <!-- start page content-->
            @yield('body')
            <!-- end page content-->
        </div>
        <!--Start Back To Top Button-->
        <a href="javaScript:;" class="back-to-top"><ion-icon name="arrow-up-outline"></ion-icon></a>
        <!--End Back To Top Button-->



        <!--start overlay-->
        <div class="overlay nav-toggle-icon"></div>
        <!--end overlay-->
        </div>
    <!--end wrapper-->





    <!-- JS Files-->
    <script src="{{asset('/')}}backend/assets/js/jquery.min.js"></script>
    <script src="{{asset('/')}}backend/assets/plugins/simplebar/js/simplebar.min.js"></script>
    <script src="{{asset('/')}}backend/assets/plugins/metismenu/js/metisMenu.min.js"></script>
    <script src="{{asset('/')}}backend/assets/js/bootstrap.bundle.min.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <!--plugins-->
    <script src="{{asset('/')}}backend/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>

    {{-- cdn  --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>

    <!-- Main JS-->
    <script src="{{asset('/')}}backend/assets/js/main.js"></script>

    <script>
        const notyf = new Notyf({
            duration: 5000,
            ripple: true,
            position: { x: 'right', y: 'top' }
        });

        // Success Toast
        @if(session('success'))
            notyf.success({
                message: "{{ session('success') }}",
                dismissible: true,
                icon: '<i class="fadeIn animated bx bx-check-square"></i>'
            });
        @endif

        // Error Toast
        @if(session('error'))
            notyf.error({
                message: "{{ session('error') }}",
                dismissible: true,
                icon: '<i class="fadeIn animated bx bx-x"></i>'
            });
        @endif

        // Warning Toast
        @if(session('warning'))
            notyf.open({
                type: 'custom',
                background: '#FFA500',
                message: "{{ session('warning') }}",
                dismissible: true,
                icon: '<i class="fadeIn animated bx bx-error"></i>'
            });
        @endif
    </script>


    @stack('js')

    </body>
</html>
