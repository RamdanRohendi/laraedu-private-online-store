<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laraedu - @yield('title')</title>

    <link rel="stylesheet" href="{{ asset('assets/bootstrap/icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/datatables/datatables.min.css') }}">

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        .float-right {
            float: right;
        }

        .space-nowrap {
            white-space: nowrap;
        }

        .sidebar {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            z-index: 100;
            padding: 48px 0 0;
            box-shadow: inset -1px 0 0 rgba(0, 0, 0, .1);
        }

        @media (max-width: 767.98px) {
            .sidebar {
                width: 75%;
            }
        }

        .sidebar-sticky {
            position: relative;
            top: 0;
            height: calc(100vh - 48px);
            padding-top: .5rem;
            overflow-x: hidden;
            overflow-y: auto;
        }

        .navbar-brand {
            padding-top: .75rem;
            padding-bottom: .75rem;
        }

        .navbar .navbar-toggler {
            top: .25rem;
            right: 1rem;
        }

        .nav-link:hover {
            background-color: rgba(0, 0, 0, .25) !important;
        }

        .active:hover {
            background-color: rgba(13, 110, 253) !important;
        }
    </style>

    @stack('styles')
</head>
<body>
    <div class="position-fixed top-0 end-0 p-3" style="z-index: 9999">
        <div id="liveToast" class="toast align-items-center" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div id="message" class="toast-body text-white"></div>
                <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>

    <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 text-center fw-bolder" href="{{ route('home.index') }}">Laraedu</a>
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <form class="me-3 d-none d-md-inline" action="{{ route('logout') }}" method="post">
            @csrf
            <button type="submit" class="btn btn-dark" onclick="return confirm('Are you sure you want to logout?')">
                <i class="bi bi-box-arrow-in-left me-2"></i>Logout</button>
        </form>
    </header>
    @include('layouts.partials.sidebar')

    <main class="col-md-9 ms-sm-auto col-lg-10 px-2 mt-2">
        @yield('content')
        @include('layouts.partials.footer')
    </main>

    <!-- Bootstrap Bundle with Popper -->
    <script src="{{ asset('assets/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/jquery/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('assets/datatables/datatables.min.js') }}"></script>
    <script>
        let isSuccess = {{ session('success') ? 'true' : 'false' }};
        let message = '{{ session('success') ? session('success') : session('error') }}';
        let toastLive = document.getElementById('liveToast');
        let toastMessage = document.getElementById('message');
        let toast = new bootstrap.Toast(toastLive);

        if (isSuccess) {
            toastLive.classList.add('bg-success');
            toastMessage.innerHTML = message;
            toast.show();
        }
    </script>

    @stack('scripts')
</body>
</html>
