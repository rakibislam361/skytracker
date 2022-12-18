<form class="search" name="search" action="{{ route('admin.order.recent') }}" method="GET">
    <div class="row">
        <div class="col">
            <label for="order_number">Order</label>
            <input type="text" id="order_number" name="order_number" class="form-control"
                value="{{ request('order_number', null) }}" placeholder="order number">
        </div>

        <div class="col">
            <label for="status">Status</label>
            <select class="form-control" name="status">
                <option value="">Select</option>
                @if ($logged_in_user->can('admin.order.order_rmb.edit'))
                    <option @if (request('status', null) == 'processing') selected @endif value="processing">Processing</option>
                    <option @if (request('status', null) == 'Partial-Paid') selected @endif value="Partial-Paid">Partial Paid
                    </option>
                    <option @if (request('status', null) == 'on-hold') selected @endif value="on-hold">On Hold</option>
                @endif

                @if ($logged_in_user->hasAllAccess())
                    <option @if (request('status', null) == 'purchased') selected @endif value="purchased">Purchase Completed
                    </option>
                    <option @if (request('status', null) == 're-order') selected @endif value="re-order">RE Order</option>
                    <option @if (request('status', null) == 'refund-please') selected @endif value="refund-please">Refund Please
                    </option>
                    <option @if (request('status', null) == 'shipped-from-suppliers') selected @endif value="shipped-from-suppliers">Shipped
                        From Suppliers</option>

                    <option @if (request('status', null) == 'received-in-china-warehouse') selected @endif value="received-in-china-warehouse">
                        Received in china
                        warehouse</option>
                    <option @if (request('status', null) == 'shipped-from-china-warehouse') selected @endif value="shipped-from-china-warehouse">
                        Shipped from china
                        warehouse</option>
                    <option @if (request('status', null) == 'received-in-BD-warehouse') selected @endif value="received-in-BD-warehouse">Received
                        in BD warehouse
                    </option>


                    <option @if (request('status', null) == 'refunded') selected @endif value="refunded">Refunded</option>
                    <option @if (request('status', null) == 'on-transit-to-customer') selected @endif value="on-transit-to-customer">On
                        Transit To Customer</option>
                    <option @if (request('status', null) == 'delivered') selected @endif value="delivered">Delivered</option>
                    <option @if (request('status', null) == 'out-of-stock') selected @endif value="out-of-stock">Out Of Stock
                    </option>
                    <option @if (request('status', null) == 'adjustment') selected @endif value="out-of-stock">Adjustment</option>

                    <option @if (request('status', null) == 'Waiting-for-Payment') selected @endif value="Waiting-for-Payment">Waiting For
                        Payment</option>
                @endif
            </select>
        </div>

        <div class="col-3">
            <label for="date">From date</label>
            <input type="date" id="startdate" class="form-control" name="from_date"
                value="{{ request('from_date', null) ? date('Y-m-d', strtotime(request('from_date', null))) : '' }}">
        </div>
        <div class="col-4">
            <div class="row">
                <div class="col-8">
                    <label for="date">To Date</label>
                    <input type="date" id="enddate" name="to_date" class="form-control"
                        value="{{ request('to_date', null) ? date('Y-m-d', strtotime(request('to_date', null))) : '' }}">
                </div>

                <div class="col-4">
                    <button type="submit" class="btn btn-outline-primary" style="margin-top:29px;" id="filter"
                        name="filter"><i class="fa fa-search"></i> Search</button>
                </div>
            </div>
        </div>

    </div>
</form>
