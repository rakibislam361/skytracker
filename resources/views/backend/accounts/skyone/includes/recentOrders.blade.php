<div class="col-md-6">
  <div class="card">
    <div class="card-header border-transparent">
      <h3 class="card-title">Latest Orders</h3>

      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse">
          <i class="fas fa-minus"></i>
        </button>
        <button type="button" class="btn btn-tool" data-card-widget="remove">
          <i class="fas fa-times"></i>
        </button>
      </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body p-0">
      <div class="table-responsive">
        <table class="table m-0">
          <thead>
            <tr>
              <th>Item Number</th>
              <th>Name</th>
              <th>Amount</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>00008175</td>
              <td>Touker Ahmed</td>
              <td>৳2328</td>
              <td><span class="badge badge-success">Shipped</span></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <div class="card-footer clearfix">
      <a href={{ route('admin.order.index') }} class="btn btn-sm btn-secondary float-right">View All Orders</a>
    </div>
  </div>
</div>