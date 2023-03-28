<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Skytrack - Tracking Solution</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" type="image/x-icon" href="{{ asset(get_setting('frontend_logo_menu')) }}">
    <!-- Place favicon.ico in the root directory -->

    {{-- @extends('frontend.layouts.app') --}}
    @include('frontend.style.style')
    @include('includes.partials.messages')
</head>

<body>
    <header>
        @include('frontend.content.header')
    </header>

    <!-- header-start-end -->

    <!-- main-area -->
    <main>

        <!-- slider-area -->
        @include('frontend.content.banner')
        <!-- slider-area-end -->
        <!-- services-area -->
        @include('frontend.content.services')

        @include('frontend.content.aboutus')
        <!-- services-area-end -->

        <!-- video-area -->
        @include('frontend.content.videoarea')
        <!-- video-area-end -->

        <!-- delivery-services -->
        @include('frontend.content.deliveryServices')
        <!-- delivery-services-end -->
    </main>
    <!-- main-area-end -->

    <!-- footer -->
    @include('frontend.content.footer')

    <!-- footer-end -->
    @include('frontend.style.js')
    </div>
</body>

</html>

<!--app-->
