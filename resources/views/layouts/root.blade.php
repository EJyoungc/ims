<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">

    <link rel="stylesheet" href="{{ asset('dist/css/style.css') }}">

    <!-- Scripts -->
    <link rel="stylesheet" href="{{ asset('dist/webfont/tabler-icons.min.css') }}">
    {{-- @vite(['dist/webfont/tabler-icons.min.css', 'dist/css/style.css', 'plugins/fontawesome-free/css/all.min.css']) --}}

    <!-- Styles -->
    @livewireStyles
</head>

<body class="hold-transition sidebar-mini">
     <style>
        #livewire-progress-bar {
            position: fixed;
            top: 0;
            left: 0;
            width: 0%;
            height: 3px;
            /* visible height */
            background-color: #0d6efd;
            /* bootstrap primary color */
            z-index: 9999;
            transition: width 0.2s ease;
        }
    </style>

    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        @livewire('nav.livewire-top')
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        @livewire('navigation-menu-left')
        @livewire('access.recovery-question-livewire')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            {{ $slot }}
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
                <b>Version</b> {{ config('nativephp.version') }}
            </div>
             <strong>© {{ date('Y') }} Built by <a href="http://techlink360.net" class="text-muted">Techlink360</a></strong> ·
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->



    @livewireScripts
    <script src="{{ asset('plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
    <x-livewire-alert::scripts />

    <script>
        // document.addEventListener('livewire:init', () => {
        Livewire.on('modal-open', (data) => {
            // Handle the event here
            var modalbackdrop = document.createElement('div');
            modalbackdrop.classList.add("modal-backdrop", "fade", "show");
            document.body.appendChild(modalbackdrop);

        });
        Livewire.on('modal-cancel', (data) => {
            // Handle the event here
            var modalbackdrop = document.querySelector('.modal-backdrop');
            if (modalbackdrop) {
                modalbackdrop.parentNode.removeChild(modalbackdrop);
            }

        });
        // });
    </script>


    <script>
        document.addEventListener("livewire:init", () => {
            Livewire.hook('request', ({
                fail
            }) => {
                fail(({
                    status
                }) => {
                    if (status === 401 || status === 419) {
                        window.location.href = "{{ route('login') }}";
                    }
                });
            });
        });
    </script>

    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    {{-- <script src="{{ asset('dist/js/demo.js')}}"></script> --}}
    <script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
    @stack('scripts')


</body>

</html>
