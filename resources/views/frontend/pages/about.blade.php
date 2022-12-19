@include('frontend.style.style')
@include('frontend.content.header')
@include('frontend.auth.login')

@extends('frontend.layouts.app')

@section('title', __('_About'))
@section('content')

    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <x-frontend.card>
                    <x-slot name="body">
                        @include('frontend.content.aboutus')
                    </x-slot>
                </x-frontend.card>
            </div>
            <!--col-md-10-->
        </div>
        <!--row-->
    </div>
    <!--container-->
    @include('frontend.content.footer')
@endsection
