<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Favicons -->
    <link href="{{ asset('site/img/logo.png') }}" rel="icon">
    {{-- <link href="img/logo.png" rel="icon">
    <!-- CSS -->
    <link rel="stylesheet" href="css/all.css" />
    <link href="bootstrap/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="css/custom.css" rel="stylesheet" type="text/css" /> --}}

    <!-- Scripts -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>


    <link href="{{ asset('site/icofont/icofont.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('site/boxicons/css/boxicons.min.css') }}" rel="stylesheet"/>

    <!-- Scripts -->
    <script src="{{ asset('site/js/main.js') }}" defer></script>
    <script src="{{ asset('site/js/jquery.min.js') }}"></script>
    <script src="{{ asset('site/js/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('site/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">


</head>

<!-- The scrollable area -->
<body>

<!-- ======= Top Bar ======= -->
<div id="topbar" class="d-none d-lg-flex align-items-center fixed-top">
<div class="container d-flex align-items-center justify-content-between">
    <div class="d-flex align-items-center">
        <i class="icofont-clock-time"></i> Monday - Saturday, 7AM to 10PM
    </div>
    <div class="d-flex align-items-center">
        <i class="icofont-phone"></i> Call us now +254 299-999-999
    </div>
</div>
</div>
<hr>

<main class="py-4">
@yield('content')
</main>

<!-- Footer Start -->
<section class="footer">
    <div class="section-title">
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <p class="text-center white">2021 © BBMS. All Rights Reserved.</p>
            </div>
        </div>
    </div>
</section>
<!-- Footer End -->
@yield('javascript')

</body>
