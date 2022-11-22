@extends('backend.layouts.app')

@section('title', 'Recent Orders')

@section('content')
@php
$status = request('status');
$allOrdersCount = $orders ? $orders : null;
$partialCount = $orders ? $orders->where('status', 'Partial Paid') : null;
$onHold = $orders ? $orders->where('status', 'on-hold') : null;
$icompleteCount = $orders ? $orders->where('status', 'Waiting for Payment') : null;
$refundedCount = $orders ? $orders->where('status', 'refunded') : null;
$processingCount = $orders ? $orders->where('status', 'processing') : null;
$purchasedCount = $orders ? $orders->where('status', 'purchased') : null;
@endphp
<div class="card">
  <div class="card-header">
    <h5 class="d-inline-block mr-2">@lang('Recent Orders')</h5>
    <div class="status-control">
      <a href="{{ route('admin.order.index') }}" class="@if(!$status) active @endif">
        @lang('All Orders') ({{$allOrdersCount}})
      </a>
      <a href="{{ route('admin.order.index', ['status' => 'Partial Paid']) }}"
        class="@if($status == 'Partial Paid') active @endif">
        @lang('Partial Paid') ({{$partialCount}})
      </a>
      <a href="{{ route('admin.order.index', ['status' => 'on-hold']) }}"
        class="@if($status == 'on-hold') active @endif">
        @lang('On Hold') ({{$onHold}})
      </a>
      <a href="{{ route('admin.order.index', ['status' => 'Waiting for Payment']) }}"
        class="@if($status == 'Waiting for Payment') active @endif">
        @lang('Incomplete') ({{$icompleteCount}})
      </a>
      <a href="{{ route('admin.order.index', ['status' => 'refunded']) }}"
        class="@if($status == 'refunded') active @endif">
        @lang('Refunded') ({{$refundedCount}})
      </a>
      <a href="{{ route('admin.order.index', ['status' => 'processing']) }}"
        class="@if($status == 'processing') active @endif">
        @lang('Processing') ({{$processingCount}})
      </a>
      <a href="{{ route('admin.order.index', ['status' => 'purchased']) }}"
        class="@if($status == 'purchased') active @endif">
        @lang('Purchased') ({{$purchasedCount}})
      </a>
      @hasrole('administrator')
      <a href="{{ route('admin.order.index', ['status' => 'trashed']) }}"
        class="@if($status == 'trashed') active @endif">
        @lang('Trashed Orders') ({{$trashedOrders}})
      </a>
      @endhasrole
      {{-- <a href="{{ route('admin.export', 'orders') }}">
        @lang('Export order Table')
      </a> --}}
    </div>
  </div>
  <div class="card-body">
    <div class="table-responsive">
        <table class="table table-hover table-bordered mb-0">
          <thead>
            <tr>
              <th>Date</th>
               <th>Customer</th>
               <th>CustomerPhone </th>
               <th>Order ID</th>
               <th>Product Name</th>
               <th>TransactionNo</th>
               <th>Item Number</th>              
               <th>Quantity</th>
               <th>Shipped By</th>
               <th>Order(rmb)</th>
               <th>China Local Delivery</th>
               <th>Product Cost</th>
               <th>Product Purchase Cost</th>
               <th>Tracking Number</th>
               <th>Rate</th>
               <th>Weight</th>
               <th>Amount</th>
                <th>Status</th>
               <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr data-toggle="modal" data-dismiss="modal" data-target="#changeStatusButton" href="#changeStatusButton">
               <td>17-Nov-2022</td>
               <td>Touker Ahmed</td>
               <td> 012345678900 </td>
               <td>00003018</td>
               <td>Men's Martin Boots</td>
               <td>0000780</td>
               <td>00008109</td>              
               <td>9</td>
               <td>ship_by_air</td>
               <td>20</td>
               <td>60</td>
               <td>460</td>
               <td>18</td>              
               <td>300</td>
               <td>4kg</td>
               <td>1200</td>
               <td>0000</td>
               <td>delivered</td>
               <td>
                <a data-toggle="modal" data-dismiss="modal" data-target="#changeStatusButton" href="#changeStatusButton">Edit</a>                 
               </td>
              </tr>
          </tbody>
        </table>                     
      </div>

    {{-- @livewire('order-table', ['statuss' => $status]) --}}
  </div> <!-- card-body-->
</div> <!-- card-->


<!-- Modal -->
{{-- @include('backend.content.order.includes.status-modal') --}}



