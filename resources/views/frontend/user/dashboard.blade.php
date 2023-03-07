@extends('frontend.layouts.app')
@section('title', __('Dashboard'))

@section('content')

    @php
        $booking_count = count($booking);
        $total_paid = 0;
        $received = 0;
        $chinalocal = 0;
        $courier = 0;
        $packing = 0;
        $amount = 0;
        foreach ($booking as $book) {
            if ($book->status == 'delivered') {
                $received += 1;
            }
        }
        foreach ($invoice as $inv) {
            $total_paid += $inv->paid ?? 0;
            if ($inv->amount != null) {
                $explode_amount = explode(',', $inv->amount);
                foreach ($explode_amount as $key => $value) {
                    $amount += $value;
                }
            }
            if ($inv->chinalocal != null) {
                $chinalocal += $inv->chinalocal;
            }
            if ($inv->total_courier != null) {
                $courier += $inv->total_courier;
            }
            if ($inv->packing_cost != null) {
                $packing += $inv->packing_cost;
            }
        }
        $total_amount = $amount + $chinalocal + $courier + $packing;
        $due = $total_amount - $total_paid;
    @endphp
    <a href="{{ route('frontend.user.bookings.create') }}">
        <div class="info-box mb-3" style="background-color: #6f42c1">
            <span class="info-box-icon"><i class="fa fa-calendar-plus" style="color: white"></i></span>

            <div class="info-box-content">
                <h1 style="color: white">Make a Booking</h1>
                {{-- <span class="info-box-number">hello</span> --}}
            </div>
            <!-- /.info-box-content -->
        </div>
    </a>
    <div class="conainer-fluid">
        <div class="row">
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h5>Total Bookings</h5>
                        <p>{{ $booking_count ?? '0' }}</p>
                    </div>
                    {{-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h5>Total Paid</h5>

                        <p>{{ $total_paid ?? '0' }} TK</p>
                    </div>
                    {{-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h5>Total Due</h5>

                        <p>{{ $due }} TK</p>
                    </div>
                    {{-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h5>Received</h5>

                        <p>{{ $received ?? '0' }}</p>
                    </div>
                    {{-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
                </div>
            </div>
            <!-- ./col -->
        </div>
    </div>

@endsection
