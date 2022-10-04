@include('frontend.style.style')
@include('frontend.content.header')
@extends('frontend.layouts.app')

@section('title', __('_contact'))

@section('content')
<div class="container py-4">
  <div class="row justify-content-center shadow pad-80 about-wrap clrbg-before">
    <div class="contact-shadow">
         <a class="contact-shadow" href="{{ route('frontend.pages.contact') }}">
            <h2> Contact Us </h2>
         </a>
        </div>
    <div class="col-md-12">
      <x-frontend.card>
        

       <x-slot name="body">
                <x-forms.post>
                    <div class="form-group row">
                        <label for="name" class="col-md-4 text-right">@lang('Name')</label>

                        <div class="col-md-5">
                            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" placeholder="{{ __('Name') }}" maxlength="100" required autofocus autocomplete="name" />
                        </div>
                    </div>
                    <!--form-group-->

                    <div class="form-group">
                        <label for="name" class="col-md-4 text-right">@lang('E-mail Address')</label>

                        <div class="col-md-5">
                            <input type="email" name="email" id="email" class="form-control" placeholder="{{ __('E-mail Address') }}" value="{{ old('email') }}" maxlength="255" required autocomplete="email" />
                        </div>
                    </div>
                    <!--form-group-->

                    <div class="form-group">
                        <label for="name" class="col-md-4 col-form-label text-right">@lang('Contact Us')</label>

                        <div class="col-md-5">
                            <input type="textarea" name="contact" id="contact" class="form-control" placeholder="{{ __('Contact Us') }}" rows="4" cols="50" />
                        </div>
                    </div>
                    <!--form-group-->
                    
                    <div class="form-group">
                        <div class="col-md-7">
                            <div class="form-group text-right">
                            <button class="btn btn-primary" type="submit">@lang('Contact')</button>
                        </div>
                    </div>
                     </div>
                    <!--form-group-->
                </x-forms.post>
            </x-slot>
      </x-frontend.card>
    </div>
    <!--col-md-10-->
  </div>
  <!--row-->
</div>
  @include('frontend.content.footer')
@endsection