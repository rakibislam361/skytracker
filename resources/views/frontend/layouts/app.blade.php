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
    <title>{{ appName() }} | @yield('title')</title>
    <meta name="description" content="@yield('meta_description', appName())">
    <meta property="og:image" content="@yield('meta_image')">
    @yield('meta')


</head>

<body>
    <div id="app">
        {{-- <form class="d-none">
            <input type="hidden" id="asset_url" value="{{ asset('/') }}">
            <input type="hidden" id="base_url" value="{{ url('/') }}">
            <span id="settings_all">{{ json_encode(config('settings')) }}</span>
            <script>
                var settings = document.getElementById('settings_all').innerText;
                window.b2b = settings ? JSON.parse(settings) : {};
            </script>
        </form> --}}

        <main>
            @yield('content')
        </main>
    </div>
    <!--app-->

</body>

</html>