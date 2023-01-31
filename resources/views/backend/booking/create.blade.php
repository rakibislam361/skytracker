@inject('model', '\App\Domains\Auth\Models\User')

@extends('backend.layouts.app')

@section('title', __('Create Booking'))

@section('content')

    {{-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script> --}}

    <div class="row justify-content-center">
        <div class="col-md-10">
            <form action="{{ route('admin.booking.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <x-backend.card>
                    <x-slot name="header">
                        @lang('Create Booking')
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
                                <input type="date" name="date" class="form-control" placeholder="approx date">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="shipping_mark">Shipping Mark</label>
                                <table style="width:100%" id="shipping-mark">
                                    <tr>
                                        <td><input type="text" name="shipping_mark[]" placeholder="shipping mark"
                                                class="form-control" /></td>
                                        <td class="text-right" style="width:1%"> <button type="button"
                                                id="add-shipping-mark-btn" class="btn btn-outline-success">+</button></td>
                                        <td class="text-right" style="width:1%"> <button type="button"
                                                class="btn btn-outline-danger">-</button></td>
                                    </tr>
                                </table>
                            </div>

                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="shipping_method">Shipping Method</label>
                                <select class="form-control" name="shipping_method">
                                    <option value="">Select</option>
                                    <option value="guangzhou">Guangzhou</option>
                                    <option value="hongkong">Hongkong</option>
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="othersProductName">Product Name</label>
                                <table style="width:100%" id="product-name">
                                    <tr>
                                        <td><input type="text" name="othersProductName[]" placeholder="product name"
                                                class="form-control" /></td>
                                        <td class="text-right" style="width:1%"> <button type="button"
                                                id="add-productName-btn" class="btn btn-outline-success">+</button></td>
                                        <td class="text-right" style="width:1%"> <button type="button"
                                                class="btn btn-outline-danger">-</button></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="row">

                            <div class="form-group col-md-6">
                                <label for="productQuantity">Product Quantity</label>
                                <input type="text" name="productQuantity" class="form-control"
                                    placeholder="product quantity">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="carton_number">Carton Number</label>
                                <table style="width:100%" id="carton-number">
                                    <tr>
                                        <td><input type="text" name="carton_number[]" placeholder="carton number"
                                                class="form-control" /></td>
                                        <td class="text-right" style="width:1%"> <button type="button" id="add-carton-btn"
                                                class="btn btn-outline-success">+</button></td>
                                        <td class="text-right" style="width:1%"> <button type="button"
                                                class="btn btn-outline-danger">-</button></td>
                                    </tr>
                                </table>
                            </div>

                        </div>
                        <div class="row">

                            <div class="form-group col-md-6">
                                <label for="ctnQuantity">Carton Quantity</label>
                                <input type="text" name="ctnQuantity" class="form-control" placeholder="quantity">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="totalCbm">Total Cbm</label>
                                <input type="text" name="totalCbm" class="form-control" placeholder="total CBM">
                            </div>


                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="actual_weight">Carton Weights</label>
                                <table style="width:100%" id="booking-weight">
                                    <tr>
                                        <td><input type="text" name="actual_weight[]" placeholder="carton weight"
                                                id="weights" class="form-control" /></td>
                                        <td class="text-right" style="width:1%"> <button type="button"
                                                id="add-weight-btn" class="btn btn-outline-success">+</button></td>
                                        <td class="text-right" style="width:1%"> <button type="button"
                                                class="btn btn-outline-danger">-</button></td>
                                    </tr>
                                </table>
                                {{-- <input type="text" name="actual_weight" class="form-control"
                                    placeholder="actual weight"> --}}
                            </div>

                            <div class="form-group col-md-6">
                                <label for="warehouse_quantity">Total Carton Weight</label>
                                <input type="text" name="warehouse_quantity" class="form-control" id="totalWeight"
                                    placeholder="warehouse_quantity">
                            </div>

                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="tracking_id">Tracking Number</label>
                                <table style="width:100%" id="tracking-id">
                                    <tr>
                                        <td><input type="text" name="tracking_id[]" placeholder="tracking number"
                                                class="form-control" /></td>
                                        <td class="text-right" style="width:1%"> <button type="button"
                                                id="add-tracking-id-btn" class="btn btn-outline-success">+</button>
                                        </td>
                                        <td class="text-right" style="width:1%"> <button type="button"
                                                class="btn btn-outline-danger">-</button></td>
                                    </tr>
                                </table>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="chinalocal">China Local Delivery</label>
                                <input type="text" name="chinalocal" class="form-control"
                                    placeholder="china local delivery">
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="packing_cost">Packing Cost</label>
                                <input type="text" name="packing_cost" class="form-control"
                                    placeholder="packing cost">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="shipping_number">Shipping Number</label>
                                <table style="width:100%" id="shipping-number">
                                    <tr>
                                        <td><input type="text" name="shipping_number[]" placeholder="shipping number"
                                                class="form-control" /></td>
                                        <td class="text-right" style="width:1%"> <button type="button"
                                                id="add-shipping-number-btn" class="btn btn-outline-success">+</button>
                                        </td>
                                        <td class="text-right" style="width:1%"> <button type="button"
                                                class="btn btn-outline-danger">-</button></td>
                                    </tr>
                                </table>
                            </div>
                        </div>


                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="productsTotalCost">Products Total Cost</label>
                                <input type="text" name="productsTotalCost" class="form-control"
                                    placeholder="products total Cost(BDT)">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="unit_price">Unit Price/kg</label>
                                <input type="text" name="unit_price" class="form-control"
                                    placeholder="unit price/kg">
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="remarks">Remarks</label>
                                <input type="text" name="remarks" class="form-control" placeholder="remarks">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="amount">Amount</label>
                                <input type="double" name="amount" class="form-control" placeholder="amount">
                            </div>

                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="paid">Paid</label>
                                <input type="double" name="paid" class="form-control" placeholder="paid">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="status">Status</label>
                                <select class="form-control" name="status">
                                    <option value="">Select</option>
                                    <option value="received-in-china-warehouse">Received in china warehouse
                                    </option>
                                    <option value="shipped-from-china-warehouse">Shipped from china warehouse
                                    </option>
                                    <option value="received-in-BD-warehouse">Received in BD warehouse</option>
                                    <option value="delivered">Delivered</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="customer_name">Customer Name</label>
                                <input type="text" name="customer_name" class="form-control"
                                    placeholder="customer name">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="customer_phone">Customer Phone</label>
                                <input type="text" name="customer_phone" class="form-control"
                                    placeholder="customer phone">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="customer_address">Customer Address</label>
                                <input type="text" name="customer_address" class="form-control"
                                    placeholder="customer address">
                            </div>
                        </div>
                    </x-slot>

                    <x-slot name="footer">
                        <button class="btn btn-sm btn-primary float-right" type="submit">@lang('Create Booking')</button>
                    </x-slot>
                </x-backend.card>
            </form>


        </div>

    </div>
@endsection
