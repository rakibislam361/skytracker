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

    {{-- <link rel="stylesheet" href="{{ asset('assets/css/css-bootstrap.min.css') }}">
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
    <link rel="stylesheet" href="{{ asset('assets/css/css-responsive.css') }}"> --}}
    <link href="{{ asset('icon_img/assets/icons/flaticon.css') }}" rel="stylesheet">
    <link href="{{ asset('icon_img/assets/icons/ionicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('icon_img/assets/icons/linearicons.css') }}" rel="stylesheet">
    <link href="{{ asset('icon_img/assets/icons/simple-line-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('icon_img/assets/icons/themify-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('icon_img/assets/icons/fontAwesome/css/all.css') }}" rel="stylesheet">
    <link href="{{ asset('icon_img/assets/icons/fontAwesome/css/fontawesome.css') }}" rel="stylesheet">
    @include('frontend.style.style')
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset(get_setting('favicon')) }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset(get_setting('favicon')) }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset(get_setting('favicon')) }}">
    <link rel="manifest" href="{{ asset(get_setting('favicon')) }}">
    @stack('before-styles')
    @if ($logged_in_user)
        <link href="{{ mix('css/backend.css') }}" rel="stylesheet">
    @endif
    <livewire:styles />
    @stack('after-styles')
    <style>
        html,
        body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links>a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
</head>

<body>
    <div class="wrapper" id="app">
        <script>
            var settings = document.getElementById('settings_all').innerText;
            window.b2b = settings ? JSON.parse(settings) : {};
        </script>
        @if ($logged_in_user)
            @include('frontend.includes.nav')
            @include('frontend.user.includes.sidebar')
        @else
            @include('frontend.content.header')
        @endif



        <div class="content-wrapper">
            <section class="content-header">
                @include('includes.partials.messages')
                {{-- @include('backend.includes.partials.breadcrumbs') --}}
            </section>

            <section class="content">
                @yield('content')
            </section>
            @if (!$logged_in_user)
                @include('frontend.content.footer')
            @endif
        </div>
    </div>
    <!--app-->
    @stack('before-scripts')
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI="
        crossorigin="anonymous"></script>
    <script src="{{ mix('js/manifest.js') }}"></script>
    <script src="{{ mix('js/vendor.js') }}"></script>
    <script src="{{ mix('js/frontend.js') }}"></script>

    <livewire:scripts />

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
    <script src="{{ asset('assets/js/9626-js-plugins.js') }}"></script>
    <script src="{{ asset('assets/js/2325-js-main.js') }}"></script>
    @stack('after-scripts')
</body>

</html>
