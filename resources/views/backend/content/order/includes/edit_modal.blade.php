 <div class="modal fade" id="changeStatusButton" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered" role="document">
         <div class="modal-content">
             <form method="put" action="" id="statusChargeForm">
                 @csrf
                 <div class="modal-header">
                     <h5 class="modal-title" id="exampleModalCenterTitle">Change Status<span class="orderId"></span>
                     </h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                     </button>
                 </div>

                 <div class="modal-body">
                     <div class="">
                         {{-- BD Purchase Officer start --}}
                         <div class="form-group">
                             <label for="order_item_number">Item Number</label>
                             <input type="text" name="order_item_number" id="order_item_number" placeholder="item number" class="form-control" readonly />
                         </div>

                         @if ($logged_in_user->hasAllAccess() || $logged_in_user->can('admin.order.order_rmb.edit'))
                         <div class="form-group">
                             <label for="order_item_rmb">Order(rmb)</label>
                             <input type="text" name="order_item_rmb" placeholder="Order in Rmb" class="form-control" />
                         </div>
                         @endif

                         @if ($logged_in_user->hasAllAccess())
                         <div class="form-group">
                             <label for="product_value">Product cost in BDT</label>
                             <input type="text" name="product_value" placeholder="Product price from Skybuy" class="form-control" />
                         </div>

                         <div class="form-group">
                             <label for="product_bd_received_coast">BD Received Cost</label> {{-- calculate product cost + china local delivery --}}
                             <input type="text" name="product_bd_received_coast" placeholder="(china local delivery*Conversion)+product Cost" class="form-control" />
                         </div>
                         @endif
                         {{-- BD Purchase Officer end --}}


                         {{-- China Purchase Officer start --}}
                         @if ($logged_in_user->hasAllAccess() || $logged_in_user->can('admin.order.purchase.edit'))
                         <div class="form-group">
                             <label for="purchase_rmb">Actual RMB(purchase cost)</label>
                             <input type="text" name="purchase_rmb" placeholder="RMB" class="form-control" />
                         </div>

                         @endif
                         {{-- <div class="form-group">
                                <label for="productCost">Product cost in BDT</label>
                                <input type="text" name="productCost" required=""
                                    placeholder="purchase_rmb * Conversion Rate" class="form-control" />
                            </div> --}}

                         @if ($logged_in_user->hasAllAccess() || $logged_in_user->can('admin.order.localdelivery.edit'))
                         <div class="form-group">
                             <label for="chinaLocalDelivery">China Local Delivery</label>
                             <input type="text" name="chinaLocalDelivery" placeholder="China Local Delivery" class="form-control" />
                         </div>
                         @endif

                         @if ($logged_in_user->hasAllAccess() || $logged_in_user->can('admin.order.carton.edit'))
                         <div class="form-group">
                             <label for="shipping_from">Shipping From</label>
                             <select class="form-control" name="shipping_from">
                                 <option value="">Select Guangzhou/HongKong</option>
                                 <option value="guangzhou">Guangzhou</option>
                                 <option value="hongkong">HongKong</option>
                             </select>
                         </div>

                         <div class="form-group">
                             <label for="shipping_mark">Shipping Mark</label>
                             <input type="text" name="shipping_mark" placeholder="shipping mark" class="form-control" />
                         </div>

                         <div class="form-group">
                             <label for="name">Product Name</label>
                             <input type="text" name="name" placeholder="Product Name" class="form-control" />
                         </div>

                         <div class="form-group">
                             <label for="chn_warehouse_qty">Chn Warehouse Qty</label>
                             <input type="text" name="chn_warehouse_qty" placeholder="chn_warehouse_qty" class="form-control" />
                         </div>

                         <div class="form-group">
                             <label for="chn_warehouse_weight">Chn Warehouse Weight</label>
                             <input type="text" name="chn_warehouse_weight" placeholder="chn_warehouse_weight" class="form-control" />
                         </div>

                         <div class="form-group">
                             <label for="cbm">CBM</label>
                             <input type="text" name="cbm" placeholder="CBM" class="form-control" />
                         </div>

                         <div class="form-group">
                             <label for="carton_id">Carton ID</label>
                             <input type="text" name="carton_id" placeholder="Carton Id" class="form-control" />
                         </div>

                         <div class="form-group">
                             <label for="tracking_number">Tracking ID</label>
                             <input type="text" name="tracking_number" placeholder="Tracking Id" class="form-control" />
                         </div>

                         <div class="form-group">
                             <label for="shipped_by">Shipping By</label>
                             <select class="form-control" name="shipped_by">
                                 <option value="air">By Air</option>
                                 <option value="sea">By Sea</option>
                             </select>
                         </div>
                         @endif

                         <div class="form-group">
                             <label for="status">Status</label>
                             <select class="form-control" name="status">
                                 <option value="">Select</option>
                                 @if ($logged_in_user->hasAllAccess() || $logged_in_user->can('admin.order.order_rmb.edit'))
                                 <option value="processing">Processing</option>
                                 @endif
                                 @if ($logged_in_user->hasAllAccess() || $logged_in_user->can('admin.order.purchase.edit'))
                                 <option value="hold">Hold</option>
                                 <option value="purchased">Purchased</option>
                                 <option value="re_order">RE-Order</option>
                                 <option value="refund">Refund Please</option>
                                 @endif
                                 @if ($logged_in_user->hasAllAccess() || $logged_in_user->can('admin.order.status.edit'))
                                 <option value="china_received">Received in china warehouse</option>
                                 <option value="china_shipped">Shipped from china warehouse</option>
                                 @endif
                                 @if ($logged_in_user->hasAllAccess() || $logged_in_user->can('admin.order.rate.edit'))
                                 <option value="bd_received">Received in BD warehouse</option>
                                 @endif
                             </select>
                         </div>

                         {{-- BD Logistic Officer END --}}
                         {{-- <div class="form-group form-check">
                        <input type="checkbox" name="notify" value="1" class="form-check-input"
                            id="notify" checked="true">
                        <label class="form-check-label" for="notify">Notify User</label>
                    </div> --}}

                     </div>
                 </div>

                 <div class="modal-footer justify-content-between">
                     <button type="button" class="btn btn-primary" id="statusSubmitBtn">Save changes</button>
                 </div>
             </form>

         </div>
     </div>
 </div> <!-- changeStatusButton -->