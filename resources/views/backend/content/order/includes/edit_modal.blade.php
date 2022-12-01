<div class="modal fade" id="changeStatusButton" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">

  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <form method="POST" action="{{ url('http://192.168.0.7:3000/api/v1/') }}" id="statusChargeForm">
        @csrf
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
            <label for="itemNO">Item Number</label>
            <input type="text" name="itemNO" id="ItemNo" value="" placeholder="item number" class="form-control" />
          </div>
          @if ($logged_in_user->hasAllAccess() || $logged_in_user->can('admin.order.order_rmb.edit'))
          <div class="form-group">
            <label for="orderRmb">Order(rmb)</label>
            <input type="text" name="orderRmb" placeholder="Order in Rmb" class="form-control" />
          </div>
          <div class="form-group">
            <label for="status">Status</label>
            <select class="form group dropdown-item border" name="status">
              <option value=""></option>
              <option value="processing">Processing</option>
            </select>
          </div>

          @endif

          @if ($logged_in_user->hasAllAccess())
          <div class="form-group">
            <label for="product_value">Product cost in BDT</label>
            <input type="text" name="product_value" placeholder="Product price from Skybuy" class="form-control" />
          </div>

          <div class="form-group">
            <label for="bdReceive">BD Received Cost</label> {{-- calculate product cost + china local delivery --}}
            <input type="text" name="bdReceive" placeholder="(china local delivery*Conversion)+product Cost" class="form-control" />
          </div>
          @endif
          {{-- BD Purchase Officer end --}}


          {{-- China Purchase Officer start --}}
          @if ($logged_in_user->hasAllAccess() || $logged_in_user->can('admin.order.purchase.edit'))
          <div class="form-group">
            <label for="purchaseCost">Actual RMB(purchase cost)</label>
            <input type="text" name="purchaseCost" placeholder="RMB" class="form-control" />
          </div>
          <div class="form-group">
            <label for="status">Status</label>
            <select class="form group dropdown-item border" name="status">
              <option value=""></option>
              <option value="hold">Hold</option>
              <option value="purchased">Purchased</option>
              <option value="re_order">RE-Order</option>
              <option value="refund">Refund Please</option>
            </select>
          </div>
          @endif
          {{-- <div class="form-group">
                                <label for="productCost">Product cost in BDT</label>
                                <input type="text" name="productCost" required=""
                                    placeholder="PurchaseCost * Conversion Rate" class="form-control" />
                            </div> --}}

          @if ($logged_in_user->hasAllAccess() || $logged_in_user->can('admin.order.localdelivery.edit'))
          <div class="form-group">
            <label for="chinaLocal">China Local Delivery</label>
            <input type="text" name="chinaLocal" placeholder="China Local Delivery" class="form-control" />
          </div>
          @endif

          {{-- China Purchase Officer end --}}

          {{-- China Warehouse start --}}
          @if ($logged_in_user->hasAllAccess() ||
          $logged_in_user->can('admin.order.carton.edit'))

          <div class="form-group">
            <label for="status">Shipping Method</label>
            <select class="form group dropdown-item border" name="shipping_method">
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
            <label for="productName">Product Name</label>
            <input type="text" name="productName" placeholder="Product Name" class="form-control" />
          </div>

          <div class="form-group">
            <label for="quantity">Quantity</label>
            <input type="text" name="quantity" placeholder="Quantity" class="form-control" />
          </div>

          <div class="form-group">
            <label for="weight">Weight</label>
            <input type="text" name="weight" placeholder="Weight" class="form-control" />
          </div>

          <div class="form-group">
            <label for="cbm">CBM</label>
            <input type="text" name="cbm" placeholder="CBM" class="form-control" />
          </div>

          <div class="form-group">
            <label for="cartonId">Carton ID</label>
            <input type="text" name="cartonId" placeholder="Carton Id" class="form-control" />
          </div>

          <div class="form-group">
            <label for="trackingId">Tracking ID</label>
            <input type="text" name="trackingId" placeholder="Tracking Id" class="form-control" />
          </div>



          <div class="form-group">
            <label for="shipped_by">Shipping By</label>
            <select class="form group dropdown-item border" name="shipped_by">
              <option value="air">By Air</option>
              <option value="sea">By Sea</option>
            </select>
          </div>
          @endif
          {{-- China Warehouse END --}}

          {{-- BD Logistic Officer start --}}
          {{-- product name, quantity, weight, carton Id --}}
          @if ($logged_in_user->hasAllAccess() || $logged_in_user->can('admin.order.rate.edit'))
          {{-- <div class="form-group">
                                <label for="shipRate">Shipping Rate</label>
                                <input type="text" name="shipRate" required="" placeholder="Shipping Rate"
                                    class="form-control" />
                            </div> --}}

          {{-- <div class="form-group">
                                <label for="shipamount">Amount</label>
                                <input type="text" name="shipamount" required=""
                                    placeholder="Shipping Rate * Weight" class="form-control" />
                            </div> --}}

          <div class="form-group">
            <label for="status">Status</label>
            <select class="form group dropdown-item border" name="status">
              <option value=""></option>
              <option value="received">Received in BD warehouse</option>

            </select>
          </div>

          @endif
          @if ($logged_in_user->hasAllAccess() || $logged_in_user->can('admin.order.status.edit'))
          <div class="form-group">
            <label for="status">Status</label>
            <select class="form group dropdown-item border" name="status">
              <option value=""></option>
              <option value="received">Received in china warehouse</option>
              <option value="received">Shipped from china warehouse</option>
            </select>
          </div>
          @endif
          {{-- BD Logistic Officer END --}}

          <div class="form-group form-check">
            <input type="checkbox" name="notify" value="1" class="form-check-input" id="notify" checked="true">
            <label class="form-check-label" for="notify">Notify User</label>
          </div>

        </div>
        <div class="modal-footer justify-content-between">
          <button type="submit" class="btn btn-primary" id="statusSubmitBtn">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div> <!-- changeStatusButton -->

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>

<script>
  function orderModal(data) {
    // console.log(data);
    $("#changeStatusButton").modal('show');
    $('#ItemNo').val(data.order_number); // order_number will replaced by item_number

  }
</script>