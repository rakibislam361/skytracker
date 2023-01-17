@extends('backend.layouts.app')

@section('title', 'Recent Orders')

@section('content')
    @php
        
        $allOrdersCount = $orders ? $orders->where('status', 'Partial Paid')->count() : null;
        $status = null;
        $partialCount = null;
        $onHold = null;
        $icompleteCount = null;
        $refundedCount = null;
        $processingCount = null;
        $purchasedCount = null;
    @endphp

    <div class="card">
        <div class="card-header">
            <h5 class="d-inline-block mr-2">@lang('Recent Orders')</h5>
            @include('backend.content.order.recent.includes.recent_filter')
        </div>
        <div class="card-body">
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
