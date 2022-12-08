@extends('backend.layouts.app')

@section('title', 'Recent Orders')

@section('content')
    @php
        $status = null;
        $allOrdersCount = $orders->where('status', 'Partial Paid')->count();
        $partialCount = null;
        $onHold = null;
        $icompleteCount = null;
        $refundedCount = null;
        $processingCount = null;
        $purchasedCount = null;
    @endphp

    <div class="card">
        <div class="card-header">
            <h5 class="d-inline-block mr-2">@lang('Orders')</h5>
            @include('backend.content.order.includes.filter')
            {{-- 
            <div class="status-control mt-5">
                <a href="{{ route('admin.order.index') }}" class="@if (!$status) active @endif">
                    @lang('All Orders') ({{ $allOrdersCount }})
                </a>
                <a href="{{ route('admin.order.index', ['status' => 'bd-order']) }}"
                    class="@if ($status == 'Partial Paid') active @endif">
                    @lang('BD Order') ({{ $partialCount }})
                </a>
                <a href="{{ route('admin.order.index', ['status' => 'china-purchase']) }}"
                    class="@if ($status == 'on-hold') active @endif">
                    @lang('China Purchase') ({{ $onHold }})
                </a>
                <a href="{{ route('admin.order.index', ['status' => 'china-warehouse']) }}"
                    class="@if ($status == 'Waiting for Payment') active @endif">
                    @lang('China Warehouse') ({{ $icompleteCount }})
                </a>
                <a href="{{ route('admin.order.index', ['status' => 'bd-warehouse']) }}"
                    class="@if ($status == 'refunded') active @endif">
                    @lang('BD Warehouse') ({{ $refundedCount }})
                </a>
                @hasrole('administrator')
                    <a href="{{ route('admin.order.index', ['status' => 'trashed']) }}"
                        class="@if ($status == 'trashed') active @endif">
                        @lang('Trashed Orders') ({{ $trashedOrders }})
                    </a>
                @endhasrole
            </div> --}}

        </div>
        <div class="card-body">
            @include('backend.content.order.includes.order_table')
        </div> <!-- card-body-->
    </div>

    <!-- Modal -->
    @include('backend.content.order.includes.edit_modal')
    <input id="actualrmb_rate" type="hidden" value="{{ get_setting('actualrmb_rate') }}">
    <input id="local_rate" type="hidden" value="{{ get_setting('local_rate') }}">
@endsection

<x-slot name="header">
    <h4>Order List</h4>
</x-slot>
