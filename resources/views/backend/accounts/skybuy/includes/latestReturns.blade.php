<div class="col-md-4">
    <div class="info-box mb-3 bg-warning">
        <span class="info-box-icon"><i class="fa fa-truck"></i></span>

        <div class="info-box-content">
            <span class="info-box-text">Deliverd</span>
            <span class="info-box-number">{{ $delivered }}</span>
        </div>
        <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
    <div class="info-box mb-3 bg-success">
        <span class="info-box-icon"><i class="fa fa-home"></i></span>

        <div class="info-box-content">
            <span class="info-box-text">Received in China Warehouse</span>
            <span class="info-box-number">{{ $received_in_china }}</span>
        </div>
        <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
    <div class="info-box mb-3 bg-danger">
        <span class="info-box-icon"><i class="fas fa fa-plane"></i></span>

        <div class="info-box-content">
            <span class="info-box-text">Shipped From China Warehouse</span>
            <span class="info-box-number">{{ $shipped_from_china }}</span>
        </div>
        <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
    <div class="info-box mb-3 bg-info">
        <span class="info-box-icon"><i class="fa fa-home"></i></span>

        <div class="info-box-content">
            <span class="info-box-text">Received In BD Warehouse</span>
            <span class="info-box-number">{{ $received_in_bd }}</span>
        </div>
        <!-- /.info-box-content -->
    </div>
</div>
