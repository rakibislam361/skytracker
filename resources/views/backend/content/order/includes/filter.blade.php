<form class="search" name="search" action="{{ route('admin.order.index') }}" method="GET">
    <div class="row">
        <div class="col-3">
            <label for="item_number">Item</label>
            <input type="text" id="item_number" name="item_number" class="form-control" value="{{ request('item_number', null) }}" placeholder="item number">
        </div>
        @if ($logged_in_user->hasAllAccess())
        <div class="col-2">
            <label for="status">Status</label>
            <select class="form-control" name="status">
                <option value="">Select</option>
                <option @if (request('status', null)=='processing' ) selected @endif value="processing">Processing</option>
                <option @if (request('status', null)=='on-hold' ) selected @endif value="on-hold">On Hold</option>
                <option @if (request('status', null)=='purchased' ) selected @endif value="purchased">Purchased</option>
                <option @if (request('status', null)=='re-order' ) selected @endif value="re-order">RE Order</option>
                <option @if (request('status', null)=='Partial-Paid' ) selected @endif value="Partial-Paid">Partial Paid</option>
                <option @if (request('status', null)=='refunded' ) selected @endif value="refunded">Refund Please</option>
                <option @if (request('status', null)=='shipped-from-suppliers' ) selected @endif value="shipped-from-suppliers">Shipped From Suppliers</option>
                <option @if (request('status', null)=='Waiting-for-Payment' ) selected @endif value="Waiting-for-Payment">Waiting For
                    Payment</option>
                <option @if (request('status', null)=='received-in-china-warehouse' ) selected @endif value="received-in-china-warehouse">Received in china
                    warehouse</option>
                <option @if (request('status', null)=='shipped-from-china-warehouse' ) selected @endif value="shipped-from-china-warehouse">Shipped from china
                    warehouse</option>
                <option @if (request('status', null)=='received-in-BD-warehouse' ) selected @endif value="received-in-BD-warehouse">Received in BD warehouse
                </option>
                <option @if (request('status', null)=='on-transit-to-customer' ) selected @endif value="on-transit-to-customer">On Transit To Customer</option>
                <option @if (request('status', null)=='delivered' ) selected @endif value="delivered">Delivered</option>
                <option @if (request('status', null)=='out-of-stock' ) selected @endif value="out-of-stock">Out Of Stock</option>
                <option @if (request('status', null)=='adjustment' ) selected @endif value="out-of-stock">Adjustment</option>
            </select>
        </div>

        <div class="col-3">
            <label for="date">From date</label>
            <input type="date" id="startdate" class="form-control" name="from_date" value="{{ request('from_date', null) ? date('Y-m-d', strtotime(request('from_date', null))) : '' }}">
        </div>
       @endif
        <div class="col-4">
            <div class="row">
                @if ($logged_in_user->hasAllAccess())
                <div class="col-8">
                    <label for="date">To Date</label>
                    <input type="date" id="enddate" name="to_date" class="form-control" value="{{ request('to_date', null) ? date('Y-m-d', strtotime(request('to_date', null))) : '' }}">
                </div>
                @endif
                <div class="col-4">
                    <button type="submit" class="btn btn-outline-primary" style="margin-top:29px;" id="filter" name="filter"><i class="fa fa-search"></i> Search</button>
                </div>
            </div>
        </div>
    </div>
</form>