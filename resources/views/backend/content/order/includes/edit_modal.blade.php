<div class="modal fade" id="updateButton" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered mymodal" role="document">
        <div class="modal-content">
            <form method="post" id="updateItem" class="itemModal">
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

                    @if ($logged_in_user->can('admin.order.product_type'))
                        <div class="form-group">
                            <label for="product_type">Product Type</label>
                            <textarea type="text" class="form-control" name="product_type" id="product_type" placeholder="Product Type"></textarea>
                        </div>
                    @endif

                    {{-- China Purchase Officer End --}}
                    @if ($logged_in_user->can('admin.order.shipping_from'))
                        <div class="form-group">
                            <label for="shipping_from">Shipping From</label>
                            <select class="form-control" name="shipping_from" id="shipping_from">
                                <option value="guangzhou">guangzhou</option>
                                <option value="hongkong">hongkong</option>

                            </select>
                        </div>
                    @endif
                    @if ($logged_in_user->can('admin.order.shipping_mark'))
                        <div class="form-group">
                            <label for="shipping_mark">Shipping Mark</label>
                            <input type="text" name="shipping_mark" id="shipping_mark" placeholder="shipping mark"
                                class="form-control" />
                        </div>
                    @endif
                    @if ($logged_in_user->can('admin.order.chn_warehouse_qty'))
                        <div class="form-group">
                            <label for="chn_warehouse_qty">China Warehouse Qty</label>
                            <table style="width:100%" id="chn_qty" class="chn_qty">
                                {{-- chn_warehouse_qty input area will append here --}}
                            </table>
                        </div>
                    @endif

                    @if ($logged_in_user->can('admin.order.chn_warehouse_weight'))
                        <div class="form-group">
                            <label for="chn_warehouse_weight">China Warehouse Weight</label>
                            <table style="width:100%" id="chn_weight" class="chn_weight">
                                {{-- chn_warehouse_weight input area will append here --}}
                            </table>
                        </div>
                    @endif

                    @if ($logged_in_user->can('admin.order.cbm.edit'))
                        <div class="form-group">
                            <label for="cbm">CBM</label>
                            <input type="text" name="cbm" id="cbm" placeholder="CBM"
                                class="form-control" />
                        </div>
                    @endif

                    @if ($logged_in_user->can('admin.order.carton_id'))
                        <div class="form-group">
                            <label for="carton_id">Carton ID</label>
                            <table style="width:100%" id="add-carton" class="add-carton">
                                {{-- carton input area will append here --}}
                            </table>
                        </div>
                    @endif

                    @if ($logged_in_user->can('admin.order.shipped_by'))
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

                    @if ($logged_in_user->can('admin.order.tracking_id'))
                        <div class="form-group">
                            <label for="tracking_number">Tracking ID</label>
                            <table style="width:100%" id="add-tracking-number" class="add-tracking-number">
                                {{-- tracking input area will append here --}}
                            </table>
                        </div>
                    @endif
                    @if ($logged_in_user->can('admin.order.remarks'))
                        <div class="form-group">
                            <label for="remarks">Remarks</label>
                            <textarea type="text" class="form-control" rows="4" name="remarks" id="remarks" placeholder="remarks"></textarea>
                        </div>
                    @endif
                    @if ($logged_in_user->can('admin.order.feedback'))
                        <div class="form-group">
                            <label for="feedback">Customer Feedback</label>
                            <textarea type="text" class="form-control" rows="4" name="feedback" id="feedback"
                                placeholder="customer feedback"></textarea>
                        </div>
                    @endif
                    @if ($logged_in_user->can('admin.order.claim'))
                        <div class="form-group">
                            <label for="claim">Claim</label>
                            <textarea type="text" class="form-control" rows="3" name="claim" id="claim" placeholder="claim"></textarea>
                        </div>
                    @endif
                    @if ($logged_in_user->can('admin.order.solution'))
                        <div class="form-group">
                            <label for="solution">Solution</label>
                            <textarea type="text" class="form-control" rows="3" name="solution" id="solution"
                                placeholder="solution"></textarea>
                        </div>
                    @endif
                    <div class="form-group status">
                        <label for="status">Status</label>
                        <select class="form-control" name="status" id="status">
                            <option value="">Select</option>
                            @if ($logged_in_user->can('admin.order.status.processing'))
                                <option value="processing">Processing</option>
                            @endif
                            @if ($logged_in_user->can('admin.order.status.on-hold'))
                                <option value="on-hold">On Hold</option>
                            @endif
                            @if ($logged_in_user->can('admin.status.pending-to-pay'))
                                <option value="pending-to-pay">Pending To Pay</option>
                            @endif
                            @if ($logged_in_user->can('admin.status.after-sales-services'))
                                <option value="after-sales-services">After Sales Services</option>
                            @endif
                            @if ($logged_in_user->can('admin.order.status.purchased'))
                                <option value="purchased">Purchase Completed</option>
                            @endif
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
                                <option value="received-in-china-warehouse">Received in china warehouse</option>
                            @endif
                            @if ($logged_in_user->can('admin.order.status.shipped-from-china-warehouse'))
                                <option value="shipped-from-china-warehouse">Shipped from china warehouse</option>
                            @endif
                            @if ($logged_in_user->can('admin.order.status.received-in-BD-warehouse'))
                                <option value="received-in-BD-warehouse">Received in BD warehouse</option>
                            @endif
                        </select>
                    </div>

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-primary" id="statusSubmitBtn">Save changes</button>
                </div>
            </form>

        </div>
    </div>
</div> <!-- updateButton -->
