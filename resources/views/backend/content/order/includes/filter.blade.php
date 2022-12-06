<form class="search" name="search" action="{{ route('admin.filter-order') }}" method="GET">
    <div class="row">
        <div class="col-3">
            <label for="item_number">Item</label>
            <input type="text" id="item_number" name="item_number" class="form-control" placeholder="item number">
        </div>

        <div class="col-2">
            <label for="status">Status</label>
            <select class="form-control" name="status">
                <option value="">Select</option>
                <option value="processing">Processing</option>
                <option value="hold">Hold</option>
                <option value="purchased">Purchased</option>
                <option value="re_order">RE-Order</option>
                <option value="partial-paid">partial-paid</option>
                <option value="refund">Refund Please</option>
                <option value="waiting_for_payment">Waiting For Payment</option>
                <option value="china_received">Received in china warehouse</option>
                <option value="china_shipped">Shipped from china warehouse</option>
                <option value="bd_received">Received in BD warehouse</option>
            </select>
        </div>

        <div class="col-3">
            <label for="date">From date</label>
            <input type="date" id="startdate" class="form-control" name="from_date">
        </div>

        <div class="col-4">
            <div class="row">
                <div class="col-8">
                    <label for="date">To Date</label>
                    <input type="date" id="enddate" name="to_date" class="form-control">
                </div>
                <div class="col-4">
                    <button type="submit" class="btn btn-outline-primary" style="margin-top:29px;" id="filter" name="filter"><i class="fa fa-search"></i> Search</button>
                </div>
            </div>
        </div>
    </div>
</form>