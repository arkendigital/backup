<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>
        @yield('title_prefix', config('adminlte.title_prefix', ''))
        @yield('title', config('adminlte.title', 'AdminLTE 2'))
        @yield('title_postfix', config('adminlte.title_postfix', ''))
    </title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/bootstrap/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/AdminLTE.min.css') }}">
    <style>
        .wrapper {
          height:100%;position:relative;overflow-x:hidden;overflow-y:hidden;
        }
    </style>

    {{-- @if(config('adminlte.plugins.datatables')) --}}
        <!-- DataTables -->
        <link rel="stylesheet" href="//cdn.datatables.net/v/bs/dt-1.10.13/datatables.min.css">
    {{-- @endif --}}

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
        window.App = {!!
            json_encode([
                'homeUrl' => route('index'),
                'signedIn' => auth()->check(),
                'user'     => auth()->user()
            ]);
        !!}
    </script>

    @yield('adminlte_css')

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body class="hold-transition is-admin @yield('body_class')">
    <div id="app">
        @yield('body')
    </div>

    <script src="{{ asset('vendor/adminlte/plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
    <script src="{{ asset('vendor/adminlte/bootstrap/js/bootstrap.min.js') }}"></script>
    {{-- @if(config('adminlte.plugins.datatables')) --}}
        <!-- DataTables -->
        <script src="//cdn.datatables.net/v/bs/dt-1.10.13/datatables.min.js"></script>
    {{-- @endif --}}

    <script>
    $(function () {
        if ($('#datatable').length) {
            $('#datatable').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": false,
                "autoWidth": true,
            });
        }

        if ($('#datatable-nopaging').length) {
            $('#datatable-nopaging').DataTable({
                "paging": false,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": false,
                "autoWidth": false
            });
        }

        if ($('#datatable-noordering').length) {
            $('#datatable-noordering').DataTable({
                "paging": false,
                "lengthChange": false,
                "searching": true,
                "ordering": false,
                "info": false,
                "autoWidth": false
            });
        }
    });
    </script>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

    @include('sweet::alert')

    {{-- <script src="{{ asset('js/app.js') }}"></script> --}}
    @stack('scripts-before')
    @yield('adminlte_js')
    @stack('scripts-after')

</body>
</html>
