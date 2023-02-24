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
                        <li class="breadcrumb-item active" aria-current="page">Notice</li>
                        <li class="dots2"></li>
                    </ol>
                </nav>

            </div>
        </section>

        <!-- slider-area -->
        <section class="banner" style="padding:30px 0px">

            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <img src="{{ asset('/setting/banner/'.$notice->image) }}" width="800px" height="300px" alt="img"><br>
                        <span>{{ $notice->updated_at }}</span><br><br>
                        <h3> {{$notice->title}}</h3><br>
                        {!! $notice->description !!}
                    </div>
                    <div class="col-md-4">
                        <div class="widget mb-40">
                            <div class="single-sidebar white-bg">
                                <div class="sidebar-title mb-25">
                                    <h3>Recent Notice</h3>
                                </div>
                                <div class="rc-post">
                                    <ul>
                                        @php
                                        $infos = DB::table('notices')
                                        ->where('is_active', 1)
                                        ->take(10)->orderBy('id', 'DESC')
                                        ->get();
                                        @endphp
                                        @foreach ($infos as $info)
                                        <li>
                                            <div class="rc-post-thumb">
                                                <a href="/notice/details/{{ $info->id}}"><img src="{{ asset('/setting/banner/'.$info->image) }}" style="height: 30px;width: 40px;" alt="img"></a>
                                            </div>
                                            <div class="rc-post-content">
                                                <h5><a href="/notice/details/{{ $info->id}}">{{ $info->title }}</a></h5>
                                                <span>{{ $info->updated_at }}</span>
                                            </div>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
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