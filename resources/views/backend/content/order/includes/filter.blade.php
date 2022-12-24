<form name="search" action="{{ route('admin.order.index') }}" method="GET">
    <div class="row">
        <div class="col-2">
            <label for="item_number">Item</label>
            <input type="text" id="item_number" name="item_number" class="form-control" value="{{ request('item_number', null) }}" placeholder="item number">
        </div>

        <div class="col-2">
            <label for="status">Status</label>
            <select class="form-control" name="status">
                <option value="">Select</option>
                @if ($logged_in_user->can('admin.order.order_rmb.edit') ||
                $logged_in_user->can('admin.order.purchase.edit') ||
                $logged_in_user->can('admin.order.status.edit') ||
                $logged_in_user->can('admin.order.rate.edit'))
                <option @if (request('status', null)=='processing' ) selected @endif value="processing">Processing</option>
                <option @if (request('status', null)=='on-hold' ) selected @endif value="on-hold">On Hold</option>
                <option @if (request('status', null)=='Partial-Paid' ) selected @endif value="Partial-Paid">Partial Paid
                </option>
                @endif

                @if ($logged_in_user->can('admin.order.purchase.edit') ||
                $logged_in_user->can('admin.order.status.edit') ||
                $logged_in_user->can('admin.order.rate.edit'))
                <option @if (request('status', null)=='purchased' ) selected @endif value="purchased">Purchase Completed
                </option>
                <option @if (request('status', null)=='re-order' ) selected @endif value="re-order">RE Order</option>
                <option @if (request('status', null)=='refund-please' ) selected @endif value="refund-please">Refund Please
                </option>
                <option @if (request('status', null)=='shipped-from-suppliers' ) selected @endif value="shipped-from-suppliers">Shipped
                    From Suppliers</option>
                @endif

                @if ($logged_in_user->can('admin.order.status.edit') || $logged_in_user->can('admin.order.rate.edit'))
                <option @if (request('status', null)=='received-in-china-warehouse' ) selected @endif value="received-in-china-warehouse">
                    Received in china
                    warehouse</option>
                <option @if (request('status', null)=='shipped-from-china-warehouse' ) selected @endif value="shipped-from-china-warehouse">
                    Shipped from china
                    warehouse</option>
                <option @if (request('status', null)=='received-in-BD-warehouse' ) selected @endif value="received-in-BD-warehouse">Received
                    in BD warehouse
                </option>
                @endif

                @if ($logged_in_user->hasAllAccess())
                <option @if (request('status', null)=='refunded' ) selected @endif value="refunded">Refunded</option>
                <option @if (request('status', null)=='on-transit-to-customer' ) selected @endif value="on-transit-to-customer">On
                    Transit To Customer</option>
                <option @if (request('status', null)=='delivered' ) selected @endif value="delivered">Delivered</option>
                <option @if (request('status', null)=='out-of-stock' ) selected @endif value="out-of-stock">Out Of Stock
                </option>
                <option @if (request('status', null)=='adjustment' ) selected @endif value="out-of-stock">Adjustment</option>
                <option @if (request('status', null)=='Waiting-for-Payment' ) selected @endif value="Waiting-for-Payment">Waiting For
                    Payment</option>
                @endif
            </select>
        </div>

        <div class="col-3">
            <label for="shipping_from">Shipping From</label>
            <select class="form-control" name="shipping_from">
                <option value="">Select Guangzhou/HongKong</option>
                <option @if (request('shipping_from', null)=='guangzhou' ) selected @endif value="guangzhou">Guangzhou</option>
                <option @if (request('shipping_from', null)=='hongkong' ) selected @endif value="hongkong">HongKong</option>
            </select>
        </div>

        <div class="col-2">
            <label for="date">From date</label>
            <input type="date" id="startdate" class="form-control" name="from_date" value="{{ request('from_date', null) ? date('Y-m-d', strtotime(request('from_date', null))) : '' }}">
        </div>
        <div class="col-3">
            <div class="row">
                <div class="col-7">
                    <label for="date">To date</label>
                    <input type="date" id="enddate" name="to_date" class="form-control" value="{{ request('to_date', null) ? date('Y-m-d', strtotime(request('to_date', null))) : '' }}">
                </div>

                <div class="col-5">
                    <button type="submit" class="btn btn-outline-primary" style="margin-top:29px;" id="filter" name="filter"><i class="fa fa-search"></i> Search</button>
                </div>
            </div>
        </div>

    </div>
</form>