@extends('backend.layouts.app')

@section('title', __('Account Table'))

@section('content')

<div class="card">
  <div class="card-header">
    <a href="skybuytable" style="color: black;">
      <h5 class="d-inline-block mr-2">@lang('SkyBuy Account')</h5>
    </a>

    <a href="{{ route('admin.account.skybuy') }}" class="btn btn-sm btn-secondary float-right" data-toggle="tooltip" title="SkyBuy Dashboard">
      <i class="fa fa-arrow-left"></i>
    </a>
    @include('backend.accounts.includes.acc_filter')
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-hover table-bordered mb-0 table-striped">
        <thead>
          <tr>
            <th class="align-content-center text-center">Date</th>
            <th class="align-content-center text-center">Item Number</th>
            <th class="align-content-center text-center">Customer</th>
            <th class="align-content-center text-center">BD Receive</th>
            <th class="align-content-center text-center">BD Out</th>
            <th class="align-content-center text-center">Status</th>
            <th class="align-content-center text-center">Profit/Loss</th>
            <th class="align-content-center text-center">Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="align-content-center text-center">12/12/22</td>
            <td class="align-content-center text-center">000122</td>
            <td class="align-content-center text-center">Name of Customer</td>
            <td class="align-content-center text-center">BD Receive=BDT Received From Customer</td>
            <td class="align-content-center text-center">BD Out=purchase_cost_bd</td>
            <td class="align-content-center text-center"><span class="badge badge-success">Shipped</span></td>
            <td class="align-content-center text-center">BD Receive-BD Out</td>
            <td class="align-content-center text-center"><a href="#" class="btn btn-secondary btn-sm"><i class="fa fa-file"></i></a></td>
          </tr>
        </tbody>
      </table>
    </div>

  </div> <!-- card-body-->
</div>





@endsection