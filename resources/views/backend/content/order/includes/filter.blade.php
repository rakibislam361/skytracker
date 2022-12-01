<form class="search" name="search" action="{{ route('admin.order.search') }}" method="GET">
            <div class="row">
                <div class="col-3">
                    <label for="itemNO">Item</label>
                    <input type="text" id="itemNO" name="itemNO" class="form-control" placeholder="item number">
                </div>

                <div class="col-2">
                    <label for="status">Status</label>
                    <select class="form-control" id="status" name="status">
                        <option value="">Select</option>
                        <option value="purchased">Purchased</option>
                        <option value="noStock">Out of stock</option>
                        <option value="delivered">Delivered</option>
                        <option value="refund">Refund</option>
                        <option value="received">Received</option>
                        <option value="receivechina">Received in china warehouse</option>
                        <option value="shipchina">Shipped from china Warehouse</option>
                        <option value="receiveBD">Received in BD warehouse</option>
                    </select>
                </div>

                <div class="col-3">
                    <label for="date">From date</label>
                    <input type="date" id="startdate" class="form-control" name="startdate">
                </div>

                <div class="col-4">
                    <div class="row">
                        <div class="col-8">
                            <label for="date">To Date</label>
                            <input type="date" id="enddate" name="enddate" class="form-control">
                        </div>
                        <div class="col-4">
                            <button type="submit" class="btn btn-outline-primary" style="margin-top:29px;" id="filter" name="filter"><i class="fa fa-search"></i> Search</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>