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
                        <!-- Modal Search -->
                        <div class="modal fade" id="search-modal" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <form>
                                        <input type="text" placeholder="Search here..." spellcheck="false"
                                            data-ms-editor="true">
                                        <button><i class="fa fa-search"></i></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog"
                            aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="container">
                                    <div class="row ownmodal">
                                        <div class="col-md-6" style="background-color: #4e148c;">

                                            <div class="card" style="background-color: #4e148c; border:0px;">
                                                <div class="card-header" style="border:0px;">
                                                    <div
                                                        style="display: flex; justify-content: center; font-size: 150%; color: white; font-weight: bold;">
                                                        Approximate shipping cost</div>
                                                </div>
                                                <div class="card-body">
                                                    <div
                                                        style="display: flex; flex-direction: row; justify-content: space-around;">
                                                        <div style="font-size: 120%; color: white;">Ship By</div>
                                                        <div style="font-size: 120%; color: white; font-weight: bold;">
                                                            air
                                                        </div>
                                                    </div>
                                                    <div
                                                        style="display: flex; flex-direction: row; justify-content: space-around;">
                                                        <div style="font-size: 120%; color: white;">Ship From</div>
                                                        <div style="font-size: 120%; color: white; font-weight: bold;">
                                                            china
                                                        </div>
                                                    </div>
                                                    <div
                                                        style="display: flex; flex-direction: row; justify-content: space-around;">
                                                        <div style="font-size: 120%; color: white;">Product Type
                                                        </div>
                                                        <div style="font-size: 120%; color: white; font-weight: bold;">
                                                            chemical</div>
                                                    </div>
                                                    <div
                                                        style="display: flex; flex-direction: row; justify-content: space-around;">
                                                        <div style="font-size: 120%; color: white;">Per kg</div>
                                                        <div style="font-size: 120%; color: white; font-weight: bold;">
                                                            2000tk/kg</div>
                                                    </div>
                                                    <div
                                                        style="display: flex; flex-direction: row; justify-content: space-around;">
                                                        <div
                                                            style="display: flex; flex-direction: column; font-size: 120%; color: white;">
                                                            Total weight </div>
                                                        <div style="font-size: 120%; color: white; font-weight: bold;">
                                                            5 kg
                                                        </div>
                                                    </div>

                                                    <div class="row"
                                                        style="display: flex; flex-direction: row; justify-content: space-around;">
                                                        <div style="font-size: 150%; color: white; font-weight: bold;">
                                                            Total
                                                        </div>
                                                        <div style="font-size: 150%; color: white; font-weight: bold;">
                                                            10000Tk
                                                        </div>
                                                    </div>
                                                    <div
                                                        style="color: white; font-size: 100%; display: flex; justify-content: center;">
                                                        (IF 1 CBM= 167kg)</div>

                                                    <div class="row"
                                                        style="color: orange; font-family: sans-serif; display: flex; justify-content: center; padding: 30px 15px 0px 20px;">
                                                        **৫ কেজির নিচের সকল পার্সেল এর দাম সাধারণ দামের চেয়ে
                                                        তুলনামূলক ভাবে
                                                        বেশি
                                                        থাকবে ।</div>

                                                    <div class="row mt-3">
                                                        <div class="col">
                                                            <div class="center-head" style="margin-bottom: 0px;">
                                                                <span style="text-transform: none; color: red;">read
                                                                    carefully</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div
                                                        style="color: white; padding-top: 15px; padding-bottom: 10px;">
                                                        উপরের
                                                        রেটটি সম্ভাব্য রেট। কনফার্ম রেট পেতে নিচের তথ্য প্রদান
                                                        পূর্বক বুকিং
                                                        করুন
                                                        । বুকিং এর ২৪ ঘণ্টার মধ্যে আপনার শিপমেন্টের সকল প্রকার খরচ
                                                        আপনাকে
                                                        জানিয়ে
                                                        দেয়া হবে।</div>
                                                </div>
                                            </div>


                                        </div> {{-- leftSideEndHere --}}
                                        <div class="col-md-6">
                                            <div class="card" style="border:0px;">
                                                <div class="card-header" style="border:0px;">
                                                    <div
                                                        style="display: flex; justify-content: center; font-size: 150%; font-weight: bold;">
                                                        Book your shipping order</div>
                                                </div>
                                                <div class="card-body">
                                                    <div class="modal-content fare-rate-modal">
                                                        <form action="#" method="post">

                                                            <div class="form-row mb-1">Select Date:</div>
                                                            <div class="form-row mb-2">
                                                                <div class="col"><input type="date"
                                                                        name="date" class="form-control"
                                                                        placeholder="approx date" required=""
                                                                        value=""
                                                                        style="border-radius: 10rem; width: 60%;">
                                                                </div>
                                                            </div>
                                                            <div class="form-row mb-1">Carton quantity:</div>
                                                            <div class="form-row mb-2">
                                                                <div class="col"><input type="number"
                                                                        name="ctnQuantity" class="form-control"
                                                                        placeholder="quantity" required=""
                                                                        value=""
                                                                        style="border-radius: 10rem; width: 60%;">
                                                                </div>
                                                            </div>
                                                            <div class="form-row mb-1">Total CBM:</div>
                                                            <div class="form-row mb-2">
                                                                <div class="col"><input type="number"
                                                                        name="totalCbm" class="form-control"
                                                                        placeholder="total CBM" required=""
                                                                        value=""
                                                                        style="border-radius: 10rem; width: 60%;">
                                                                </div>
                                                            </div>
                                                            <div class="form-row mb-1">Product Quantity:</div>
                                                            <div class="form-row mb-2">
                                                                <div class="col"><input type="number"
                                                                        name="productQuantity" class="form-control"
                                                                        placeholder="product quantity" required=""
                                                                        value=""
                                                                        style="border-radius: 10rem; width: 60%;">
                                                                </div>
                                                            </div>
                                                            <div class="form-row mb-1">Products Total Cost:</div>
                                                            <div class="form-row mb-2">
                                                                <div class="col"><input type="number"
                                                                        name="productsTotalCost" class="form-control"
                                                                        placeholder="total Cost(BDT)" required=""
                                                                        value=""
                                                                        style="border-radius: 10rem; width: 60%;">
                                                                </div>
                                                            </div>
                                                            <div class="form-row mb-1">Product Name (specific):
                                                            </div>
                                                            <div class="form-row mb-2">
                                                                <div class="col"><input type="text"
                                                                        name="othersProductName" class="form-control"
                                                                        placeholder="product name" required=""
                                                                        value=""
                                                                        style="border-radius: 10rem; width: 60%;">
                                                                </div>
                                                            </div>
                                                            <div class="form-row mb-1">Products Image:</div>
                                                            <div class="form-row mb-4">
                                                                <div class="box-input-file"
                                                                    style="display: flex; justify-content: center;">
                                                                    <input id="upload-image-input" class="upload"
                                                                        type="file">
                                                                </div>
                                                            </div>
                                                        </form>
                                                        <button class="btn f-right nextBtn-2 btn-success"
                                                            type="button">Book Now</button>
                                                    </div>
                                                </div>

                                            </div>


                                        </div>{{-- RightSideEndHere --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </header>
    </header>

    <!-- header-start-end -->

    <!-- main-area -->
    <main>

        <!-- slider-area -->
        <section class="s-slider-area">
            <div class="s-slider-bg fix" style="background-image:url({{ get_setting('banner_image_back') }})">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="slider-content text-center mt-145">
                                <h2 data-animation="fadeInUpS" data-delay=".3s" class=""
                                    style="animation-delay: 0.3s;">{{ get_setting('banner_text_header') }}</h2>
                                <p data-animation="fadeInUpS" data-delay=".6s" class=""
                                    style="animation-delay: 0.6s;">{{ get_setting('banner_text_bottom') }}</p>
                                <div class="slider-form" data-animation="fadeInUpS" data-delay=".9s"
                                    style="animation-delay: 0.9s;">
                                    <form action="#">
                                        <div class="col-md-1 mbb-10">
                                            <select class="custom-select" name="" id="">
                                                <option value="">D2D</option>
                                            </select>
                                        </div>
                                        <div class="col-md-2 mbb-10">
                                            <select class="custom-select" name="" id="">
                                                <option value="">Select Country</option>
                                                <option value="">China</option>
                                                <option value="">Hongkong</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" placeholder="Dhaka Bangladesh" tabindex="0"
                                                spellcheck="false" readonly data-ms-editor="true">
                                        </div>
                                        <div class="col-md-2">
                                            <input type="text" placeholder="Enter Weight(KG)" tabindex="0"
                                                spellcheck="false" data-ms-editor="true">
                                        </div>
                                        <div class="col-md-3 mbb-10">
                                            <select class="custom-select" name="" id="">
                                                <option value="">Select Product Type</option>
                                                <option value="">Bag</option>
                                                <option value="">Jewelry</option>
                                            </select>
                                        </div>

                                        <div class="col-md-1"><button data-toggle="modal"
                                                data-target="#exampleModalLong" class="btn" tabindex="-1"><i
                                                    class="flaticon-magnifying-glass"></i></button></div>
                                        <!-- <button class="btn" tabindex="-1">Tracking</button> -->
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="slider-golve">
                    <img src="{{ asset(get_setting('banner_image')) }}" class="rotateme" alt="">
                </div>

            </div>
        </section>
        <!-- slider-area-end -->


        <!-- services-area -->
        <section class="services-area pt-110">
            <div class="faq-wrapper">
                <div class="row">
                    <div class="col-xl-4 col-lg-5">
                        <div class="nav flex-column nav-pills faq-tab-pills" id="v-pills-tab" role="tablist"
                            aria-orientation="vertical">
                            <a class="nav-link active show" id="v-pills-home-tab" data-toggle="pill"
                                href="#v-pills-home" role="tab" aria-controls="v-pills-home"
                                aria-selected="false">
                                <div class="faq-tab-icon">
                                    <i class="far fa-bell"></i>
                                </div>
                                <div class="faq-tab-content d-none d-lg-block">
                                    <h5 class="mt-xl-3">Notice Board</h5>

                                </div>
                            </a>
                            <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile"
                                role="tab" aria-controls="v-pills-profile" aria-selected="true">
                                <div class="faq-tab-icon">
                                    <i class="fas fa-info"></i>

                                </div>
                                <div class="faq-tab-content d-none d-lg-block">
                                    <h5 class="mt-xl-3">More Imformation</h5>

                                </div>
                            </a>

                        </div>
                    </div>
                    <div class="col-xl-8 col-lg-7">
                        <div class="tab-content" id="v-pills-tabContent">
                            <div class="tab-pane fade active show" id="v-pills-home" role="tabpanel"
                                aria-labelledby="v-pills-home-tab">
                                <div class="faq-accordion iconColor">
                                    <div class="faq-tab-icon">
                                        <i class="far fa-bell"></i>
                                    </div>
                                    <div class="faq-accordion-content fix">

                                        <div class="accordion" id="accordionExample">
                                            <div class="card">
                                                <div class="f-rc-post">
                                                    <ul>
                                                        @php
                                                            $notices = DB::table('notices')
                                                                ->where('is_active', 1)
                                                                ->take(5)
                                                                ->get();
                                                        @endphp
                                                        @foreach ($notices as $notice)
                                                            <li>
                                                                <div class="f-rc-content">
                                                                    <h5><a href="/notice/details/{{{{ $notice->id}}}}">{{ $notice->title }}</a>
                                                                    </h5>
                                                                    <span>{{ $notice->updated_at }}</span>

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
                            <div class="tab-pane fade" id="v-pills-profile" role="tabpanel"
                                aria-labelledby="v-pills-profile-tab">
                                <div class="faq-accordion iconColor1">
                                    <div class="faq-tab-icon">
                                        <i class="fas fa-info"></i>
                                    </div>
                                    <div class="faq-accordion-content fix">

                                        <div class="accordion" id="accordionAwardExample">
                                            <div class="card">
                                                <div class="f-rc-post">
                                                    <ul>
                                                        @php
                                                            $infos = DB::table('infos')
                                                                ->where('is_active', 1)
                                                                ->take(5)
                                                                ->get();
                                                        @endphp
                                                        @foreach ($infos as $info)
                                                            <li>
                                                                <div class="f-rc-content">
                                                                    <h5><a href="/info/details/{{{{ $notice->id}}}}">{{ $info->title }}</a></h5>
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

                        </div>
                    </div>
                </div>
            </div>
        </section>




        <section class="international-services pb-120 pt-70 fix">
            <div class="container">
                <div class="services-wrapper">
                    <div class="row align-items-center">
                        <div class="col-lg-4">
                            <div class="s-section-title mb-30">
                                <h2>{{ get_setting('about_text_header') }}</h2>
                                <h6>{{ get_setting('about_text_bottom') }}</h6>
                            </div>
                            <div class="int-services-content">
                                <p>{{ get_setting('about_text_details') }}.</p>
                                <a href="#" class="btn mb-5">Contact Us</a>
                            </div>
                        </div>
                        <div class="col-lg-8">

                            <div class="row padStyle">
                                <div class="col-lg-4 col-md-6">
                                    <div class="single-choose mb-40">
                                        <div class="choose-head">
                                            <div class="choose-icon mb-25">
                                                <img class="mx-auto d-block"
                                                    src="{{asset(get_setting('about_image_1'))}}"
                                                    alt="img" width="100px">
                                            </div>
                                            <h3 class="text-center"><a
                                                    href="#">{{ get_setting('about_image_title_1') }}</a></h3>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <div class="single-choose mb-40">
                                        <div class="choose-head">
                                            <div class="choose-icon mb-25">
                                                <img class="mx-auto d-block"
                                                    src="{{asset(get_setting('about_image_2'))}}"
                                                    alt="img" width="100px">
                                            </div>
                                            <h3 class="text-center"><a
                                                    href="#">{{ get_setting('about_image_title_2') }}</a></h3>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <div class="single-choose mb-40">
                                        <div class="choose-head">
                                            <div class="choose-icon mb-25">
                                                <img class="mx-auto d-block"
                                                    src="{{asset(get_setting('about_image_3'))}}"
                                                    alt="img" width="100px">
                                            </div>
                                            <h3 class="text-center"><a
                                                    href="#">{{ get_setting('about_image_title_3') }}</a></h3>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <div class="single-choose mb-40">
                                        <div class="choose-head">
                                            <div class="choose-icon mb-25">
                                                <img class="mx-auto d-block"
                                                    src="{{asset(get_setting('about_image_4'))}}"
                                                    alt="img" width="100px">
                                            </div>
                                            <h3 class="text-center"><a
                                                    href="#">{{ get_setting('about_image_title_4') }}</a></h3>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <div class="single-choose mb-40">
                                        <div class="choose-head">
                                            <div class="choose-icon mb-25">
                                                <img class="mx-auto d-block"
                                                    src="{{asset(get_setting('about_image_5'))}}"
                                                    alt="img" width="100px">
                                            </div>
                                            <h3 class="text-center"><a
                                                    href="#">{{ get_setting('about_image_title_5') }}</a></h3>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <div class="single-choose mb-40">
                                        <div class="choose-head">
                                            <div class="choose-icon mb-25">
                                                <img class="mx-auto d-block"
                                                    src="{{asset(get_setting('about_image_6'))}}"
                                                    alt="img" width="100px">
                                            </div>
                                            <h3 class="text-center"><a
                                                    href="#">{{ get_setting('about_image_title_6') }}</a></h3>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="overlay-title paroller" data-paroller-factor="0.15" data-paroller-factor-lg="0.15"
                data-paroller-factor-md="0.15" data-paroller-factor-sm="0.15" data-paroller-type="foreground"
                data-paroller-direction="horizontal">Cargo</div>
        </section>
        <!-- services-area-end -->

        <!-- video-area -->
        <section class="video-area"
            style="background-image: url({{ get_setting('bottombanner_image') }});overflow: hidden;background-position: center;background-size: cover;">
            <div class="container">
                <div class="" style="background-color:{{ get_setting('bottom_bg_color') }};width:880px">
                    <div class="row align-items-center">
                        <div class="col-xl-5 col-lg-8 order-2 order-lg-0">
                            <div class="video-title">
                                <span>{{ get_setting('bottombanner_text_header') }}</span>
                                <h2>{{ get_setting('bottombanner_text_bottom') }}</h2>
                                <a href="#">more services<span></span></a>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="video-play">
                                <a href="{{ get_setting('bottom_video_link') }}" class="popup-video"><img
                                        src="{{ asset('assets/images/icon-play_btn.png') }}" alt="img"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- video-area-end -->

        <!-- delivery-services -->
        <section class="delivery-services fix pt-110">
            <div class="overlay-title paroller" data-paroller-factor="0.15" data-paroller-factor-lg="0.15"
                data-paroller-factor-md="0.15" data-paroller-factor-sm="0.15" data-paroller-type="foreground"
                data-paroller-direction="horizontal">service</div>

            <div class="container">
                <div class="delivery-services-wrap">
                    <div class="row justify-content-center">
                        <div class="col-xl-7 col-lg-10">
                            <div class="s-section-title text-center mb-60">
                                <h2>{{ get_setting('work_text_header') }}</h2>
                                <!-- <p>Express delivery is an innovative service is effective logistics solution for the delivery of small
                                        cargo. This service is useful for companies various.</p> -->
                            </div>
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <div class="col-xl-4 col-lg-6 col-md-6">
                            <div class="single-delivery-services mb-70 pr-75">
                                <div class="ds-icon order-0 order-md-2">
                                    <img src="{{ asset(get_setting('work_image_1')) }}" alt="icon">
                                </div>
                                <div class="ds-content text-center text-sm-left text-md-right">
                                    <h5>{{ get_setting('work_image_title_1') }}</h5>
                                    <p>{{ get_setting('work_image_bottom_1') }}</p>
                                </div>
                            </div>

                        </div>
                        <div class="col-xl-4 col-lg-6 col-md-6">
                            <div class="single-delivery-services mb-70 pr-75">
                                <div class="ds-icon order-0 order-md-2">
                                    <img src="{{ asset(get_setting('work_image_2')) }}" alt="icon">
                                </div>
                                <div class="ds-content text-center text-sm-left text-md-right">
                                    <h5>{{ get_setting('work_image_title_2') }}</h5>
                                    <p>{{ get_setting('work_image_bottom_2') }}</p>
                                </div>
                            </div>

                        </div>
                        <div class="col-xl-4 col-lg-6 col-md-6">
                            <div class="single-delivery-services mb-70 pr-75">
                                <div class="ds-icon order-0 order-md-2">
                                    <img src="{{ asset(get_setting('work_image_3')) }}" alt="icon">
                                </div>
                                <div class="ds-content text-center text-sm-left text-md-right">
                                    <h5>{{ get_setting('work_image_title_3') }}</h5>
                                    <p>{{ get_setting('work_image_bottom_3') }}</p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- delivery-services-end -->

        <!-- fact-area -->

        <!-- fact-area-end -->

        <!-- section-area -->

        <!-- section-area-end -->

        <!-- control-area -->

        <!-- control-area-end -->

        <!-- brand-area -->

        <!-- brand-area-end -->

        <!-- newsletter -->

        <!-- newsletter-end -->

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
