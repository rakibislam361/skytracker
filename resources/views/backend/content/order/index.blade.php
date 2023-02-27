@extends('backend.layouts.app')

@section('title', 'Manage Orders')

@section('content')
    @php
        $status = null;
        $allOrdersCount = $orders->where('status', 'partial-paid')->count();
        $partialCount = null;
        $onHold = null;
        $icompleteCount = null;
        $refundedCount = null;
        $processingCount = null;
        $purchasedCount = null;
    @endphp

    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="d-inline-block mr-2">@lang('Order Items')</h5>
                </div>
                <div class="col-md-6">
                    <div class="btn-group float-right" role="group" aria-label="header_button_group">
                        <button type="button" class="btn btn-primary" id="changeGroupStatusButton" data-toggle="tooltip"
                            disabled="true" title="@lang('Change Status')">
                            @lang('Change Status')
                        </button>
                    </div>
                </div>
            </div>
            @include('backend.content.order.includes.filter')
        </div>

        <div class="card-body">
            <div class="badge badge-success" style="font-size: 100%; margin-bottom: 2px;">Total Items
                = {{ $totalcount }}</div>
            @if (
                $logged_in_user->can('admin.status.received-in-chinawarehouse') ||
                    $logged_in_user->can('admin.status.shipped-from-chinawarehouse') ||
                    $logged_in_user->can('admin.status.received-in-bdwarehouse'))
                <div class="badge badge-success" style="font-size: 100%; margin-bottom: 2px;">Total weight
                    = {{ $totalweight }} kg</div>
            @endif
            @include('backend.content.order.includes.order_table')
        </div>
    </div>

    </div>
    <div class="modal fade" id="changeStatusButton" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
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

                    <form method="post" action="{{ route('admin.order.item.status.update') }}">
                        @csrf
                        <div class="modal-body">
                            <div class="hiddenField"></div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select class="form-control" name="status" id="status">
                                    <option value="">Select</option>
                                    @if ($logged_in_user->can('admin.order.status.processing'))
                                        <option value="processing">Processing</option>
                                    @endif
                                    @if ($logged_in_user->can('admin.order.status.on-hold'))
                                        <option value="on-hold">On Hold</option>
                                    @endif
                                    @if ($logged_in_user->can('admin.order.status.purchased'))
                                        <option value="purchased">Purchase Completed</option>
                                    @endif
                                    <option value="pending-to-pay">Pending To Pay</option>
                                    @if ($logged_in_user->can('admin.order.status.re-order'))
                                        <option value="re-order">RE-Order</option>
                                    @endif
                                    @if ($logged_in_user->can('admin.order.status.refund-please'))
                                        <option value="refund-please">Refund Please</option>
                                    @endif
                                    @if ($logged_in_user->can('admin.order.status.shipped-from-suppliers'))
                                        <option value="shipped-from-suppliers">Shipped from suppliers</option>
                                    @endif
                                    @if ($logged_in_user->can('admin.order.status.delivery-after-holiday'))
                                        <option value="delivery-after-holiday">Delivery after holiday</option>
                                    @endif
                                    @if ($logged_in_user->can('admin.order.status.received-in-china-warehouse'))
                                        <option value="received-in-china-warehouse">Received in china warehouse
                                        </option>
                                    @endif
                                    @if ($logged_in_user->can('admin.order.status.shipped-from-china-warehouse'))
                                        <option value="shipped-from-china-warehouse">Shipped from china warehouse
                                        </option>
                                    @endif
                                    @if ($logged_in_user->can('admin.order.status.received-in-BD-warehouse'))
                                        <option value="received-in-BD-warehouse">Received in BD warehouse</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="submit" class="btn btn-primary">Save
                                changes</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>




    <!-- Modal -->
    @include('backend.content.order.includes.edit_modal')
    <input id="actualrmb_rate" class="actualrmb_rate" type="hidden" value="{{ get_setting('actualrmb_rate') }}">
    <input id="local_rate" type="hidden" value="{{ get_setting('local_rate') }}">
@endsection

<x-slot name="header">
    <h4>Order Item List</h4>
</x-slot>
