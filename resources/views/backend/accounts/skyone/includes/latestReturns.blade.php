<div class="col-md-6">
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Latest Returns</h3>

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
              <th>Date</th>
              <th>Id</th>
              <th>Number</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>17/11/2022</td>
              <td>Id#123</td>
              <td>1</td>
              <td><span class="badge badge-success">Shipped</span></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <div class="card-footer text-center">
      <a href={{ route('admin.order.index') }} class="uppercase">View All</a>
    </div>
  </div>
</div>