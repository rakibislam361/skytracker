@extends('backend.layouts.app')

@section('title', __('Manage Accounts'))

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h5 class="card-title">Monthly Recap Report</h5>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse">
            <i class="fas fa-minus"></i>
          </button>
          <div class="btn-group">
            <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">
              <i class="fas fa-wrench"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-right" role="menu">
              <a href="#" class="dropdown-item">Action</a>
              <a href="#" class="dropdown-item">Another action</a>
              <a href="#" class="dropdown-item">Something else here</a>
              <a class="dropdown-divider"></a>
              <a href="#" class="dropdown-item">Separated link</a>
            </div>
          </div>
          <button type="button" class="btn btn-tool" data-card-widget="remove">
            <i class="fas fa-times"></i>
          </button>
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <div class="row">
          <div class="col-md-8">
            <p class="text-center">
              <strong>Sales: 1 Jan, 2014 - 30 Jul, 2014</strong>
            </p>

            <div class="chart">
              <!-- Sales Chart Canvas -->
              <canvas id="salesChart" height="180" style="height: 180px;"></canvas>
            </div>
            <!-- /.chart-responsive -->
          </div>
          <!-- /.col -->

        </div>
        <!-- /.row -->
      </div>
      <!-- ./card-body -->
      <div class="card-footer">
        <div class="row">
          <div class="col-sm-2 col-6">
            <div class="description-block border-right">
              <h5 class="description-header">108</h5>
              <span class="description-text">Total Order</span>
            </div>
            <!-- /.description-block -->
          </div>
          <!-- /.col -->
          <div class="col-sm-2 col-6">
            <div class="description-block border-right">
              <h5 class="description-header">106</h5>
              <span class="description-text">Delivered</span>
            </div>
            <!-- /.description-block -->
          </div>
          <!-- /.col -->
          
          <!-- /.col -->
          <div class="col-sm-2 col-6">
            <div class="description-block border-right">
              <h5 class="description-header">2</h5>
              <span class="description-text">Pending</span>
            </div>
            <!-- /.description-block -->
          </div>
          <div class="col-sm-2 col-6">
            <div class="description-block border-right">
              <h5 class="description-header">2</h5>
              <span class="description-text">Received</span>
            </div>
            <!-- /.description-block -->
          </div>
           <div class="col-sm-2 col-6">
            <div class="description-block border-right">
              <h5 class="description-header">0</h5>
              <span class="description-text">Processing</span>
            </div>
            <!-- /.description-block -->
          </div>
          <!-- /.col -->
          
          <div class="col-sm-2 col-6">
            <div class="description-block">
              <h5 class="description-header">0</h5>
              <span class="description-text">Waiting For Payment</span>
            </div>
            <!-- /.description-block -->
          </div>
        </div>
        <!-- /.row -->
      </div>
      <!-- /.card-footer -->
    </div>
    <!-- /.card -->
  </div>
  <!-- /.col -->
</div>
<div class="row">
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
              <tr>
                <td>00008176</td>
                <td>Ahmed</td>
                <td>৳228</td>
                <td><span class="badge badge-danger">Pending</span></td>
              </tr>
              <tr>
                <td>00008175</td>
                <td>Touker</td>
                <td>৳2328</td>
                <td><span class="badge badge-success">Processing</span></td>
              </tr>
              <tr>
                <td>00008175</td>
                <td>Touker Ahmed</td>
                <td>৳2328</td>
                <td><span class="badge badge-success">Delivered</span></td>
              </tr>
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
              <tr>
                <td>17/11/2022</td>
                <td>Id#123</td>
                <td>1</td>
                <td><span class="badge badge-success">Deliverd</span></td>
              </tr>
              <tr>
                <td>17/11/2022</td>
                <td>Id#123</td>
                <td>1</td>
                <td><span class="badge badge-danger">Pending</span></td>
              </tr>
              <tr>
                <td>17/11/2022</td>
                <td>Id#123</td>
                <td>1</td>
                <td><span class="badge badge-success">Received</span></td>
              </tr>
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
</div>

<div class="card">
  <div class="card-header">
    @lang('Manage Account')
  </div>
  <div class="card-body">
    <livewire:backend.products-table />
  </div>
</div>

{{-- <x-backend.card>
  <x-slot name="header">
    @lang('Manage Account')
  </x-slot>
  <x-slot name="body">
    <livewire:backend.products-table />
  </x-slot>
</x-backend.card> --}}

@endsection