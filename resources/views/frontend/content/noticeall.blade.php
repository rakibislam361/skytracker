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

    <header>
        @include('frontend.content.header')
    </header>

    <!-- main-area -->
    <main>
        <section style="background-image:url(../../{{ get_setting('notice_image') }});padding:50px 0px;">
            <div class="text-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="dots"></li>
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">All Information</li>
                        <li class="dots2"></li>
                    </ol>
                </nav>

            </div>
        </section>
        <section>
            <div class="container" style="padding:30px 0px">
                <div class="row">
                    @foreach($notices as $info)

                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <img src="{{ asset('/setting/banner/'.$info->image) }}" class="img-fluid" style="height:200px !important" alt="img"><br>
                                <span>{{ $info->updated_at }}</span><br><br>
                                <a href="/notice/details/{{ $info->id}}">
                                    <h5> {{$info->title}}</h5>
                                </a>

                            </div>
                        </div>
                    </div>

                    @endforeach
                </div>

            </div>
        </section>


    </main>
    <!-- main-area-end -->

    <!-- footer -->
    @include('frontend.content.footer')
    <!-- footer-end -->
    @include('frontend.style.js')

</body>

</html>

<!--app-->