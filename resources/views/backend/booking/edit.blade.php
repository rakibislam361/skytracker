@inject('model', '\App\Domains\Auth\Models\User')

@extends('backend.layouts.app')

@section('title', __('Update Bookings'))

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-10">

            {{ html()->modelForm($booking, 'PATCH', route('admin.booking.update', $booking))->attribute('enctype', 'multipart/form-data')->open() }}
            @csrf
            @php
                $shipping_method = $booking->cartons->shipping_method ?? null;
                $carton_number = $booking->cartons->carton_number ?? null;
                $carton_weight = $booking->cartons->carton_weight ?? null;
            @endphp

            <x-backend.card>
                <x-slot name="header">
                    @lang('Update Bookings')
                </x-slot>

                <x-slot name="headerActions">

                    <x-utils.link class="btn btn-sm btn-secondary" :href="route('admin.booking.create')" :text="__('Add New')" />
                    <div style="padding-left: 2px;">
                        <x-utils.link class="btn btn-sm btn-danger" :href="route('admin.booking.index')" :text="__('Back')" />
                    </div>
                </x-slot>

                <x-slot name="body">

                    <table style="width:100%;padding-bottom: 10px;" id="add-booking">
                        <tr>
                            <td>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="carton_number">Carton Number</label>
                                        <input type="text" name="carton_number" placeholder="carton number"
                                            value="{{ $carton_number }}" class="form-control" />

                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="carton_weight">Cartons Weight</label>
                                        <input type="text" name="carton_weight" placeholder="carton weight"
                                            value="{{ $carton_weight }}" id="weights" class="form-control" />
                                    </div>

                                </div>
                                <div class="row" style="padding-bottom:15px;">

                                    <div class="form-group col-md-12">
                                        <label for="shipping_method">Shipping Method</label>
                                        <select class="form-control" name="shipping_method">
                                            <option value="">Select</option>
                                            <option @if ($shipping_method == 'guangzhou') selected @else null @endif
                                                value="guangzhou">
                                                Guangzhou
                                            </option>
                                            <option @if ($shipping_method == 'hongkong') selected @endif value="hongkong">
                                                Hongkong</option>
                                        </select>
                                    </div>
                                </div>
                                {{-- @foreach ($booking->bookings as $book) --}}
                                <div class="row">

                                    <div class="form-group col-md-6">
                                        <label for="date">Date</label>
                                        <input type="date" name="date[]" class="form-control"
                                            value="{{ $booking->date ?? null }}" placeholder="approx date">
                                    </div>
                                    @if ($logged_in_user->can('admin.status.shipping_mark'))
                                        <div class="form-group col-md-6">
                                            <label for="shipping_mark">Shipping Mark</label>
                                            <input type="text" name="shipping_mark[]" placeholder="shipping mark"
                                                value="{{ $booking->shipping_mark ?? null }}" class="form-control" />
                                        </div>
                                    @endif
                                </div>
                                <div class="row">
                                    @if ($logged_in_user->can('admin.status.product_name'))
                                        <div class="form-group col-md-6">
                                            <label for="othersProductName">Product Name</label>
                                            <input type="text" name="othersProductName[]" placeholder="product name"
                                                value="{{ $booking->othersProductName ?? null }}" class="form-control" />
                                        </div>
                                    @endif
                                    @if ($logged_in_user->can('admin.status.product_qty'))
                                        <div class="form-group col-md-6">
                                            <label for="productQuantity">Product Quantity</label>
                                            <input type="text" name="productQuantity[]" class="form-control"
                                                value="{{ $booking->productQuantity ?? null }}"
                                                placeholder="product quantity">
                                        </div>
                                    @endif
                                </div>

                                <div class="row">
                                    @if ($logged_in_user->can('admin.status.carton_qty'))
                                        <div class="form-group col-md-6">
                                            <label for="ctnQuantity">Carton Quantity</label>
                                            <input type="text" name="ctnQuantity[]" class="form-control"
                                                value="{{ $booking->ctnQuantity ?? null }}" placeholder="quantity">
                                        </div>
                                    @endif
                                    @if ($logged_in_user->can('admin.status.cbm'))
                                        <div class="form-group col-md-6">
                                            <label for="totalCbm">Total Cbm</label>
                                            <input type="text" name="totalCbm[]" class="form-control"
                                                value="{{ $booking->totalCbm ?? null }}" placeholder="total CBM">
                                        </div>
                                    @endif
                                </div>
                                <div class="row">
                                    @if ($logged_in_user->can('admin.status.products_weight'))
                                        <div class="form-group col-md-6">
                                            <label for="actual_weight">Products Weight</label>
                                            <input type="text" name="actual_weight[]" placeholder="products weight"
                                                value="{{ $booking->actual_weight ?? null }}" id="weights"
                                                class="form-control" />
                                        </div>
                                    @endif
                                    @if ($logged_in_user->can('admin.status.tracking_number'))
                                        <div class="form-group col-md-6">
                                            <label for="tracking_number">Tracking Number</label>
                                            <input type="text" name="tracking_number[]" placeholder="tracking number"
                                                value="{{ $booking->tracking_number ?? null }}" class="form-control" />
                                        </div>
                                    @endif
                                </div>
                                <div class="row">
                                    @if ($logged_in_user->can('admin.status.shipping_number'))
                                        <div class="form-group col-md-6">
                                            <label for="shipping_number">Shipping Number</label>
                                            <input type="text" name="shipping_number[]" placeholder="shipping number"
                                                value="{{ $booking->shipping_number ?? null }}" class="form-control" />
                                        </div>
                                    @endif
                                    @if ($logged_in_user->can('admin.status.product_cost'))
                                        <div class="form-group col-md-6">
                                            <label for="productsTotalCost">Products Total Cost</label>
                                            <input type="text" name="productsTotalCost[]" class="form-control"
                                                value="{{ $booking->productsTotalCost ?? null }}"
                                                placeholder="products total Cost(BDT)">
                                        </div>
                                    @endif
                                </div>
                                <div class="row">
                                    @if ($logged_in_user->can('admin.status.unit_price'))
                                        <div class="form-group col-md-6">
                                            <label for="unit_price">Unit Price/kg</label>
                                            <input type="text" name="unit_price[]" class="form-control"
                                                value="{{ $booking->unit_price ?? null }}" placeholder="unit price/kg">
                                        </div>
                                    @endif
                                    @if ($logged_in_user->can('admin.status.remarks'))
                                        <div class="form-group col-md-6">
                                            <label for="remarks">Remarks</label>
                                            <input type="text" name="remarks[]" class="form-control"
                                                value="{{ $booking->remarks ?? null }}" placeholder="remarks">
                                        </div>
                                    @endif
                                </div>

                                <div class="row">
                                    @if ($logged_in_user->can('admin.status.chinalocal'))
                                        <div class="form-group col-md-6">
                                            <label for="chinalocal">China Local Delivery</label>
                                            <input type="text" name="chinalocal[]" class="form-control"
                                                value="{{ $booking->chinalocal ?? null }}"
                                                placeholder="china local delivery">
                                        </div>
                                    @endif
                                    @if ($logged_in_user->can('admin.status.packing'))
                                        <div class="form-group col-md-6">
                                            <label for="packing_cost">Packing Cost</label>
                                            <input type="text" name="packing_cost[]" class="form-control"
                                                value="{{ $booking->packing_cost ?? null }}" placeholder="packing cost">
                                        </div>
                                    @endif
                                </div>
                                <div class="row">
                                    @if ($logged_in_user->can('admin.status.courier'))
                                        <div class="form-group col-md-6">
                                            <label for="courier_bill">Courier Bill</label>
                                            <input type="text" name="courier_bill[]" class="form-control"
                                                value="{{ $booking->courier_bill ?? null }}" placeholder="courier bill">
                                        </div>
                                    @endif
                                    @if ($logged_in_user->can('admin.status.paid'))
                                        <div class="form-group col-md-6">
                                            <label for="paid">Paid</label>
                                            <input type="double" name="paid[]" class="form-control"
                                                value="{{ $booking->paid ?? null }}" placeholder="paid">
                                        </div>
                                    @endif
                                </div>

                                <div class="row">
                                    @if ($logged_in_user->can('admin.status.status'))
                                        <div class="form-group col-md-12">
                                            <label for="status">Products Status</label>
                                            <select class="form-control" name="status[]">
                                                <option value="">Select</option>
                                                <option @if ($booking->status == 'received-in-china-warehouse') selected @endif
                                                    value="received-in-china-warehouse">
                                                    Received in china warehouse
                                                </option>
                                                <option @if ($booking->status == 'shipped-from-china-warehouse') selected @endif
                                                    value="shipped-from-china-warehouse">
                                                    Shipped from china warehouse
                                                </option>
                                                <option @if ($booking->status == 'received-in-BD-warehouse') selected @endif
                                                    value="received-in-BD-warehouse">
                                                    Received in BD warehouse
                                                </option>
                                                <option @if ($booking->status == 'delivered') selected @endif
                                                    value="delivered">
                                                    Delivered
                                                </option>
                                            </select>
                                        </div>
                                    @endif
                                </div>
                                @if ($logged_in_user->can('admin.status.customer'))
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label for="customer_name">Customer Name</label>
                                            <input type="text" name="customer_name[]" class="form-control"
                                                value="{{ $booking->customer_name ?? null }}"
                                                placeholder="customer name">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="customer_phone">Customer Phone</label>
                                            <input type="text" name="customer_phone[]" class="form-control"
                                                value="{{ $booking->customer_phone ?? null }}"
                                                placeholder="customer phone">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="customer_address">Customer Address</label>
                                            <input type="text" name="customer_address[]" class="form-control"
                                                value="{{ $booking->customer_address ?? null }}"
                                                placeholder="customer address">
                                        </div>
                                    </div>
                                @endif
                                <div class="row">
                                    <div class="form-group col-md-6" style="margin-top:35px">
                                        <button class="btn btn-outline-success" id="add-new-book" type="button">+
                                            Add
                                            Product</button>
                                        <button class="btn btn-outline-danger" type="button">-
                                            Remove</button>
                                    </div>

                                </div>
                                {{-- @endforeach --}}
                            </td>
                        </tr>
                    </table>

                </x-slot>
                <x-slot name="footer">
                    <button class="btn btn-sm btn-primary float-right" type="submit">@lang('Update Booking')</button>
                </x-slot>
            </x-backend.card>

            {{ html()->closeModelForm() }}

        </div>
    </div>
@endsection
