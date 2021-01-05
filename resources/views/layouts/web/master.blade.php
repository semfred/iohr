<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>IOHR - @yield('title')</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="{{ asset('css/web/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="/css/sb-admin-2.css">

    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css" />
    @yield('scripts-header')
</head>
<body id="page-top">
    <div id="wrapper">
        @guest()

        @else
            @include('layouts.web.includes.sidebar')
        @endguest
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content" style="padding-bottom:50px;">
                @guest()

                @else
                    @include('layouts.web.includes.navbar')
                @endguest
                <div class="container-fluid" style="position:relative;">
                        {{--  @auth
                            @if(Auth::user()->isAdmin() || Auth::user()->superuser)
                                @if(request()->segment('2') !== null)
                                <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            @foreach(request()->segments() as $i => $seg)
                                                @if(!$loop->last)
                                                    <li class="breadcrumb-item active"><em>{{ ucfirst($seg) }}</em></li>
                                                @else
                                                    <li class="breadcrumb-item">{{ ucfirst($seg) }}</li>
                                                @endif
                                            @endforeach
                                        </ol>
                                    </nav>
                                @endif
                            @endif
                        @endauth  --}}
                        @if(\Session::has('status'))
                            <div class="alert alert-{{ \Session::get('status')['variant'] }} alert-dismissible fade show">
                                {{ \Session::get('status')['msg'] }}
                            </div>
                        @endif
                        @yield('content')
                </div>
            </div>
            @include('layouts.web.includes.footer')
        </div>
    </div>

    @include('layouts.web.includes.modals.event-modal')

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
    crossorigin="anonymous"></script>


    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    {{-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> --}}
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

    <script src="/js/sb-admin-2.min.js"></script>
    <script src="/js/jquery.easing.min.js"></script>
    <script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script>
    <script src="/js/isotope.pkgd.min.js"></script>
    <script src="https://unpkg.com/infinite-scroll@3/dist/infinite-scroll.pkgd.min.js"></script>


    <!-- DataTables -->
    <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
    <script src="//johnny.github.io/jquery-sortable/js/jquery-sortable-min.js"></script>
    <script src="{{ asset('js/web/app.js') }}" defer></script>
    @yield('scripts-footer')
</body>
</html>
