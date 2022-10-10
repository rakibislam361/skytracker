<div class="modal fade register-popup" id="register-popup" tabindex="-1" role="dialog" aria-hidden="true" name="register">
    <div class="modal-dialog modal-md">
        <a class="close close-btn" data-dismiss="modal" aria-label="Close"> x </a>
        <div class="modal-content">
            <div class="login-wrap text-center">
                <h2 class="title-3"> REGISTER </h2>
                <p> Register <strong> GO </strong> for getting all details </p>
                <x-frontend.card>
                    <x-slot name="body">
                        <div class="register-form clrbg-before">
                            <x-forms.post :action="route('frontend.auth.register')"  id="registerForm">
                                @csrf
                                <div class="form-group"> <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" placeholder="{{ __('Name') }}" maxlength="100" required autofocus autocomplete="name" /></div>
                                <div class="form-group"><input type="email" name="email" id="email" class="form-control" placeholder="{{ __('E-mail Address') }}" value="{{ old('email') }}" maxlength="255" required autocomplete="email" /></div>                                                                                       
                                <div class="form-group"><input type="password" name="password" id="password" class="form-control" placeholder="{{ __('Password') }}" maxlength="100" required autocomplete="new-password" /></div>    
                                <div class="form-group"><input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="{{ __('Password Confirmation') }}" maxlength="100" required autocomplete="new-password" /></div>                          
                                
                                <div class="form-group">
                                    <div class="form-check">
                                        <input type="checkbox" name="terms" value="1" id="terms" class="form-check-input" required>
                                        <label class="form-check-label" for="terms">
                                        @lang('I agree to the') <a href="{{ route('frontend.pages.terms') }}" target="_blank">@lang('Terms & Conditions')</a>
                                        </label>
                                    </div>
                                </div>
                           
                   
                                  {{-- error messeage --}}
                                  @error('email')
                                    <span class="invalid-feedback" role="alert" style="text-align:center">
                                        <strong class="alert-danger">{{ $message }}</strong>
                                    </span>
                                  @enderror

                                 @error('password')
                                    <span class="invalid-feedback" role="alert" style="text-align:center">
                                        <strong class="alert-danger">{{ $message }}</strong>
                                    </span>
                                  @enderror
                                {{-- error messeage end --}}

                               @if(config('boilerplate.access.captcha.registration'))
                                  <div class="form-group">
                                     <div class="col-md-4">
                                      @captcha
                                         <input type="hidden" name="captcha_status" value="true" />
                                     </div>                                        
                                 </div>                   
                                  @endif

                                {{-- if error login modal popup --}}
                                <?php $reg = $errors; ?>
                                    @if ( (Route::current()->getName() != 'register') and (count($reg) > 0 and !empty('registerForm')))
                                        <script>
                                            $(document).ready(function() {
                                                $('#register-popup').modal('show');
                                                $('#login-popup').modal('hide');
                                                                                               
                                               });
                                         </script>
                                    @endif

                            {{-- if error login modal popup end --}}

                                <div>
                                    <button class="btn-1" type="submit">@lang('Sign Up')</button>                                   
                                </div>
                                
                            </x-forms.post>
                        </div>
                    </x-slot>      
                </x-frontend.card>
            </div>
            <div class="create-accnt">
                <a data-toggle="modal" data-dismiss="modal" href="#login-popup" name="login" class="white-clr" >Already Have An Account? </a>
                <h2 class="title-2">  <a data-toggle="modal" data-dismiss="modal" href="#login-popup" name="login" class="green-clr under-line">Sign In From Existing Account</a>
                </h2>
            </div>
        </div>
        
    </div>
</div>

