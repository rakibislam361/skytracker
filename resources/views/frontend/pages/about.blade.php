@include('frontend.style.style')
@include('frontend.content.header')
@include('frontend.auth.login')

@extends('frontend.layouts.app')

@section('title', __('_About'))
@section('content')

    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @include('frontend.content.aboutus')
            </div>
            <!--col-md-10-->
        </div>
        <!--row-->
    </div>
    <!--container-->
    @include('frontend.content.footer')
@endsection
