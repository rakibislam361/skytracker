{{-- @dd('hi') --}}
@extends('backend.layouts.app')
@section('title', __('_search'))
@section('content')
@include('backend.content.order.includes.filter')    
   
@forelse($all_orders ?? '' ?? '' as $order)
<div class="card">
 <<div class="table-responsive">
            <table class="table table-hover table-bordered mb-0 order-table">
                <thead>
                    <tr>
                        <th class="align-content-center text-center">Date</th>

                        <th class="align-content-center text-center">Item Number</th>

                        <th class="align-content-center text-center">Order ID</th>

                        @if ($logged_in_user->hasAllAccess() || $logged_in_user->can('admin.order.order_rmb.edit'))
                        <th class="align-content-center text-center">Order(rmb)</th>
                        {{-- bd officer --}}
                        @endif
                        @if ($logged_in_user->hasAllAccess())
                        <th class="align-content-center text-center">Customer</th>

                        <th class="align-content-center text-center">Phone </th>
                        @endif

                        @if ($logged_in_user->hasAllAccess() || $logged_in_user->can('admin.order.purchase.edit'))
                        {{-- china purchase officer --}}
                        <th class="align-content-center text-center">Product Purchase Cost(Actual Cost)</th>
                        @endif

                        @if ($logged_in_user->hasAllAccess() || $logged_in_user->can('admin.order.localdelivery.edit'))
                        {{-- local delivery --}}
                        <th class="align-content-center text-center">China Local Delivery</th>
                        @endif

                        <th class="align-content-center text-center">Product Name</th>

                        <th class="align-content-center text-center">Quantity</th>

                        <th class="align-content-center text-center">Carton Number</th>

                        <th class="align-content-center text-center">CBM</th>

                        <th class="align-content-center text-center">Shipped By</th>

                        <th class="align-content-center text-center">Tracking Number</th>

                        <th class="align-content-center text-center">Weight</th>

                        <th class="align-content-center text-center">Status</th>

                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach ($all_orders ?? '' as $order)
                    <tr onclick="orderModal({{ json_encode($order) }})">

                        <td class="align-content-center text-center">
                            {{ $order->created_at ? date('d/m/Y', strtotime($order->created_at)) : 'N/A' }}
                        </td>

                        <td class="align-content-center text-center">item Number</td>
                        <td class="align-content-center text-center">{{ $order->order_number }}</td>
                        @if ($logged_in_user->hasAllAccess() || $logged_in_user->can('admin.order.order_rmb.edit'))
                        <td class="align-content-center text-center">order rmb</td>
                        @endif
                        @if ($logged_in_user->hasAllAccess())
                        <td class="align-content-center text-center">{{ $order->name }}</td>
                        <td class="align-content-center text-center"> {{ $order->phone }} </td>
                        @endif

                        @if ($logged_in_user->hasAllAccess() || $logged_in_user->can('admin.order.purchase.edit'))
                        <td class="align-content-center text-center">actual cost</td>
                        @endif

                        @if ($logged_in_user->hasAllAccess() || $logged_in_user->can('admin.order.localdelivery.edit'))
                        <td class="align-content-center text-center">ch local delivery</td>
                        @endif
                        <td class="align-content-center text-center">New style sunglasses European and American
                            fashion</td>

                        <td class="align-content-center text-center">qty</td>

                        <td class="align-content-center text-center">carton no</td>

                        <td class="align-content-center text-center">cbm</td>

                        <td class="align-content-center text-center">shipped By</td>

                        <td class="align-content-center text-center">tracking no</td>

                        <td class="align-content-center text-center">weight</td>

                        <td class="align-content-center text-center">{{ $order->status }}</td>

                        <td class="align-content-center text-center"><a>Edit</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{-- {{ $all_orders ?? ''->links() }} --}}
        </div>

 

            @empty
            <table class="table table-striped table-hover table-bordered mb-0">
              <tr>
                <td>
                  <h3 style="margin-left: 30%">Sorry!!! Nothing Found</h3>
                </td>
              </tr>
            </table>

            @endforelse

          </div>

          {{-- search product details and status end   --}}

  <!--row-->
</div>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>

<script>
    function orderModal(data) {
        // console.log(data);
      $("#changeStatusButton").modal('show');
            $('#ItemNo').val(data.order_number);// order_number will replaced by item_number
            
    }
</script>
@endsection