<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Skytrack - Tracking Solution</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/favicons/2157-img-favicon.png') }}">
    <!-- Place favicon.ico in the root directory -->

    <!-- CSS here -->
    {{-- @extends('frontend.layouts.app') --}}
    {{-- @include('frontend.style.style') --}}
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
</head>

<body>

    <!-- preloader  -->
    <!-- <div id="preloader">
            <div id="ctn-preloader" class="ctn-preloader">
                <div class="animation-preloader">
                    <div class="spinner"></div>
                    <div class="txt-loading">
                        <span data-text-preloader="S" class="letters-loading">
                            S
                        </span>
                        <span data-text-preloader="T" class="letters-loading">
                            T
                        </span>
                        <span data-text-preloader="A" class="letters-loading">
                            A
                        </span>
                        <span data-text-preloader="R" class="letters-loading">
                            R
                        </span>
                        <span data-text-preloader="T" class="letters-loading">
                            T
                        </span>
                        <span data-text-preloader="E" class="letters-loading">
                            E
                        </span>
                        <span data-text-preloader="S" class="letters-loading">
                            S
                        </span>
                        <span data-text-preloader="K" class="letters-loading">
                            K
                        </span>
                    </div>
                </div>
                <div class="loader">
                    <div class="row">
                        <div class="col-3 loader-section section-left">
                            <div class="bg"></div>
                        </div>
                        <div class="col-3 loader-section section-left">
                            <div class="bg"></div>
                        </div>
                        <div class="col-3 loader-section section-right">
                            <div class="bg"></div>
                        </div>
                        <div class="col-3 loader-section section-right">
                            <div class="bg"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
    <!-- preloader end -->

    <!-- header-start -->
    <header>
        @include('frontend.content.header')
    </header>

    <!-- header-start-end -->
    <style>
        .breadcrumb::after {
            border-width: 74px 25px 0 0 !important;
        }

        .breadcrumb::before {
            border-width: 0 0 74px 25px !important;
        }
    </style>
    <!-- main-area -->
    <main>
        <section style="background-image:url(../../{{ get_setting('notice_image') }});padding:50px 0px;">
            <div class="text-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="dots"></li>
                        <li style="font-size: 32px;" class="breadcrumb-item active" aria-current="page">
                            {{ $page->title }}</li>
                        <li class="dots2"></li>
                    </ol>
                </nav>

            </div>
        </section>

        <!-- slider-area -->
        <section class="banner" style="padding:30px 0px">
            <div class="container">
                <div class="blog-details-img">
                    {!! $page->description !!}
                </div>
            </div>
        </section>
        <!-- slider-area-end -->

    </main>
    <!-- main-area-end -->

    <!-- footer -->
    @include('frontend.content.footer')
    <!-- footer-end -->
    @include('frontend.style.js')
</body>

</html>

<!--app-->
