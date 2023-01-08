<!doctype html>
@langrtl
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
@else
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@endlangrtl

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ app_name() }} | @yield('title')</title>
    <meta name="description" content="@yield('meta_description', app_name())">
    <meta property="og:image" content="@yield('meta_image')">
    @yield('meta')
    {{-- favicon --}}
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset(get_setting('favicon')) }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset(get_setting('favicon')) }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset(get_setting('favicon')) }}">
    <link rel="manifest" href="{{ asset(get_setting('favicon')) }}">

    <link rel="stylesheet" href="{{ asset('assets/css/css-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/css-animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/css-magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/css-fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/css-aos.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/css-nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/css-flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/css-meanmenu.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/css-slick.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/css-default.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/css-style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/css-responsive.css') }}">
    @include('includes.partials.messages')
</head>

<body>
    <script>
        var settings = document.getElementById('settings_all').innerText;
        window.b2b = settings ? JSON.parse(settings) : {};
    </script>

    <div id="app">
        <main>
            @yield('content')
        </main>
    </div>
    <!--app-->
    <script src="{{ asset('assets/js/vendor-jquery-1.12.4.min.js') }}"></script>
    <script src="{{ asset('assets/js/334-js-popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/3741-js-bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/5085-js-isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets/js/3435-js-slick.min.js') }}"></script>
    <script src="{{ asset('assets/js/312-js-jquery.meanmenu.min.js') }}"></script>
    <script src="{{ asset('assets/js/9446-js-ajax-form.js') }}"></script>
    <script src="{{ asset('assets/js/2815-js-wow.min.js') }}"></script>
    <script src="{{ asset('assets/js/7036-js-aos.js') }}"></script>
    <script src="{{ asset('assets/js/8726-js-paroller.js') }}"></script>
    <script src="{{ asset('assets/js/2092-js-jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('assets/js/2012-js-jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('assets/js/2735-js-jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('assets/js/7521-js-jquery.scrollUp.min.js') }}"></script>
    <script src="{{ asset('assets/js/8228-js-imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets/js/788-js-jquery.magnific-popup.min.js') }}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCo_pcAdFNbTDCAvMwAD19oRTuEmb9M50c"></script>
    <script src="{{ asset('assets/js/9626-js-plugins.js') }}"></script>
    <script src="{{ asset('assets/js/2325-js-main.js') }}"></script>

</body>

</html>