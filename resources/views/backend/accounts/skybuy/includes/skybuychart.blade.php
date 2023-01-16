<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <form class="search" name="search" method="GET">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="input-group">
                            <select class="form-control" name="recap_report">
                                <option value="">Recap Report</option>
                                <option @if (request('current_week', null) == 'current_week') selected @endif value="current_week">This Week
                                </option>
                                <option @if (request('current_month', null) == 'current_month') selected @endif value="current_month">This
                                    Month</option>
                                <option @if (request('current_year', null) == 'current_year') selected @endif value="current_year">This Year
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="input-group">
                            <select class="form-control" name="status">
                                <option value="">Status</option>
                                <option @if (request('status', null) == 'processing') selected @endif value="processing">Processing
                                </option>
                                <option @if (request('status', null) == 'on-hold') selected @endif value="on-hold">On Hold
                                </option>
                                <option @if (request('status', null) == 'purchased') selected @endif value="purchased">Purchase
                                    Completed
                                </option>
                                <option @if (request('status', null) == 're-order') selected @endif value="re-order">RE Order
                                </option>
                                <option @if (request('status', null) == 'Partial-Paid') selected @endif value="Partial-Paid">Partial
                                    Paid
                                </option>
                                <option @if (request('status', null) == 'refund-please') selected @endif value="refund-please">Refund
                                    Please
                                </option>
                                <option @if (request('status', null) == 'refunded') selected @endif value="refunded">Refunded
                                </option>
                                <option @if (request('status', null) == 'on-transit-to-customer') selected @endif
                                    value="on-transit-to-customer">On
                                    Transit To Customer</option>
                                <option @if (request('status', null) == 'delivered') selected @endif value="delivered">Delivered
                                </option>
                                <option @if (request('status', null) == 'out-of-stock') selected @endif value="out-of-stock">Out Of
                                    Stock
                                </option>
                                <option @if (request('status', null) == 'adjustment') selected @endif value="out-of-stock">
                                    Adjustment
                                </option>
                                <option @if (request('status', null) == 'refunded') selected @endif value="refunded">Refunded
                                </option>
                                <option @if (request('status', null) == 'delivery-after-holiday') selected @endif
                                    value="delivery-after-holiday">
                                    Delivery after holiday</option>

                                <option @if (request('status', null) == 'received-in-china-warehouse') selected @endif
                                    value="received-in-china-warehouse">
                                    Received in china
                                    warehouse</option>
                                <option @if (request('status', null) == 'shipped-from-china-warehouse') selected @endif
                                    value="shipped-from-china-warehouse">Shipped from china
                                    warehouse</option>
                                <option @if (request('status', null) == 'received-in-BD-warehouse') selected @endif
                                    value="received-in-BD-warehouse">
                                    Received in BD warehouse
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="input-group">
                            <input type="date" id="startdate" class="form-control" name="from_date"
                                value="{{ request('from_date', null) ? date('Y-m-d', strtotime(request('from_date', null))) : '' }}">
                            <input type="date" id="to_date" name="to_date" class="form-control"
                                value="{{ request('to_date', null) ? date('Y-m-d', strtotime(request('to_date', null))) : '' }}">
                        </div>
                    </div>

                    <div class="col-md-1">
                        <div class="input-group">
                            <button type="submit" id="filter" name="filter"
                                class="btn btn-sm btn-primary form-control filter-form-submit"><i
                                    class="fa fa-search"></i> Search</button>
                        </div>
                    </div>

                </div>
            </form>

        </div>
        <div class="card-footer">
            <div class="row">
                <div class="col-sm-3 col-6">
                    <div class="description-block border-right">
                        <h5 class="description-header">{{ $totalcount ?? 0 }}</h5>
                        <span class="description-text">Total Items</span>
                    </div>
                    <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-3 col-6">
                    <div class="description-block border-right">
                        <h5 class="description-header">{{ round($products_value) ?? 0 }}</h5>
                        <span class="description-text">Products Value</span>
                    </div>
                </div>
                <div class="col-sm-3 col-6">
                    <div class="description-block border-right">
                        <h5 class="description-header">{{ round($bd_receive) ?? 0 }}</h5>
                        <span class="description-text">BD Receive</span>
                    </div>
                </div>
                <div class="col-sm-3 col-6">
                    <div class="description-block">
                        <h5 class="description-header">{{ round($bd_out) ?? 0 }}</h5>
                        <span class="description-text">BD out</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
