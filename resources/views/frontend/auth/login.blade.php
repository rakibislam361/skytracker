<div class="modal fade login-popup" id="login-popup" tabindex="-1" role="dialog" aria-hidden="true" name="login">
    <div class="modal-dialog modal-md">
        <a class="close close-btn" data-dismiss="modal" aria-label="Close"> x </a>
        <div class="modal-content">
            <div class="login-wrap text-center">
                <h2 class="title-3"> SIGN IN </h2>
                <p> Sign in to <strong> GO </strong> for getting all details </p>
                <x-frontend.card>
                    <x-slot name="body">
                        <div class="login-form clrbg-before">
                            <x-forms.post :action="route('frontend.auth.login')" id="loginForm">
                                @csrf
                                <div class="form-group"> <input type="email" name="email" id="email" class="form-control" placeholder="{{ __('E-mail Address') }}" value="{{ old('email') }}" maxlength="255" required autofocus autocomplete="email" /></div>                                                                                       
                                <div class="form-group"> <input type="password" name="password" id="password" class="form-control" placeholder="{{ __('Password') }}" maxlength="100" required autocomplete="current-password" /></div>   
                                
                                  {{-- error messeage --}}
                                 @error('email')
                                    <span class="invalid-feedback" role="alert" style="text-align:center">
                                        <strong class="alert-danger">{{ $message }}</strong>
                                    </span>
                                  @enderror
                                {{-- error messeage end --}}

                                <div class="form-group">
                                <div class="form-check">
                                    <input name="remember" id="remember" class="form-check-input" type="checkbox" {{ old('remember') ? 'checked' : '' }} />

                                    <label class="form-check-label" for="remember">
                                        @lang('Remember Me')
                                    </label>
                                </div>
                                </div>
                                

                                @if(config('boilerplate.access.captcha.login'))
                                <div class="col">
                                    @captcha
                                    <input type="hidden" name="captcha_status" value="true" />
                                </div>
                                @endif
                                {{-- if error login modal popup --}}
                                 <?php $log = $errors; ?>
                                 @if ( (Route::current()->getName() != 'login') and count($log) > 0 and !empty('loginForm') )
                                     <script>
                                         $(document).ready(function() {
                                         $('#login-popup').modal('show');                                       
                                         $('#register-popup').modal('hide');
                                         
                                          });

                                     </script>
                                 @endif

                                {{-- if error login modal popup end--}}
                                <div>
                                    <button class="btn-1" type="submit">@lang('Sign In Now')</button>                                   
                                    <x-utils.link :href="route('frontend.auth.password.request')" class="btn btn-link" :text="__('Forgot Your Password?')" />                               
                                </div>
                                <div class="text-center">
                                    @include('frontend.auth.includes.social')
                                </div>
                            </x-forms.post>
                        </div>
                    </x-slot>      
                </x-frontend.card>
            </div>
            <div class="create-accnt">
                <a data-toggle="modal" data-dismiss="modal" href="#register-popup" name="register" class="white-clr"> Don’t have an account? </a>
                <h2 class="title-2">  <a data-toggle="modal" data-dismiss="modal" href="#register-popup" name="register" class="green-clr under-line">Create a free account</a>
                </h2>
            </div>
        </div>
    </div>
</div>
@include('frontend.auth.register')