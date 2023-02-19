@extends('frontend.layouts.app')

@section('title', 'contact')

@section('content')

    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    <h5><strong>Office Information</strong></h5>
                </div>
                <div class="card-body">

                    <h5>Head Office</h5>
                    <p>{{ get_setting('office_address') }}</p>
                    <h5>Email</h5>
                    <p>{{ get_setting('office_email') }}</p>
                    <h5>Phone</h5>
                    <p>{{ get_setting('office_phone') }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">

            <x-frontend.card>
                <x-slot name="header">
                    <h5>Write your message</h5>
                </x-slot>
                <x-slot name="body">
                    <x-forms.post :action="route('frontend.pages.contact')" id="contact" name="contact">



                        <div class="form-group">
                            <textarea name="message" id="message" class="form-control" placeholder="{{ __('Message') }}" rows="6"
                                cols="100" /></textarea>
                        </div>


                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">@lang('Message')</button>
                        </div>

                    </x-forms.post>

                </x-slot>
            </x-frontend.card>
        </div>

        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    <h5>Social Links</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h1><a href="{{ get_setting('facebook') }}"><i class="fab fa-facebook-f"></i></a></h1>
                        </div>
                        <div class="col-md-6">
                            <h1><a href="{{ get_setting('twitter') }}"><i class="fab fa-twitter"></i></a></h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
