{{-- @extends('frontend.layouts.app')
@include('frontend.style.style')
@section('title', get_setting('meta_title'))
@section('meta_title', get_setting('meta_title'))
@section('meta_description', get_setting('meta_description'))
@section('meta_image', asset(get_setting('meta_image')))

@php
    $catLoader = get_setting('category_image_loader');
    $productLoader = get_setting('product_image_loader');
    
@endphp

@section('content')


    <div id="app" class="flex-center position-ref full-height">

        <main class="wrapper">

            @include('frontend.content.header')

            <article>

                @include('frontend.content.banner')

                @include('frontend.content.trackproduct')

                @include('frontend.content.aboutus')

            </article>

            @include('frontend.content.footer')

            @include('frontend.auth.login')
            @include('frontend.pages.d2dpopup')

        </main>
        <div class="to-top theme-clr-bg transition"> <i class="fa fa-angle-up"></i> </div>



    </div> --}}


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
        <header>

            <div id="header-sticky" class="main-header">
                <div class="container-fluid header-container-p">
                    <div class="row align-items-center">
                        <div class="col-lg-3 col-md-6">
                            <div class="logo">
                                <a href="{{ route('frontend.index') }}"><img
                                        src="{{ asset(get_setting('frontend_logo_menu')) }}" class="mobile-logo"
                                        alt="Logo"></a>
                            </div>
                        </div>
                        <div class="col-lg-9 col-md-6 d-none d-md-block">
                            <div class="menu-area">
                                <div class="main-menu">
                                    <div class="mean-push"></div>
                                    <nav id="mobile-menu" style="display: none;">
                                        <ul>
                                            <li class="active"><a href="{{ route('frontend.index') }}">Home</a></li>
                                            {{-- <li><a href="{{ route('frontend.auth.login') }}">Login</a></li> --}}
                                            {{-- <li><a href="{{ route('frontend.auth.register') }}">Register</a></li> --}}
                                            <li> @auth
                                                    @if ($logged_in_user->isAdmin())
                                                <li>
                                                    <a href="{{ route('admin.dashboard') }}">
                                                        {{ $logged_in_user->name }} </a>
                                                </li>
                                                @endif

                                                @if ($logged_in_user->isUser())
                                                    <li>
                                                        <a href="{{ route('frontend.user.dashboard') }}">
                                                            {{ $logged_in_user->name }} </a>
                                                    </li>
                                                @endif
                                            @else
                                                @if (config('boilerplate.access.user.registration'))
                                                    <li>
                                                        <a href="{{ route('frontend.auth.login') }}">Login</a>
                                                    </li>
                                                    <li><a href="{{ route('frontend.auth.register') }}">Register</a></li>
                                                @endif

                                            @endauth
                                            </li>
                                            <li><a href="{{ route('frontend.pages.tracking') }}">Tracking</a></li>
                                            <li><a href="#">Support</a></li>

                                        </ul>
                                    </nav>
                                </div>

                                <div class="header-btn">
                                    <!-- <a href="#" class="btn" data-toggle="modal" data-target="#exampleModalLong"><img src="img/icon/calculator-symbols.png" alt="icon">Get Fare Rate</a> -->
                                    @auth
                                        @if ($logged_in_user->isAdmin())
                                            <li>
                                                <a href="{{ route('admin.dashboard') }}" class="btn">
                                                    {{ $logged_in_user->name }} </a>
                                            </li>
                                        @endif

                                        @if ($logged_in_user->isUser())
                                            <li>
                                                <a href="{{ route('frontend.user.dashboard') }}" class="btn">
                                                    {{ $logged_in_user->name }} </a>
                                            </li>
                                        @endif
                                    @else
                                        @if (config('boilerplate.access.user.registration'))
                                            <li>
                                                <a href="{{ route('frontend.auth.login') }}"
                                                    class="btn">Login/Register</a>
                                            </li>
                                        @endif

                                    @endauth
                                    <a href="{{ route('frontend.pages.tracking') }}" class="btn"
                                        data-target="#exampleModalLong">Track Your
                                        Order</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mobile-menu mean-container">

                            </div>
                        </div>
                        
                    </div>
                </div>
        </header>
    </header>

    <!-- header-start-end -->

    <!-- main-area -->
    <main>
    <section  style="background-image:url(../../{{ get_setting('notice_image') }});padding:50px 0px;">
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
        @foreach($infos as $info)
       
    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
            <img src="{{ asset('/setting/banner/'.$info->image) }}" class="img-fluid" style="height:200px !important"  alt="img"><br>
                    <span>{{ $info->updated_at }}</span><br><br>
                    <a href="/info/details/{{ $info->id}}">    <h5>  {{$info->title}}</h5></a>
                    
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
    <footer>
        <div class="footer-wrap pt-50" data-background="img/bg/footer_bg.jpg">
            <div class="container">
                <div class="row">
                    <div class="col-xl-3 col-lg-4 col-md-6">
                        <div class="footer-widget mb-50">
                            <div class="footer-logo mb-35">
                                <a href="{{ route('frontend.index') }}"><img
                                        src="{{ asset(get_setting('frontend_logo_footer')) }}" alt="img"></a>
                            </div>
                            <div class="footer-text">
                                <p><strong>Head Office</strong></p>
                                <p>{{ get_setting('office_address') }}</p>
                                <p><strong>Email</strong></p>
                                <p>{{ get_setting('office_email') }}</p>
                                <p><strong>Phone</strong></p>
                                <p>{{ get_setting('office_phone') }}</p>
                            </div>

                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-6">
                        <div class="footer-widget mb-50">
                            <div class="fw-title mb-30">
                                <h5>CUSTOMER</h5>
                            </div>
                            <div class="fw-link">
                                <ul>
                                    <li><a href="#"><i class="fas fa-caret-right"></i> About us</a></li>
                                    <li><a href="#"><i class="fas fa-caret-right"></i> Delivery Information</a>
                                    </li>
                                    <li><a href="#"><i class="fas fa-caret-right"></i> Terms &amp;
                                            Conditions</a></li>
                                    <li><a href="#"><i class="fas fa-caret-right"></i> Privacy Policy</a></li>
                                    <li><a href="#"><i class="fas fa-caret-right"></i> Refund Policy</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-6">
                        <div class="footer-widget mb-50">
                            <div class="fw-title mb-30">
                                <h5>INFORMATION</h5>
                            </div>
                            <div class="fw-link">
                                <ul>
                                    <li><a href="#"><i class="fas fa-caret-right"></i> About us</a></li>
                                    <li><a href="#"><i class="fas fa-caret-right"></i> Delivery Information</a>
                                    </li>
                                    <li><a href="#"><i class="fas fa-caret-right"></i> Terms &amp;
                                            Conditions</a></li>
                                    <li><a href="#"><i class="fas fa-caret-right"></i> Privacy Policy</a></li>
                                    <li><a href="#"><i class="fas fa-caret-right"></i> Refund Policy</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-6">
                        <div class="footer-widget mb-50">
                            <div class="fw-title mb-30">
                                <h5>MOBILE APPS</h5>
                            </div>
                            <div class="f-support-content mb-30">
                                <a href="#" class="f-download-btn"><img
                                        src="{{ asset('assets/images/images-f_download_btn01.png') }}"
                                        alt="img"></a>
                                <a href="#" class="f-download-btn"><img
                                        src="{{ asset('assets/images/images-f_download_btn02.png') }}"
                                        alt="img"></a>
                            </div>
                            <div class="fw-title mb-30">
                                <h5>SOCIAL LINKS</h5>
                            </div>
                            <div class="f-support-content">
                                <div class="footer-social">
                                    <ul>
                                        <li><a href="{{ get_setting('facebook') }}"><i
                                                    class="fab fa-facebook-f"></i></a></li>
                                        <li><a href="{{ get_setting('twitter') }}"><i class="fab fa-twitter"></i></a>
                                        </li>
                                        <li><a href="{{ get_setting('linkedin') }}"><i
                                                    class="fab fa-pinterest-p"></i></a></li>
                                        <li><a href="{{ get_setting('youtube') }}"><i
                                                    class="fab fa-linkedin-in"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright-wrap">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-12">
                        <div class="copyright-text">
                            <p>{{ get_setting('copyright_text') }}</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </footer>
    <!-- footer-end -->

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

<!--app-->
