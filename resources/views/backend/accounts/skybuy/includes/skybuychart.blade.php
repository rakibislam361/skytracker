<div class="col-md-12">
    <div class="card">

        {{-- <h5 class="d-inline-block mr-2">SkyBuy Report</h5>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                </button>
            </div> --}}
        <div class="card-header">
            <form method="GET" id="filterForm">
                <div class="row">
                    <div class="col-6">
                        <div class="input-group">
                            <button type="button" id="thisWeek" value="thisWeek"
                                class="form-control btn btn-secondary">This
                                Week</button>
                            <button type="button" id="thisMonth" value="thisMonth"
                                class="form-control btn btn-secondary">This
                                Month</button>
                            <button type="button" id="thisYear" value="thisYear"
                                class="form-control btn btn-secondary">This
                                Year</button>
                            <button type="button" id="LastYear" value="LastYear"
                                class="form-control btn btn-secondary">Last
                                Year</button>
                        </div>
                    </div>

                    <div class="col-2">
                        <div class="input-group">
                            <select name="status" id="status" class="form-control">
                                <option selected="" value="Waiting-for-Payment">Waiting for Payment</option>
                                <option value="Partial-Paid">Partial Paid</option>
                                <option value="on-hold">On Hold</option>
                                <option value="processing">Processing</option>
                                <option value="purchased">Purchased Complete</option>
                                <option value="shipped-from-suppliers">shipped-from-suppliers</option>
                                <option value="received-in-china-warehouse">received-in-china-warehouse</option>
                                <option value="shipped-from-china-warehouse">shipped-from-china-warehouse
                                </option>
                                <option value="received-in-BD-warehouse">received-in-BD-warehouse</option>
                                <option value="on-transit-to-customer">on-transit-to-customer</option>
                                <option value="delivered">delivered</option>
                                <option value="out-of-stock">out-of-stock</option>
                                <option value="adjustment">adjustment</option>
                                <option value="refunded">refund</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="input-group">
                            <input name="from-date" id="from-date" class="form-control" placeholder="From Date"
                                onfocus="(this.type='date')">
                            <input name="end-date" id="to-date" class="form-control" placeholder="To Date"
                                onfocus="(this.type='date')">
                        </div>
                    </div>

                    <div class="col-1">
                        <div class="input-group">
                            <button type="button" class="btn btn-sm btn-primary form-control filter-form-submit"><i
                                    class="fa fa-search"></i> Search</button>
                        </div>
                    </div>

                </div>
            </form>

        </div>
        <div class="card-footer">
            <div class="row">
                <div class="col-sm-2 col-6">
                    <div class="description-block border-right">
                        <h5 class="description-header">{{ $totalcount }}</h5>
                        <span class="description-text">Total Items</span>
                    </div>
                    <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-2 col-6">
                    <div class="description-block border-right">
                        <h5 class="description-header">{{ $delivered }}</h5>
                        <span class="description-text">Delivered</span>
                    </div>
                </div>
                <div class="col-sm-2 col-6">
                    <div class="description-block border-right">
                        <h5 class="description-header">{{ $pending }}</h5>
                        <span class="description-text">On Hold</span>
                    </div>
                </div>
                <div class="col-sm-2 col-6">
                    <div class="description-block border-right">
                        <h5 class="description-header">{{ $purchased }}</h5>
                        <span class="description-text">Purchased</span>
                    </div>
                </div>
                <div class="col-sm-2 col-6">
                    <div class="description-block border-right">
                        <h5 class="description-header">{{ $processing }}</h5>
                        <span class="description-text">Processing</span>
                    </div>
                </div>
                <div class="col-sm-2 col-6">
                    <div class="description-block">
                        <h5 class="description-header">{{ $waiting }}</h5>
                        <span class="description-text">Waiting For Payment</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
