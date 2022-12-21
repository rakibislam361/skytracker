@extends('backend.layouts.app')

@section('title', 'Manage Customer Wallet')

@php
    $options = [
        'purchased' => 'Purchased',
        'shipped-from-suppliers' => 'Shipped from Suppliers',
        'received-in-china-warehouse' => 'Received in China Warehouse',
        'shipped-from-china-warehouse' => 'Shipped from China Warehouse',
        'received-in-BD-warehouse' => 'Received in BD Warehouse',
        'on-transit-to-customer' => 'On Transit to Customer',
        'out-of-stock' => 'Out of Stock',
        'adjustment' => 'Adjustment',
        'refunded' => 'Refunded',
        'delivered' => 'Delivered',
        'Waiting for Payment' => 'Waiting for Payment',
        'Partial Paid' => 'Partial Paid',
    ];
@endphp


@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-2">
                    <h4 class="my-1">@lang('Manage Wallet')</h4>
                </div> <!-- col-->
                <div class="col-md-8">
                    <form id="filterWalletForm">
                        <div class="form-row">
                            <div class="col-md-4">
                                {{ html()->select('customer', $findable, request('customer'))->class('form-control mr-sm-2 select2')->attribute('maxlength', 255) }}
                            </div>
                            <div class="col-md-8">
                                @php
                                    $requ_status = explode(',', request('status'));
                                @endphp
                                {{ html()->multiselect('findStatus[]', $options, $requ_status)->class('form-control mb-2 mr-sm-2 select2')->id('findStatus')->attributes(['data-placeholder' => 'Select a Status']) }}
                            </div>
                        </div>
                    </form> <!-- form-inline -->
                </div> <!-- col-->
                <div class="col-md-2">
                    <div class="btn-group" role="group" aria-label="header_button_group">
                        <button type="submit" class="btn btn-info findResultButton" data-toggle="tooltip"
                            title="@lang('Search')">
                            <i class="fa fa-search"></i>
                        </button>
                        <button type="button" class="btn btn-primary" id="changeGroupStatusButton" data-toggle="tooltip"
                            title="@lang('Change Status')" disabled="true">
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
                    </div> <!-- btn-group-->
                </div> <!-- col-->
            </div> <!-- row-->
        </div>
        <div class="card-body p-0">

            @livewire('wallet-table', ['status' => request('status'), 'customer' => request('customer')])

        </div> <!-- card-body-->
    </div> <!-- card-->


    <div class="modal fade" id="changeStatusButton" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form method="POST" action="{{ route('admin.order.store') }}" id="statusChargeForm">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Change Status <span class="orderId"></span>
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="hiddenField">
                            {{-- hidden input field append here --}}
                        </div>

                        <div class="form-group">
                            @php
                                unset($options['Waiting for Payment'], $options['Partial Paid']);
                            @endphp
                            {{ html()->select('status', $options)->class('form-control')->attribute('maxlength', 255)->required() }}
                        </div> <!--  form-group-->

                        <div class="form-group" id="additionInputStatusForm">

                        </div> <!-- additionInputStatusForm -->

                        <div class="form-group form-check">
                            <input type="checkbox" name="notify" value="1" class="form-check-input" id="notify"
                                checked="true">
                            <label class="form-check-label" for="notify">Notify User</label>
                        </div>

                    </div>
                    <div class="modal-footer justify-content-between">
                        <button onclick="showSelectedRow($rows);" type="submit" class="btn btn-primary"
                            id="statusSubmitBtn">Save changes</button>
                    </div>

                </form>
            </div>
        </div>
    </div> <!-- changeStatusButton -->


    @include('backend.content.order.wallet.includes.generate-modal')


@endsection


@push('before-styles')
    {{ style('assets/plugins/select2/css/select2.min.css') }}
    {{-- {{style('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}} --}}
@endpush

@push('after-styles')
    @livewireStyles
@endpush

@push('middle-scripts')
    {{ script('assets/plugins/select2/js/select2.full.min.js') }}
    @livewireScripts

    {!! script('assets/js/manage-wallet.js') !!}
@endpush
