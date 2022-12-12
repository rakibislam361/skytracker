@extends('backend.layouts.app')

@section('title', __('Account Table'))

@section('content')
<div class="card">
  <div class="card-header">
    <a href="skyonetable" style="color: black;">
      <h5 class="d-inline-block mr-2">@lang('SkyOne Account')</h5>
    </a>
    @include('backend.accounts.includes.acc_filter')
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-hover table-bordered mb-0 table-striped">
        <thead>
          <tr>
            <th>Date</th>
            <th>Item Number</th>
            <th>BD Receive</th>
            <th>BD Out</th>
            <th>Status</th>
            <th>Profit/Loss</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>12/12/22</td>
            <td>000122</td>
            <td>BD Receive=BDT Received From Customer</td>
            <td>BD Out=purchase_cost_bd</td>
            <td><span class="badge badge-success">Shipped</span></td>
            <td>BD Receive-BD Out</td>
            <td><a href="#" class="btn btn-secondary btn-sm"><i class="fa fa-file"></i></a></td>
          </tr>
        </tbody>
      </table>
    </div>

  </div> <!-- card-body-->
</div>

@endsection