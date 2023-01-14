<form class="search" name="search" method="GET">
    @csrf
    <div class="row">
        <div class="col-2">
            <label for="recap_report">Recap Report</label>
            <select class="form-control" name="recap_report">
                <option value="">Select</option>
                <option @if (request('current_week', null) == 'current_week') selected @endif value="current_week">This Week</option>
                <option @if (request('current_month', null) == 'current_month') selected @endif value="current_month">This Month</option>
                <option @if (request('current_year', null) == 'current_year') selected @endif value="current_year">This Year</option>
            </select>

        </div>

        <div class="col-2">
            <label for="item_number">Item</label>
            <input type="text" id="item_number" name="item_number" value="{{ request('item_number', null) }}"
                class="form-control" placeholder="item number">
        </div>

        <div class="col-2">
            <label for="date">From date</label>
            <input type="date" id="startdate" class="form-control" name="from_date"
                value="{{ request('from_date', null) ? date('Y-m-d', strtotime(request('from_date', null))) : '' }}">
        </div>
        <div class="col-2">
            <label for="date">To Date</label>
            <input type="date" id="to_date" name="to_date" class="form-control"
                value="{{ request('to_date', null) ? date('Y-m-d', strtotime(request('to_date', null))) : '' }}">
        </div>

        <div class="col-4">
            <div class="row">
                <div class="col-8">
                    <label for="status">Status</label>

                    <select class="form-control" name="status">
                        <option value="">Select</option>
                        <option @if (request('status', null) == 'processing') selected @endif value="processing">Processing</option>
                        <option @if (request('status', null) == 'on-hold') selected @endif value="on-hold">On Hold</option>
                        <option @if (request('status', null) == 'purchased') selected @endif value="purchased">Purchase Completed
                        </option>
                        <option @if (request('status', null) == 're-order') selected @endif value="re-order">RE Order</option>
                        <option @if (request('status', null) == 'Partial-Paid') selected @endif value="Partial-Paid">Partial Paid
                        </option>
                        <option @if (request('status', null) == 'refund-please') selected @endif value="refund-please">Refund Please
                        </option>
                        <option @if (request('status', null) == 'refunded') selected @endif value="refunded">Refunded</option>
                        <option @if (request('status', null) == 'on-transit-to-customer') selected @endif value="on-transit-to-customer">On
                            Transit To Customer</option>
                        <option @if (request('status', null) == 'delivered') selected @endif value="delivered">Delivered</option>
                        <option @if (request('status', null) == 'out-of-stock') selected @endif value="out-of-stock">Out Of Stock
                        </option>
                        <option @if (request('status', null) == 'adjustment') selected @endif value="out-of-stock">Adjustment
                        </option>
                        <option @if (request('status', null) == 'refunded') selected @endif value="refunded">Refunded</option>
                        <option @if (request('status', null) == 'delivery-after-holiday') selected @endif value="delivery-after-holiday">
                            Delivery after holiday</option>

                        <option @if (request('status', null) == 'received-in-china-warehouse') selected @endif value="received-in-china-warehouse">
                            Received in china
                            warehouse</option>
                        <option @if (request('status', null) == 'shipped-from-china-warehouse') selected @endif
                            value="shipped-from-china-warehouse">Shipped from china
                            warehouse</option>
                        <option @if (request('status', null) == 'received-in-BD-warehouse') selected @endif value="received-in-BD-warehouse">
                            Received in BD warehouse
                        </option>
                    </select>

                </div>
                <div class="col-4">
                    <button type="submit" class="btn btn-outline-primary" style="margin-top:29px;" id="filter"
                        name="filter"><i class="fa fa-search"></i> Search</button>
                </div>
            </div>
        </div>
    </div>
</form>
