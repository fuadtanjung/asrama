<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/materialize/css/materialize.min.css') }}" media="screen,projection" />
    <!-- Bootstrap Styles-->
    <link href="{{ asset('assets/css/bootstrap.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/custom-styles.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/font-awesome.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/font-awesome.css') }}" rel="stylesheet" />
    <link href="http://fonts.googleapis.com/css?family=Open+Sans" rel='stylesheet' type='text/css' />
    <link rel="stylesheet" href="{{ asset('assets/plugins/izitoast/css/iziToast.min.css') }}">



</head>
<body>
<div id="wrapper">
    @yield('navbar')
</div>
<!-- Scripts -->
<script src="{{ asset('js/jquery-3.5.1.min.js') }}"></script>
<script src="{{ asset('assets/plugins/izitoast/js/iziToast.min.js') }}"></script>
<!-- izitoast -->
@yield('script')


<script src="{{ asset('assets/js/jquery-1.10.2.js')}}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js')}}"></script>

<!-- Bootstrap Js -->
<script src="{{ asset('assets/materialize/js/materialize.js')}}"></script>
<!-- Metis Menu Js -->
<script src="{{ asset('assets/js/jquery.metisMenu.js')}}"></script>
<!-- Custom Js -->
<script src="{{ asset('assets/js/custom.js')}}"></script>
</body>
</html>
