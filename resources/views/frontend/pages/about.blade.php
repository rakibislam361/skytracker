@include('frontend.style.style')
@include('frontend.content.header')
@include('frontend.auth.login')




@extends('frontend.layouts.app')


@section('title', __('_About'))
@section('content')

<div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <x-frontend.card>


                <x-slot name="body">
                    @include('frontend.content.aboutus')
                    @include('frontend.content.footer')
                </x-slot>
            </x-frontend.card>
        </div>
        <!--col-md-10-->
    </div>
    <!--row-->
</div>
<!--container-->

@endsection