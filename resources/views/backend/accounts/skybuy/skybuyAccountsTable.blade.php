@extends('backend.layouts.app')

@section('title', __('Account Table'))

@section('content')
@include('backend.accounts.includes.acc_filter')
<div class="card">
        <div class="table-responsive">
          <table class="table m-0">
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
                <td>BD Receive=(chinaLocal*Conversion)+product Cost</td>
                <td>BD Out=actual Rmb*Conversion Rate From track</td>
                <td><span class="badge badge-success">Shipped</span></td>
                <td>BD Receive-BD Out</td>               
                <td><a href="#" class="btn btn-secondary btn-sm"><i class="fa fa-file"></i></a></td>
              </tr>
            </tbody>
          </table>
        </div>
     </div>

@endsection