@inject('model', '\App\Domains\Auth\Models\User')

@extends('backend.layouts.app')

@section('title', __('Update Bookings'))

@section('content')


    {{-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script> --}}

    <div class="row justify-content-center">
        <div class="col-md-10">

            {{ html()->modelForm($booking, 'PATCH', route('admin.booking.update', $booking))->attribute('enctype', 'multipart/form-data')->open() }}
            @csrf
            @php
                $cartons = $booking->cartons;
                $carton_number = [];
                $shipping_mark = [];
                $shipping_number = [];
                $actual_weight = [];
                $tracking_id = [];
                $warehouse_qty = null;
                $shipping_method = null;
                $chinalocal = 0;
                $packing_cost = 0;
                
                $product_name = explode(',', $booking->othersProductName);
                foreach ($cartons as $key => $value) {
                    $carton_number = explode(',', $value->carton_number);
                    $shipping_mark = explode(',', $value->shipping_mark);
                    $shipping_number = explode(',', $value->shipping_number);
                    $actual_weight = explode(',', $value->actual_weight);
                    $warehouse_qty = $value->warehouse_quantity;
                    $shipping_method = $value->shipping_method;
                    $chinalocal = $value->chinalocal;
                    $packing_cost = $value->packing_cost;
                    $tracking_id = explode(',', $value->tracking_id);
                }
                
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
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="date">Date</label>
                            <input type="date" name="date" class="form-control" value={{ $booking->date }}
                                placeholder="approx date">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="shipping_mark">Shipping Mark</label>
                            @foreach ($shipping_mark as $mark)
                                <table style="width:100%" id="shipping-mark">
                                    <tr>
                                        <td><input type="text" name="shipping_mark[]" placeholder="shipping mark"
                                                class="form-control" value="{{ $mark }}" /></td>
                                        <td class="text-right" style="width:1%"> <button type="button"
                                                id="add-shipping-mark-btn" class="btn btn-outline-success">+</button></td>
                                        <td class="text-right" style="width:1%"> <button type="button"
                                                class="btn btn-outline-danger remove-tr">-</button></td>
                                    </tr>
                                </table>
                            @endforeach
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="shipping_method">Shipping Method</label>
                            <select class="form-control" name="shipping_method">
                                <option value="">Select</option>
                                <option @if ($shipping_method == 'guangzhou') selected @endif value="guangzhou">Guangzhou
                                </option>
                                <option @if ($shipping_method == 'hongkong') selected @endif value="hongkong">Hongkong</option>
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="othersProductName">Product Name</label>
                            @foreach ($product_name as $name)
                                <table style="width:100%" id="product-name">
                                    <tr>
                                        <td><input type="text" name="othersProductName[]" placeholder="product name"
                                                class="form-control" value="{{ $name }}" /></td>
                                        <td class="text-right" style="width:1%"> <button type="button"
                                                id="add-productName-btn" class="btn btn-outline-success">+</button>
                                        </td>
                                        <td class="text-right" style="width:1%"> <button type="button"
                                                class="btn btn-outline-danger remove-tr">-</button></td>
                                    </tr>
                                </table>
                            @endforeach
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="productQuantity">Product Quantity</label>
                            <input type="text" name="productQuantity" class="form-control" placeholder="product quantity"
                                value="{{ $booking->productQuantity }}">
                        </div> <!-- form-group -->

                        <div class="form-group col-md-6">
                            <label for="carton_number">Carton Number</label>
                            @foreach ($carton_number as $cart)
                                <table style="width:100%" id="carton-number">
                                    <tr>
                                        <td><input type="text" name="carton_number[]" placeholder="carton number"
                                                class="form-control" value="{{ $cart }}" /></td>
                                        <td class="text-right" style="width:1%"> <button type="button" id="add-carton-btn"
                                                class="btn btn-outline-success">+</button>
                                        </td>
                                        <td class="text-right" style="width:1%"> <button type="button"
                                                class="btn btn-outline-danger remove-tr">-</button></td>
                                    </tr>
                                </table>
                            @endforeach
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="ctnQuantity">Carton Quantity</label>
                            <input type="text" name="ctnQuantity" class="form-control" placeholder="carton quantity"
                                value="{{ $booking->ctnQuantity }}">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="totalCbm">Total Cbm</label>
                            <input type="text" name="totalCbm" class="form-control" placeholder="total CBM"
                                value="{{ $booking->totalCbm }}">
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="actual_weight">Carton Weights</label>
                            @foreach ($actual_weight as $weight)
                                <table style="width:100%" id="booking-weight">
                                    <tr>
                                        <td><input type="text" name="actual_weight[]" placeholder="carton weight"
                                                class="form-control" value="{{ $weight }}" /></td>
                                        <td class="text-right" style="width:1%"> <button type="button"
                                                id="add-weight-btn" class="btn btn-outline-success">+</button>
                                        </td>
                                        <td class="text-right" style="width:1%"> <button type="button"
                                                class="btn btn-outline-danger remove-tr">-</button></td>
                                    </tr>
                                </table>
                            @endforeach
                            {{-- <input type="text" name="actual_weight" class="form-control" placeholder="actual weight"
                                value="{{ $actual_weight }}"> --}}
                        </div>


                        <div class="form-group col-md-6">
                            <label for="warehouse_quantity">Total Carton Weight</label>
                            <input type="text" name="warehouse_quantity" class="form-control"
                                placeholder="warehouse_quantity" value="{{ $warehouse_qty }}">
                        </div>


                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="tracking_id">Tracking Number</label>
                            @foreach ($tracking_id as $track)
                                <table style="width:100%" id="tracking-id">
                                    <tr>
                                        <td><input type="text" name="tracking_id[]" placeholder="tracking number"
                                                class="form-control" value="{{ $track }}" /></td>
                                        <td class="text-right" style="width:1%"> <button type="button"
                                                id="add-tracking-id-btn" class="btn btn-outline-success">+</button>
                                        </td>
                                        <td class="text-right" style="width:1%"> <button type="button"
                                                class="btn btn-outline-danger remove-tr">-</button></td>
                                    </tr>
                                </table>
                            @endforeach
                        </div>
                        <div class="form-group col-md-6">
                            <label for="chinalocal">China Local Delivery</label>
                            <input type="text" name="chinalocal" class="form-control"
                                placeholder="china local delivery" value="{{ $chinalocal }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="packing_cost">Packing Cost</label>
                            <input type="text" name="packing_cost" class="form-control" placeholder="packing cost"
                                value="{{ $packing_cost }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="shipping_number">Shipping Number</label>
                            @foreach ($shipping_number as $mark)
                                <table style="width:100%" id="shipping-number">
                                    <tr>
                                        <td><input type="text" name="shipping_number[]" placeholder="shipping number"
                                                class="form-control" value="{{ $mark }}" /></td>
                                        <td class="text-right" style="width:1%"> <button type="button"
                                                id="add-shipping-number-btn" class="btn btn-outline-success">+</button>
                                        </td>
                                        <td class="text-right" style="width:1%"> <button type="button"
                                                class="btn btn-outline-danger remove-tr">-</button></td>
                                    </tr>
                                </table>
                            @endforeach
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="productsTotalCost">Products Total Cost</label>
                            <input type="text" name="productsTotalCost" class="form-control"
                                placeholder="total Cost(BDT)" value="{{ $booking->productsTotalCost }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="unit_price">Unit Price/kg</label>
                            <input type="text" name="unit_price" class="form-control" placeholder="unit price/kg"
                                value="{{ $booking->unit_price }}">
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="remarks">Remarks</label>
                            <input type="text" name="remarks" class="form-control" placeholder="remarks"
                                value="{{ $booking->remarks }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="amount">Amount</label>
                            <input type="double" name="amount" class="form-control" placeholder="amount"
                                value="{{ $booking->amount }}">
                        </div>

                    </div>
                    <div class="row">

                        <div class="form-group col-md-6">
                            <label for="paid">Paid</label>
                            <input type="double" name="paid" class="form-control" placeholder="paid"
                                value="{{ $booking->paid }}">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="status">Status</label>
                            <select class="form-control" name="status">
                                <option value="">Select</option>
                                <option @if ($booking->status == 'booking-pending') selected @endif value="booking-pending">
                                    Booking Pending</option>
                                <option @if ($booking->status == 'received-in-china-warehouse') selected @endif
                                    value="received-in-china-warehouse">
                                    Received in china
                                    warehouse</option>
                                <option @if ($booking->status == 'shipped-from-china-warehouse') selected @endif
                                    value="shipped-from-china-warehouse">
                                    Shipped from china
                                    warehouse</option>
                                <option @if ($booking->status == 'received-in-BD-warehouse') selected @endif value="received-in-BD-warehouse">
                                    Received
                                    in BD warehouse
                                </option>
                                <option @if ($booking->status == 'delivered') selected @endif value="delivered">
                                    Delivered
                                </option>
                            </select>
                        </div>

                    </div>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label for="customer_name">Customer Name</label>
                            <input type="text" name="customer_name" class="form-control"
                                value="{{ $booking->customer_name }}" placeholder="customer name">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="customer_phone">Customer Phone</label>
                            <input type="text" name="customer_phone" class="form-control"
                                value="{{ $booking->customer_phone }}" placeholder="customer phone">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="customer_address">Customer Address</label>
                            <input type="text" name="customer_address" class="form-control"
                                value="{{ $booking->customer_address }}" placeholder="customer address">
                        </div>

                    </div>

        </div>

        </x-slot>
        <x-slot name="footer">
            <button class="btn btn-sm btn-primary float-right" type="submit">@lang('Update Booking')</button>
        </x-slot>
        </x-backend.card>

        {{ html()->closeModelForm() }}

    </div>
    </div>


@endsection
