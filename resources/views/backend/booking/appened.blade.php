<table id="add_new_book">
    <tr>
        <td>
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="date">Date</label>
                    <input type="date" name="date[]" class="form-control" placeholder="approx date"
                        value="{{ now()->format('Y-m-d') }}">
                </div>
                @if ($logged_in_user->can('admin.status.shipping_mark'))
                    <div class="form-group col-md-6">
                        <label for="shipping_mark">Shipping Mark</label>
                        <input type="text" name="shipping_mark[]" placeholder="shipping mark" class="form-control" />
                    </div>
                @endif
            </div>

            <div class="row">
                @if ($logged_in_user->can('admin.status.product_name'))
                    <div class="form-group col-md-6">
                        <label for="othersProductName">Product Name</label>
                        <input type="text" name="othersProductName[]" placeholder="product name"
                            class="form-control" />
                    </div>
                @endif
                @if ($logged_in_user->can('admin.status.product_qty'))
                    <div class="form-group col-md-6">
                        <label for="productQuantity">Product Quantity</label>
                        <input type="text" name="productQuantity[]" class="form-control"
                            placeholder="product quantity">
                    </div>
                @endif
            </div>

            <div class="row">
                @if ($logged_in_user->can('admin.status.carton_qty'))
                    <div class="form-group col-md-6">
                        <label for="ctnQuantity">Carton Quantity</label>
                        <input type="text" name="ctnQuantity[]" class="form-control" placeholder="quantity">
                    </div>
                @endif
                @if ($logged_in_user->can('admin.status.cbm'))
                    <div class="form-group col-md-6">
                        <label for="totalCbm">Total Cbm</label>
                        <input type="text" name="totalCbm[]" class="form-control" placeholder="total CBM">
                    </div>
                @endif
            </div>
            <div class="row">
                @if ($logged_in_user->can('admin.status.products_weight'))
                    <div class="form-group col-md-6">
                        <label for="actual_weight">Products Weight</label>
                        <input type="text" name="actual_weight[]" placeholder="carton weight" id="weights"
                            class="form-control" />
                    </div>
                @endif
                @if ($logged_in_user->can('admin.status.tracking_number'))
                    <div class="form-group col-md-6">
                        <label for="tracking_number">Tracking Number</label>
                        <input type="text" name="tracking_number[]" placeholder="tracking number"
                            class="form-control" />
                    </div>
                @endif
            </div>


            <div class="row">

                @if ($logged_in_user->can('admin.status.shipping_number'))
                    <div class="form-group col-md-6">
                        <label for="shipping_number">Shipping Number</label>
                        <input type="text" name="shipping_number[]" placeholder="shipping number"
                            class="form-control" />
                    </div>
                @endif
                @if ($logged_in_user->can('admin.status.product_cost'))
                    <div class="form-group col-md-6">
                        <label for="productsTotalCost">Products Total Cost</label>
                        <input type="text" name="productsTotalCost[]" class="form-control"
                            placeholder="products total Cost(BDT)">
                    </div>
                @endif
            </div>

            <div class="row">
                @if ($logged_in_user->can('admin.status.unit_price'))
                    <div class="form-group col-md-6">
                        <label for="unit_price">Unit Price/kg</label>
                        <input type="text" name="unit_price[]" class="form-control" placeholder="unit price/kg">
                    </div>
                @endif
                @if ($logged_in_user->can('admin.status.remarks'))
                    <div class="form-group col-md-6">
                        <label for="remarks">Remarks</label>
                        <input type="text" name="remarks[]" class="form-control" placeholder="remarks">
                    </div>
                @endif
            </div>

            <div class="row">
                @if ($logged_in_user->can('admin.status.chinalocal'))
                    <div class="form-group col-md-6">
                        <label for="chinalocal">China Local Delivery(rmb)</label>
                        <input type="text" name="chinalocal[]" class="form-control"
                            placeholder="china local delivery(rmb)">
                    </div>
                @endif
                @if ($logged_in_user->can('admin.status.packing'))
                    <div class="form-group col-md-6">
                        <label for="packing_cost">Packing Cost(rmb)</label>
                        <input type="text" name="packing_cost[]" class="form-control"
                            placeholder="packing cost(rmb)">
                    </div>
                @endif
            </div>
            <div class="row">
                @if ($logged_in_user->can('admin.status.courier'))
                    <div class="form-group col-md-6">
                        <label for="courier_bill">Courier Bill(rmb)</label>
                        <input type="text" name="courier_bill[]" class="form-control"
                            placeholder="courier bill(rmb)">
                    </div>
                @endif
                @if ($logged_in_user->can('admin.status.paid'))
                    <div class="form-group col-md-6">
                        <label for="paid">Paid</label>
                        <input type="double" name="paid[]" class="form-control" placeholder="paid">
                    </div>
                @endif
            </div>

            <div class="row">
                @if ($logged_in_user->can('admin.status.status'))
                    <div class="form-group col-md-12">
                        <label for="status">Products Status</label>
                        <select class="form-control" name="status[]">
                            <option value="">Select</option>
                            <option value="received-in-china-warehouse">Received in china
                                warehouse
                            </option>
                            <option value="shipped-from-china-warehouse">Shipped from china
                                warehouse
                            </option>
                            <option value="received-in-BD-warehouse">Received in BD warehouse
                            </option>
                            <option value="delivered">Delivered</option>
                        </select>
                    </div>
                @endif
            </div>
            @if ($logged_in_user->can('admin.status.customer'))
                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="customer_name">Customer Name</label>
                        <input type="text" name="customer_name[]" class="form-control"
                            placeholder="customer name">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="customer_phone">Customer Phone</label>
                        <input type="text" name="customer_phone[]" class="form-control"
                            placeholder="customer phone">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="customer_address">Customer Address</label>
                        <input type="text" name="customer_address[]" class="form-control"
                            placeholder="customer address">
                    </div>
                </div>
            @endif
            {{-- <input type="hidden" id="user" value="{{ $logged_in_user->name }}"> --}}
            <div class="row">
                <div class="form-group col-md-6" style="margin-top:35px">
                    <button class="btn btn-outline-success" id="add-new-book" type="button">+
                        Add
                        Product</button>
                    <button class="btn btn-outline-danger" id="remove" type="button">-
                        Remove</button>
                </div>

            </div>
        </td>
    </tr>
</table>
