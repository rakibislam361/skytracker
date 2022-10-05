@include('frontend.style.style')
@include('frontend.content.header')
@include('frontend.auth.login')
@extends('frontend.layouts.app')

@section('title', __('Terms & Conditions'))

@section('content')
<div>
  <div class="row justify-content-center">
    <div class="col-md-12">
      <x-frontend.card>
        <x-slot name="body">
          @include('frontend.content.banner')
          @include('frontend.content.trackproduct')
          <div class="pad-80 about-wrap clrbg-before">

          </div>
          @include('frontend.content.footer')
        </x-slot>
      </x-frontend.card>
    </div>
    <!--col-md-10-->
  </div>
  <!--row-->
</div>

@endsection