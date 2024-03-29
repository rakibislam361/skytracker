@extends('frontend.layouts.app')

@section('title', __('Tracking Result'))

@section('content')
    @php
        $stepOne = null;
        $stepTwo = null;
        $stepThree = null;
        $stepFour = null;
        
        $step = null;
        
        if ($bookings) {
            foreach ($bookings->itemTrackStatus as $order) {
                if ($order->step == 1) {
                    $stepOne = $order->step_change_date;
                }
                if ($order->step == 2) {
                    $stepTwo = $order->step_change_date;
                }
                if ($order->step == 3) {
                    $stepThree = $order->step_change_date;
                }
                if ($order->step == 4) {
                    $stepFour = $order->step_change_date;
                }
            }
            $step = $bookings->step;
        }
    @endphp

    {{-- <div class="container py-4"> --}}
    <div class="row justify-content-center">
        <div class="col-md-12">
            <main>
                {{-- @dd($bookings); --}}
                <div class="tracking-area pt-95 pb-115">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-xl-8 col-lg-10">
                                <div class="tracking-id-info text-center">
                                    <p>Your Tracking, Door to Door Office <a
                                            href="{{ route('frontend.pages.tracking') }}">Tracking Number.</a>
                                    </p>

                                    <div class="tracking-list">
                                        <ul>
                                            <li
                                                class="deactive  @if ($step > 1) active @elseif($step == 1) current @endif ">
                                                <div class="tracking-list-icon">
                                                    {{-- <i class="flaticon-box"></i> --}}
                                                    <i class="fa fa-warehouse"></i>
                                                </div>
                                                <div class="tracking-list-content">
                                                    <p>Received in China Warehouse</p>
                                                </div>
                                                @if ($step > 1 || $step == 1)
                                                    <div style="margin-top: 10px;">
                                                        <p>{{ date('d/m/Y', strtotime($stepOne)) }}</p>
                                                    </div>
                                                @endif
                                            </li>
                                            <li
                                                class="deactive  @if ($step > 2) active @elseif($step == 2) current @endif ">
                                                <div class="tracking-list-icon">
                                                    <i class="fa fa-plane"></i>
                                                </div>
                                                <div class="tracking-list-content">
                                                    <p>Shipped From China Warehouse</p>
                                                </div>
                                                @if ($step > 2 || $step == 2)
                                                    <div style="margin-top: 10px;">
                                                        <p>{{ date('d/m/Y', strtotime($stepTwo)) }}</p>
                                                    </div>
                                                @endif
                                            </li>
                                            <li
                                                class="deactive  @if ($step > 3) active @elseif($step == 3) current @endif ">
                                                <div class="tracking-list-icon">
                                                    <i class="fa fa-warehouse"></i>
                                                </div>
                                                <div class="tracking-list-content">
                                                    <p>Received in BD Warehouse</p>
                                                </div>
                                                @if ($step > 3 || $step == 3)
                                                    <div style="margin-top: 10px;">
                                                        <p>{{ date('d/m/Y', strtotime($stepThree)) }}</p>
                                                    </div>
                                                @endif
                                            </li>
                                            <li class="deactive  @if ($step == 4) current @endif ">
                                                <div class="tracking-list-icon">
                                                    <i class="fa fa-box"></i>
                                                </div>
                                                <div class="tracking-list-content">
                                                    <p>Delivered</p>
                                                </div>
                                                @if ($step == 4)
                                                    <div style="margin-top: 10px;">
                                                        <p>{{ date('d/m/Y', strtotime($stepFour)) }}</p>
                                                    </div>
                                                @endif
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </main>

        </div>
    </div>
@endsection
