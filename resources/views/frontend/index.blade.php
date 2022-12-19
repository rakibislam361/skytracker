@extends('frontend.layouts.app')
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

        </main>
        <div class="to-top theme-clr-bg transition"> <i class="fa fa-angle-up"></i> </div>



    </div>
    <!--app-->