<!-- Modal -->
 <div class="modal fade" id="changeStatusButton" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form method="POST" action="{{ route('admin.order.store') }}" id="statusChargeForm">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Change Status <span class="orderId"></span>
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
{{-- BD Purchase Officer start--}}

                      <div class="form-group">
                        <label for="itemNO">Item Number</label>
                        <input type="text" name="itemNO" value=00008109 required="" placeholder="item number" class="form-control" />
                      </div>

                      <div class="form-group">
                        <label for="orderRmb">Order(rmb)</label>
                        <input type="text" name="orderRmb" required="" placeholder="Order in Rmb" class="form-control" />
                      </div>

                      <div class="form-group">
                        <label for="chinaLocal">China Local Delivery</label>
                        <input type="text" name="chinaLocal" required="" placeholder="China Local Delivery" class="form-control" />
                      </div>
                          
                      <div class="form-group">
                        <label for="productCost">Product cost in BDT</label>
                        <input type="text" name="productCost" required="" placeholder="OrderRmb * Conversion Rate" class="form-control" />
                      </div>

                      <div class="form-group">
                        <label for="bdReceive">BD Received Cost</label> {{-- calculate product cost + china local delivery --}}
                        <input type="text" name="bdReceive" required="" placeholder="BD Received Cost" class="form-control" />
                      </div>
{{-- BD Purchase Officer end --}}


{{-- China Purchase Officer start--}}
                      <div class="form-group">
                        <label for="purchaseCost">Actual Cost(purchase cost)</label>
                        <input type="text" name="purchaseCost" required="" placeholder="Actual Cost" class="form-control" />
                      </div>
                        <div class="form-group">
                              <label for="status">Status</label>
                              <select class="form group dropdown-item border" name="status">
                              <option value=""></option>
                              <option value="purchased">Purchased</option>
                              <option value="noStock">Out of stock</option>
                              <option value="delivered">Delivered</option>
                              <option value="refund">Refund</option>
                              <option value="received">Received</option>
                            </select>
                          </div>
 {{-- China Purchase Officer end--}}     
 
 {{-- China Warehouse start--}}
                      <div class="form-group">
                        <label for="productName">Product Name</label>
                        <input type="text" name="productName" value="Men's Martin Boots" required="" placeholder="Product Name" class="form-control" />
                      </div>

                      <div class="form-group">
                        <label for="quantity">Quantity</label>
                        <input type="text" name="quantity" required="" placeholder="Quantity" class="form-control" />
                      </div>

                      <div class="form-group">
                        <label for="weight">Weight</label>
                        <input type="text" name="weight" required="" placeholder="Weight" class="form-control" />
                      </div>

                      <div class="form-group">
                        <label for="cartonId">Carton ID</label>
                        <input type="text" name="cartonId" required="" placeholder="Carton Id" class="form-control" />
                      </div>

                      <div class="form-group">
                        <label for="trackingId">Tracking ID</label>
                        <input type="text" name="trackingId" placeholder="Tracking Id" class="form-control" />
                      </div>

                      <div class="form-group">
                          <label for="status">Shipping Method</label>
                            <select class="form group dropdown-item border" name="status">
                              <option value=""></option>
                              <option value="guangzhou">Guangzhou</option>
                              <option value="hongkong">Hong Kong</option>
                            </select>
                      </div>

                          <div class="form-group">
                            <label for="status">Shipping Status</label>
                            <select class="form group dropdown-item border" name="status">
                              <option value=""></option>
                              <option value="air">By Air</option>
                              <option value="sea">By Sea</option>
                            </select>
                          </div>
 {{-- China Warehouse END--}}

  {{-- BD Logistic Officer start--}}
{{-- product name, quantity, weight, carton Id --}}
                        
                      <div class="form-group">
                        <label for="shipRate">Shipping Rate</label>
                        <input type="text" name="shipRate" required="" placeholder="Shipping Rate" class="form-control" />
                      </div>

                       <div class="form-group">
                        <label for="shipamount">Amount</label>
                        <input type="text" name="shipamount" required="" placeholder="Shipping Rate * Weight" class="form-control" />
                      </div>
{{-- BD Logistic Officer END--}}

                         <div class="form-group form-check">
                            <input type="checkbox" name="notify" value="1" class="form-check-input" id="notify"
                                checked="true">
                            <label class="form-check-label" for="notify">Notify User</label>
                         </div>

                      </div>
                      <div class="modal-footer justify-content-between">
                        <button type="submit" class="btn btn-primary" id="statusSubmitBtn">Save changes</button>
                      </div>
                </form>
            </div>
      </div>
  </div> <!-- changeStatusButton -->


    {{-- @include('backend.content.order.wallet.includes.generate-modal') --}}


@endsection


{{-- @push('before-styles')
    {{ style('assets/plugins/select2/css/select2.min.css') }} --}}
    {{-- {{style('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}} --}}
{{-- @endpush

@push('after-styles')
    @livewireStyles
@endpush

@push('middle-scripts')
    {{ script('assets/plugins/select2/js/select2.full.min.js') }}
    @livewireScripts

    {!! script('assets/js/manage-wallet.js') !!}
@endpush --}}

<script>
    $(document).ready(function() {
        $('#changeStatusButton').modal('show');
    });
</script>
