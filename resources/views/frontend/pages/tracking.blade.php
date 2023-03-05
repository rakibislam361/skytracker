@extends('frontend.layouts.app')

@section('title', __('Tracking'))

@section('content')
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>

    <div class="col-md-12">
        <main>
            {{-- @dd($bookings); --}}
            <div class="tracking-area pt-95 pb-115">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-xl-8 col-lg-10">
                            <div class="tracking-id-info text-center">
                                <p>Enter Your Tracking, Door to Door Office <a href="#">Tracking Number.</a>
                                </p>
                                <form method="post" action="{{ route('frontend.track-order-post') }}"
                                    class="tracking-id-form">
                                    @csrf
                                    <input type="text" placeholder="Tracking id" name="tracking_id">
                                    <button type="submit" class="btn red-btn">Tracking</button>
                                </form>

                                <div class="tracking-help">
                                    <p>MULTIPLE TRACKING NUMBERS | <a href="#">NEED HELP?</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </main>

    </div>

    @if (session()->has('message'))
        <script>
            Swal.fire({
                icon: "warning",
                text: "Sorry!! Cannot Find any Product",
            })
        </script>
    @endif
@endsection
