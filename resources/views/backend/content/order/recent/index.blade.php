@extends('backend.layouts.app')

@section('title', 'Recent Orders')

@section('content')

    <div class="card">
        <div class="card-header">
            <h5 class="d-inline-block mr-2">@lang('Recent Orders')</h5>
            @include('backend.content.order.recent.includes.recent_filter')
        </div>
        <div class="card-body">
            <div class="badge badge-success" style="font-size: 100%; margin-bottom: 5px;">Total Orders
                = {{ $totalcount }}</div>
            @include('backend.content.order.recent.includes.recent_order_table')
        </div> <!-- card-body-->
    </div>

    <!-- Modal -->
    @include('backend.content.order.recent.includes.status-modal')

    <input id="actualrmb_rate" type="hidden" value="{{ get_setting('actualrmb_rate') }}">
    <input id="local_rate" type="hidden" value="{{ get_setting('local_rate') }}">
@endsection

<x-slot name="header">
    <h4>Order List</h4>
</x-slot>
