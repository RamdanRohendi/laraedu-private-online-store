<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laraedu - @yield('title')</title>

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

        .img-fit-cover {
            object-fit: cover;
            object-position: center;
        }
    </style>

    @stack('styles')
</head>
<body>
    @include('layouts.partials.navbar')

    <div class="position-fixed top-0 end-0 p-3" style="z-index: 9999">
        <div id="liveToast" class="toast align-items-center" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div id="message" class="toast-body text-white"></div>
                <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>

    <header>
        @yield('header')
    </header>

    <main class="container {{ @$no_margin_top ? '' : 'mt-5 pt-3' }}">
        @yield('content')
    </main>

    @include('layouts.partials.footer')

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
