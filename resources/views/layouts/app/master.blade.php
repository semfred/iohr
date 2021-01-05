<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'IOHR') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Styles -->
    {{-- <link rel="stylesheet" href="/css/sb-admin-2.css"> --}}
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    {{-- <link rel="stylesheet" href="/css/pixeladmin.min.css"> --}}
    {{-- <link rel="stylesheet" href="/css/widgets.min.css"> --}}
    {{-- <link rel="stylesheet" href="/css/clean.min.css"> --}}
</head>
<body id="page-top">

    @yield('content')


    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="/js/jquery.js"></script>
    {{-- <script src="/js/bootstrap.bundle.min.js"></script> --}}
    <script src="/js/jquery.easing.min.js"></script>
    {{-- <script src="/js/sb-admin-2.min.js"></script> --}}
    {{-- <script src="/js/bootstrap.min.js"></script> --}}
    {{-- <script src="/js/pixeladmin.min.js"></script> --}}

</body>
</html>