<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content />
    <meta name="author" content />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>SIRAMU</title>
    @livewireStyles
   <link rel="icon" type="image/x-icon" href="{{ url('assets/favicon.png')}}" />
    <link href="{{ url('css/styles.css')}}" rel="stylesheet" />
    <link href="{{ url('css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ url('plugins/izitoast/css/iziToast.min.css') }}">
    <link href="{{ url('css/tempusdominus-bootstrap-4.min.css')}}" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="{{ url('css/buttons.dataTables.min.css')}}">
    <link href="{{ url('css/select2.min.css')}}" rel="stylesheet" />
    <script src="{{ url('js/font-awesome/all.js')}}"></script>


</head>

<body>
    @yield('navbar')
<!-- Scripts -->

    <script src="{{ url('js/jquery-3.5.1.js') }}"></script>
    <script src="{{ url('js/jquery.datetimepicker.js') }}"></script>
    <script src="{{ url('js/bootstrap.min.js') }}"></script>
    <script src="{{ url('js/script.js') }}"></script>
    <script src="{{ url('plugins/izitoast/js/iziToast.min.js') }}"></script>
    <script src="{{ url('js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ url('js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ url('js/moment.min.js') }}"></script>
    <script src="{{ url('js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <script src="{{ url('js/custom.js') }}"></script>
    <script src="{{ url('js/datetime.js') }}"></script>
    <script src="{{ url('js/select2.min.js')}}"></script>
    <script src="{{ url('js/dataTables.buttons.min.js')}}"></script>
    <script src="{{ url('js/buttons.flash.min.js')}}"></script>
    <script src="{{ url('js/jszip.min.js')}}"></script>
    <script src="{{ url('js/buttons.html5.min.js')}}"></script>
    @livewireScripts
<!-- izitoast -->
@yield('script')

</body>
</html>
