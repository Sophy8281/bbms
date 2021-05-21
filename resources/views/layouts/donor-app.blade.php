<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Favicons -->
    <link href="{{ asset('site/img/logo.png') }}" rel="icon">

    <!-- Scripts -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">
        {{-- <div id="topbar" class="d-none d-lg-flex align-items-center fixed-top">
            <div class="container d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <i class="icofont-clock-time"></i> Monday - Saturday, 7AM to 10PM
                </div>
                <div class="d-flex align-items-center">
                    <i class="icofont-phone"></i> Call us now +254 299-999-999
                </div>
            </div>
        </div> --}}
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                   {{-- Donate Blood --}}
                   <img style="height: 50px" src="{{ asset('site/img/logo.jpg') }}" alt="Logo">
                </a>
                {{-- <a href="{{ url('/')}}" style="height: 20px" class=""><img src="{{ asset('site/img/logo.jpg') }}" alt="Logo"></a> --}}
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                        @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @endif

                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                        @endif

                        @else
                        <li class="nav-item">
                            <a class="nav-link p-3" href="{{ url('home/') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link p-3" href="{{ url('home/appointment/') }}">Book an Appointment</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            {{-- @if(\Illuminate\Support\Facades\Auth::guard('admin')->check())
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('admin.logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('admin-logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="admin-logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                            @elseif(\Illuminate\Support\Facades\Auth::guard('staff')->check())
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('staff.logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('staff-logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="staff-logout-form" action="{{ route('staff.logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>

                            @else --}}
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('user.logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('user-logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="user-logout-form" action="{{ route('user.logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                            {{-- @endif --}}
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    @yield('javascript')
</body>

</html>
