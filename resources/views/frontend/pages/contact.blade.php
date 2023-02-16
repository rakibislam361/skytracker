@extends('frontend.layouts.app')

@section('title', 'contact')

@section('content')
    <div class="container col-md-6">
        {{-- <div class="row justify-content-center shadow about-wrap clrbg-before"> --}}
        <div class="contact-shadow">
            <a href="{{ route('frontend.pages.contact') }}">
                <h2> Contact Us </h2>
            </a>
        </div>
        {{-- <div class="col-md-6"> --}}
        <x-frontend.card>
            <x-slot name="body">
                <x-forms.post :action="route('frontend.pages.contact')" id="contact" name="contact">
                    <div class="form-group">
                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}"
                            placeholder="{{ __('Name') }}" maxlength="100" required autofocus autocomplete="name" />
                    </div>
                    <!--form-group-->
                    <div class="form-group">
                        <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone') }}"
                            placeholder="{{ __('Phone') }}" maxlength="100" required autofocus autocomplete="phone" />
                    </div>
                    <!--form-group-->

                    <div class="form-group">
                        <input type="email" name="email" id="email" class="form-control"
                            placeholder="{{ __('E-mail Address') }}" value="{{ old('email') }}" maxlength="255" required
                            autocomplete="email" />
                    </div>
                    <!--form-group-->

                    <div class="form-group">
                        <textarea name="message" id="message" class="form-control" placeholder="{{ __('Message') }}" rows="4"
                            cols="100" />
                    </textarea>
                        <!--form-group-->
                    </div>
                    <div class="form-group">

                        <button class="btn btn-primary" type="submit">@lang('Contact')</button>

                    </div>
                    <!--form-group-->
                </x-forms.post>

            </x-slot>
        </x-frontend.card>
        {{-- </div> --}}
        <!--col-md-10-->
        {{-- </div> --}}
        <!--row-->
    </div>
    {{-- @include('frontend.content.footer')
@include('frontend.style.js') --}}

@endsection
