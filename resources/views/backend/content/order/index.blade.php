@extends('backend.layouts.app')

@section('title', 'Manage Orders')

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

// dd($allOrdersCount);
// $count = null;
// foreach ($orders as $key => $status) {
// $count += count($status->status);
// }
// dd($totalcount);

@endphp


<div class="card">
    <div class="card-header">
        <h5 class="d-inline-block mr-2">@lang('Order Items')</h5>


        {{-- <div class="btn-group float-right" role="group" aria-label="header_button_group">
                <button type="submit" class="btn btn-info findResultButton" data-toggle="tooltip" title="@lang('Search')">
                    <i class="fa fa-search"></i>
                </button>
                <button type="button" class="btn btn-primary" id="changeGroupStatusButton" data-toggle="tooltip"
                    title="@lang('Change Status')">
                    @lang('Status')
                </button>
                <button type="button" class="btn btn-danger" id="generateInvoiceButton" data-toggle="tooltip"
                    title="Generate Invoice" disabled="true">
                    @lang('Generate')
                </button>
                <a href="{{ route('admin.export', 'order_item') }}" class="btn btn-warning" data-toggle="tooltip"
        title="Full Export">
        <i class="fa fa-download"></i>
        </a>
    </div> --}}
    <!-- btn-group-->

    @include('backend.content.order.includes.filter')


</div>
<div class="card-body">
    {{-- <div class="modal fade" id="changeStatusButton" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="statusChangeFormModalLabel">Change status</h5><span
                                    class="orderId"></span>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <form method="post" id="updateItem">
                                @csrf

                                <div class="modal-body">


                                    <div class="hiddenField">

                                    </div>

                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select class="form-control" name="status" id="status">
                                            <option value="">Select</option>
                                            @if ($logged_in_user->can('admin.order.order_rmb.edit'))
                                                <option value="processing">Processing</option>
                                            @endif
                                            @if ($logged_in_user->can('admin.order.purchase.edit'))
                                                <option value="on-hold">On Hold</option>
                                                <option value="purchased">Purchase Completed</option>
                                                <option value="re-order">RE-Order</option>
                                                <option value="refund-please">Refund Please</option>
                                                <option value="shipped-from-suppliers">Shipped from suppliers</option>
                                            @endif
                                            @if ($logged_in_user->can('admin.order.status.edit'))
                                                <option value="received-in-china-warehouse">Received in china warehouse
                                                </option>
                                                <option value="shipped-from-china-warehouse">Shipped from china warehouse
                                                </option>
                                            @endif
                                            @if ($logged_in_user->can('admin.order.rate.edit'))
                                                <option value="received-in-BD-warehouse">Received in BD warehouse</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-primary" id="statusSubmitBtn">Save
                                        changes</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div> --}}
    @include('backend.content.order.includes.order_table')
</div> <!-- card-body-->
</div>

<!-- Modal -->
@include('backend.content.order.includes.edit_modal')
<input id="actualrmb_rate" class="actualrmb_rate" type="hidden" value="{{ get_setting('actualrmb_rate') }}">
<input id="local_rate" type="hidden" value="{{ get_setting('local_rate') }}">
@endsection

<x-slot name="header">
    <h4>Order List</h4>
</x-slot>