@php
    $acc = [];
    $totalcount = 0;
    $waiting = 0;
    $processing = 0;
    $delivered = 0;
    $purchased = 0;
    $pending = 0;
    foreach ($accounts as $data) {
        $acc[] = $data;
        $count = count($acc);
        $totalcount += $count;
    }
    foreach ($accounts as $data) {
        if ($data->status == 'Waiting for Payment') {
            $acc[] = $data;
            $count = count($acc);
            $waiting += $count;
        }
    }
    foreach ($accounts as $data) {
        if ($data->status == 'processing') {
            $acc[] = $data;
            $count = count($acc);
            $processing += $count;
        }
    }
    foreach ($accounts as $data) {
        if ($data->status == 'delivered') {
            $acc[] = $data;
            $count = count($acc);
            $delivered += $count;
        }
    }
    foreach ($accounts as $data) {
        if ($data->status == 'purchased') {
            $acc[] = $data;
            $count = count($acc);
            $purchased += $count;
        }
    }
    foreach ($accounts as $data) {
        if ($data->status == 'on-hold') {
            $acc[] = $data;
            $count = count($acc);
            $pending += $count;
        }
    }
@endphp
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">SkyBuy Recap Report</h5>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    <p class="text-center">
                        <strong>Sales: 1 Jan, 2014 - 30 Jul, 2014</strong>
                    </p>
                    <div class="chart">
                        <canvas id="salesChart" height="180" style="height: 180px;"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="row">
                <div class="col-sm-2 col-6">
                    <div class="description-block border-right">
                        <h5 class="description-header">{{ $totalcount }}</h5>
                        <span class="description-text">Total Order</span>
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
