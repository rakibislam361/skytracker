@include('frontend.style.style')
@include('frontend.content.header')
@extends('frontend.layouts.app')
 @include('frontend.auth.login')

@section('title', __('Register'))

@section('content')


<div class="container">


    <div class="content-justify-center shadow">
        <div class="signupimg">
            <a class="signup" href="{{ route('frontend.auth.register') }}">
                @csrf
                <img src="assets/img/signup/signup_rmvbg.png" alt="img" width="200" height="120" />
            </a>
        </div>
        <x-frontend.card>


            <x-slot name="body">
                <x-forms.post :action="route('frontend.auth.register')">
                    <div class="form-group row">
                        <label for="name" class="col-md-4 text-right">@lang('Name')</label>

                        <div class="col-md-6">
                            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" placeholder="{{ __('Name') }}" maxlength="100" required autofocus autocomplete="name" />
                        </div>
                    </div>
                    <!--form-group-->

                    <div class="form-group">
                        <label for="name" class="col-md-4 text-right">@lang('E-mail Address')</label>

                        <div class="col-md-6">
                            <input type="email" name="email" id="email" class="form-control" placeholder="{{ __('E-mail Address') }}" value="{{ old('email') }}" maxlength="255" required autocomplete="email" />
                        </div>
                    </div>
                    <!--form-group-->

                    <div class="form-group">
                        <label for="name" class="col-md-4 col-form-label text-right">@lang('Password')</label>

                        <div class="col-md-6">
                            <input type="password" name="password" id="password" class="form-control" placeholder="{{ __('Password') }}" maxlength="100" required autocomplete="new-password" />
                        </div>
                    </div>
                    <!--form-group-->

                    <div class="form-group">
                        <label for="name" class="col-md-4 col-form-label text-right">@lang('Password Confirmation')</label>

                        <div class="col-md-6">
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="{{ __('Password Confirmation') }}" maxlength="100" required autocomplete="new-password" />
                        </div>
                    </div>
                    <!--form-group-->

                    <div class="form-group">
                        <div class="col-md-9">
                            <div class="form-check text-right">
                                <input type="checkbox" name="terms" value="1" id="terms" class="form-check-input" required>
                                <label class="form-check-label" for="terms">
                                    @lang('I agree to the') <a href="{{ route('frontend.pages.terms') }}" target="_blank">@lang('Terms & Conditions')</a>
                                </label>
                            </div>
                        </div>
                    </div>
                    <!--form-group-->

                    @if(config('boilerplate.access.captcha.registration'))
                    <div class="form-group">
                        <div class="col-md-4">
                            @captcha
                            <input type="hidden" name="captcha_status" value="true" />
                        </div>
                        <!--col-->
                    </div>
                    <!--row-->
                    @endif

                    <div class="form-group">
                        <div class="col-md-8">
                            <div class="form-group text-right">
                                <button class="btn btn-primary" type="submit">@lang('Register')</button>
                            </div>
                        </div>
                    </div>
                    <!--form-group-->
                </x-forms.post>
            </x-slot>
        </x-frontend.card>
    </div>
    <!--col-md-8-->

</div>
<!--container-->
@include('frontend.content.footer')

@endsection