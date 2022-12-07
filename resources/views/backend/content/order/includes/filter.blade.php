<form class="search" name="search" action="{{ route('admin.order.index') }}" method="GET">
    <div class="row">
        <div class="col-3">
            <label for="item_number">Item</label>
            <input type="text" id="item_number" name="item_number" class="form-control"
                value="{{ request('item_number', null) }}" placeholder="item number">
        </div>

        <div class="col-2">
            <label for="status">Status</label>
            <select class="form-control" name="status">
                <option value="">Select</option>
                <option @if (request('status', null) == 'processing') selected @endif value="processing">Processing</option>
                <option @if (request('status', null) == 'hold') selected @endif value="hold">Hold</option>
                <option @if (request('status', null) == 'purchased') selected @endif value="purchased">Purchased</option>
                <option @if (request('status', null) == 're_order') selected @endif value="re_order">RE-Order</option>
                <option @if (request('status', null) == 'partial-paid') selected @endif value="partial-paid">partial-paid</option>
                <option @if (request('status', null) == 'refund') selected @endif value="refund">Refund Please</option>
                <option @if (request('status', null) == 'waiting_for_payment') selected @endif value="waiting_for_payment">Waiting For
                    Payment</option>
                <option @if (request('status', null) == 'china_received') selected @endif value="china_received">Received in china
                    warehouse</option>
                <option @if (request('status', null) == 'china_shipped') selected @endif value="china_shipped">Shipped from china
                    warehouse</option>
                <option @if (request('status', null) == 'bd_received') selected @endif value="bd_received">Received in BD warehouse
                </option>
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
