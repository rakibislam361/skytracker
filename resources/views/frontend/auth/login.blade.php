@extends('frontend.layouts.app')

@section('title', __('Login'))

@section('content')
    <div class="pt-95 pb-115">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="tracking-id-info text-center">

                        <div class="tracking-list">
                            <div style="background-color: #fff; padding: 15px;">
                                <div class="cta-from">
                                    <h5>LOGIN</h5>
                                    <p>Login to go for getting all details</p>

                                    <div class="loginWithOtp">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <input type="text" id="user-phone" name="phone" class="form-control"
                                                    placeholder="Phone Number" aria-label="Recipient's username"
                                                    aria-describedby="phone-number" maxlength="25" required="true"
                                                    autofocus="true">
                                            </div>
                                        </div> <!-- form-group -->

                                        <div class="form-group" style="margin-top: 10px;">
                                            <div class="input-group oldOTP">
                                            </div>
                                        </div>

                                        {{ html()->hidden('remember')->value(1) }}

                                        <div class="form-group" style="margin: 10px">
                                            <button type="submit" id="otpSubmitBtn" class="btn btn-primary"
                                                name="login">Send OTP</button>
                                        </div>
                                    </div>

                                    <div class="loginWithEmail d-none">
                                        <x-forms.post :action="route('frontend.auth.login')" id="loginForm">
                                            @csrf
                                            <div class="cta-form-col d-flex justify-content-between"> <input type="text"
                                                    name="email" id="email" class="cta-email"
                                                    placeholder="{{ __('E-mail Address') }}" value="{{ old('email') }}"
                                                    maxlength="255" required autofocus autocomplete="email" /></div>
                                            <div class="cta-form-col d-flex justify-content-between"> <input type="password"
                                                    name="password" id="password" class="cta-email"
                                                    placeholder="{{ __('Password') }}" maxlength="100" required
                                                    autocomplete="current-password" /></div>


                                            @error('email')
                                                <span class="invalid-feedback" role="alert" style="text-align:center">
                                                    <strong class="alert-danger">{{ $message }}</strong>
                                                </span>
                                            @enderror

                                            <div class="form-group" style="padding-bottom: 10px;">
                                                <div class="form-check">
                                                    <input name="remember" id="remember" class="form-check-input"
                                                        type="checkbox" {{ old('remember') ? 'checked' : '' }} />

                                                    <label class="form-check-label" for="remember">
                                                        @lang('Remember Me')
                                                    </label>
                                                </div>
                                            </div>


                                            @if (config('boilerplate.access.captcha.login'))
                                                <div class="col">
                                                    @captcha
                                                    <input type="hidden" name="captcha_status" value="true" />
                                                </div>
                                            @endif

                                            <div>
                                                <button class="btn" type="submit">@lang('LOGIN')</button>

                                            </div>
                                            <div style="padding-top: 10px;">
                                                <x-utils.link :href="route('frontend.auth.password.request')" class="btn-1" :text="__('Forgot Your Password?')" />
                                            </div>
                                            <div class="text-center">
                                                @include('frontend.auth.includes.social')
                                            </div>
                                        </x-forms.post>
                                    </div>

                                </div>
                                <div class="login_wrap otpSubmitCard d-none">
                                    <div class="padding_eight_all bg-white">
                                        <div class="heading_s1" style="margin-top: 50px;">
                                            <h5>
                                                <button type="button" id="backToLoginCard" class="btn mr-2 p-1">
                                                    <i class="icon-arrow-left"></i> Back
                                                </button>
                                                Verify Your Phone Number
                                            </h5>
                                        </div>

                                        <div class="otp_submit_form">
                                            <h6 class="text-center"> We just sent you an SMS with an OTP code. </h6>
                                            <p class="text-center"> To complete your phone number login, please enter the
                                                4-digit OTP code below.
                                            </p>
                                            <div class="form-group">
                                                <input type="hidden" name="userId" class="userId">
                                                <input type="hidden" name="userPhone" class="userPhone">
                                                <input type="text" name="otp_code"
                                                    class="form-control text-center otp_code" placeholder="----"
                                                    maxlength="4" required="true" autofocus="true">
                                                <small id="phone" class="form-text text-muted text-center">e.g:
                                                    1234</small>
                                            </div> <!-- form-group -->
                                            <div class="form-group">
                                                <button type="submit" id="otpCodeSubmitBtn"
                                                    class="btn btn-fill-out btn-block">Resend Code
                                                    30</button>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="mt-4">

                                    <span id="loginOption">
                                        <div>
                                            <a href="#" id="withEmailLogin" class="">Email Users ?
                                                Click Here</a>
                                        </div>
                                        <div>
                                            <a href="#" id="withOtpLogin" class="d-none">Login With OTP</a>
                                        </div>
                                        <div>
                                            <a href="#" id="hasOTP" class="">Already has an OTP ? Click
                                                Here</a>
                                        </div>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="tracking-help">
                            <p>New to Sky Track? | <a href="{{ route('frontend.auth.register') }}">Create
                                    Account With Email</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
