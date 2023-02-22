<form name="search" action="{{ route('admin.booking.index') }}" method="GET">
    <div class="row">
        <input type="hidden" name="search" value="search">
        <div class="col-md-2">
            <label for="customer_name">Customer</label>
            <input type="text" id="customer_name" name="customer_name" class="form-control"
                value="{{ request('customer_name', null) }}" placeholder="customer name">
        </div>

        <div class="col-md-2">
            <label for="customer_phone">Phone</label>
            <input type="text" id="customer_phone" name="customer_phone" class="form-control"
                value="{{ request('customer_phone', null) }}" placeholder="customer phone">
        </div>
        <div class="col-md-2">
            <label for="carton_number">Carton Number</label>
            <input type="text" id="carton_number" class="form-control" name="carton_number"
                value="{{ request('carton_number', null) }}" placeholder="carton number">
        </div>

        <div class="col-md-6">
            <div class="row">
                <div class="col-md-4">
                    <label for="shipping_number">Shipping Number</label>
                    <input type="text" id="shipping_number" name="shipping_number" class="form-control"
                        value="{{ request('shipping_number', null) }}" placeholder="shipping number">

                </div>
                <div class="col-md-5">
                    <label for="status">Status</label>
                    <select class="form-control" name="status">
                        <option value="">Select</option>
                        <option @if (request('status', null) == 'received-in-china-warehouse') selected @endif value="received-in-china-warehouse">
                            Received
                            in china warehouse</option>
                        <option @if (request('status', null) == 'shipped-from-china-warehouse') selected @endif value="shipped-from-china-warehouse">
                            Shipped
                            from china warehouse</option>
                        <option @if (request('status', null) == 'received-in-BD-warehouse') selected @endif value="received-in-BD-warehouse">
                            Received in
                            BD warehouse </option>
                        <option @if (request('status', null) == 'delivered') selected @endif value="delivered">Delivered</option>
                    </select>

                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-outline-primary" style="margin-top:30px;" id="filter"
                        name="filter"><i class="fa fa-search"></i> Search</button>
                </div>
            </div>
        </div>

    </div>

</form>
