<div class="modal fade" id="updateButton" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form method="post" id="updateItem">
                @csrf
                <input type="hidden" name="order_update" id="order_update" value="" class="form-control" />
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Change Status<span class="orderId"></span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    {{-- BD Purchase Officer start --}}
                    <div class="form-group">
                        <label for="order_item_id">Item Number</label>
                        <input type="text" name="order_item_id" id="order_item_id" placeholder="item number"
                            class="form-control order_item_id" readonly />
                    </div>

                    @if ($logged_in_user->can('admin.order.order_rmb.edit') || $logged_in_user->can('admin.order.purchase.edit'))
                        <div class="form-group">
                            <label for="order_item_rmb">Order(rmb)</label>
                            <input type="text" id="order_item_rmb" name="order_item_rmb" placeholder="Order in Rmb"
                                class="form-control" />
                        </div>
                    @endif

                    {{-- BD Purchase Officer end --}}

                    {{-- China Purchase Officer start --}}
                    @if ($logged_in_user->can('admin.order.purchase.edit'))
                        <div class="form-group">
                            <label for="purchase_rmb">Actual RMB(purchase cost)</label>
                            <input type="text" id="purchase_rmb" name="purchase_rmb" placeholder="RMB"
                                class="form-control" />
                        </div>
                        <div class="form-group">
                            <label for="purchase_cost_bd">BD Out<small
                                    class="form-text text-muted float-right">(Purchase Rmb * Conversion
                                    Rate)</small></label>
                            <input type="text" name="purchase_cost_bd" id="purchase_cost_bd" readonly
                                placeholder="Actual Cost In BDT" class="form-control" />

                        </div>
                        <input type="hidden" name="product_value" id="product_value" class="form-control" />
                        <div class="form-group">
                            <label for="product_bd_received_cost">BD Receive<small
                                    class="form-text text-muted float-right">((China Local
                                    Delivery*Conversion)+Product
                                    Value)</small></label>
                            <input type="text" name="product_bd_received_cost" id="product_bd_received_cost" readonly
                                placeholder="BD Received Cost" class="form-control" />

                        </div>
                    @endif
                    @if ($logged_in_user->can('admin.order.localdelivery.edit'))
                        <div class="form-group">
                            <label for="china_local_delivery_rmb">China Local Delivery(RMB)</label>
                            <input type="text" name="china_local_delivery_rmb" id="china_local_delivery_rmb"
                                placeholder="China Local Delivery" class="form-control" />
                        </div>

                        <div class="form-group">
                            <label for="chinaLocalDelivery">China Local Delivery(BDT)<small
                                    class="form-text text-muted float-right">(China Local Delivery * Conversion
                                    Rate)</small></label>
                            <input type="text" name="chinaLocalDelivery" id="chinaLocalDelivery" readonly
                                placeholder="China Local Delivery In BDT" class="form-control" />

                        </div>
                    @endif
                    {{-- China Purchase Officer End --}}
                    @if ($logged_in_user->can('admin.order.carton.edit'))
                        <div class="form-group">
                            <label for="shipping_from">Shipping From</label>
                            <select class="form-control" name="shipping_from" id="shipping_from">
                                <option value="">Select Guangzhou/HongKong</option>
                                <option value="guangzhou">Guangzhou</option>
                                <option value="hongkong">HongKong</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="shipping_mark">Shipping Mark</label>
                            <input type="text" name="shipping_mark" id="shipping_mark" placeholder="shipping mark"
                                class="form-control" />
                        </div>

                        <div class="form-group">
                            <label for="chn_warehouse_qty">China Warehouse Qty</label>
                            <input type="text" name="chn_warehouse_qty" id="chn_warehouse_qty"
                                placeholder="chn_warehouse_qty" class="form-control" />
                        </div>

                        <div class="form-group">
                            <label for="chn_warehouse_weight">China Warehouse Weight</label>
                            {{-- <table style="width:100%" id="add-weight">
                                <tr>
                                    <td><input type="text" name="chn_warehouse_weight[]"
                                            placeholder="china warehouse weight" class="form-control" /></td>
                                    <td class="text-right" style="width:1%"><button type="button" name="add"
                                            id="weight-btn" class="btn btn-outline-success">+</button>
                                    </td>
                                    <td class="text-right" style="width:1%"><button type="button"
                                            class="btn btn-outline-danger">-</button></td>
                                </tr>
                            </table> --}}
                            <textarea type="text" name="chn_warehouse_weight" id="chn_warehouse_weight" placeholder="chn_warehouse_weight"
                                class="form-control"> </textarea>
                        </div>

                        <div class="form-group">
                            <label for="cbm">CBM</label>
                            <input type="text" name="cbm" id="cbm" placeholder="CBM"
                                class="form-control" />
                        </div>

                        <div class="form-group">
                            <label for="carton_id">Carton ID</label>
                            <table style="width:100%" id="add-carton">
                                <tr>
                                    <td><input type="text" name="carton_id[]" placeholder="carton id"
                                            class="form-control" /></td>
                                    <td class="text-right" style="width:1%"><button type="button" name="add"
                                            id="carton-btn" class="btn btn-outline-success">+</button>
                                    </td>
                                    <td class="text-right" style="width:1%"><button type="button"
                                            class="btn btn-outline-danger">-</button></td>
                                </tr>
                            </table>
                            {{-- <textarea type="text" name="carton_id" id="carton_id" placeholder="Carton Id" class="form-control"></textarea> --}}
                        </div>

                        <div class="form-group">
                            <label for="product_type">Product Type</label>
                            <textarea type="text" class="form-control" name="product_type" id="product_type" placeholder="Product Type"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="shipped_by">Shipping By</label>
                            <select class="form-control" name="shipped_by" id="shipped_by">
                                <option @if (request('shipped_by', null) == 'ship_by_air') selected @endif value="ship_by_air">
                                    ship_by_air</option>
                                <option @if (request('shipped_by', null) == 'ship_by_sea') selected @endif value="ship_by_sea">
                                    ship_by_sea</option>
                            </select>
                        </div>
                    @endif

                    @if ($logged_in_user->can('admin.order.purchase.edit') || $logged_in_user->can('admin.order.carton.edit'))
                        <div class="form-group">
                            <label for="tracking_number">Tracking ID</label>
                            <table style="width:100%" id="add-tracking-number">

                                <tr>
                                    <td><input type="text" name="tracking_number[]" placeholder="tracking id"
                                            class="form-control" /></td>
                                    <td class="text-right" style="width:1%"><button type="button" name="add"
                                            id="tracking-btn" class="btn btn-outline-success">+</button>
                                    </td>
                                    <td class="text-right" style="width:1%"><button type="button"
                                            class="btn btn-outline-danger">-</button></td>
                                </tr>
                            </table>
                            {{-- <input type="text" name="tracking_number" id="tracking_number"
                                placeholder="Tracking Id" class="form-control" /> --}}
                        </div>
                    @endif

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
                                <option value="received-in-china-warehouse">Received in china warehouse</option>
                                <option value="shipped-from-china-warehouse">Shipped from china warehouse</option>
                            @endif
                            @if ($logged_in_user->can('admin.order.rate.edit'))
                                <option value="received-in-BD-warehouse">Received in BD warehouse</option>
                            @endif
                        </select>
                    </div>
                    {{-- @if ($logged_in_user->hasAllAccess())
                    <input type="hidden" name="product_value" id="product_value" class="form-control" />
                     <div class="form-group">
                        <label for="product_bd_received_coast">BDT Received From Customer(BD Receive)</label>
                        <input type="text" name="product_bd_received_cost" id="product_bd_received_cost" readonly  placeholder="BD Received Cost" class="form-control" />
                         <small class="form-text text-muted">(China Local Delivery*Conversion)+Product Value</small>
                    </div>
                    @endif --}}
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-primary" id="statusSubmitBtn">Save changes</button>
                </div>
            </form>

        </div>
    </div>
</div> <!-- updateButton -->
