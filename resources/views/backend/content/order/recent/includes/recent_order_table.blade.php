   <div class="table-responsive">
       <table class="table table-hover table-bordered mb-0 order-table table-striped">
           <thead>
               <tr>
                   {{-- <th class="align-content-center text-center">Select<input type="checkbox" name="checkAllorder" id="checkAllorder"></th>  --}}
                   <th class="align-content-center text-center">Date</th>
                   {{-- <th class="align-content-center text-center">Item Number</th> --}}
                   <th class="align-content-center text-center">OrderNumber</th>
                   <th class="align-content-center text-center">TransactionNo</th>

                   {{-- @if ($logged_in_user->hasAllAccess()) --}}
                   <th class="align-content-center text-center">Customer</th>
                   <th class="align-content-center text-center">CustomerPhone</th>
                   {{-- @endif --}}

                   {{-- @if ($logged_in_user->can('admin.order.order_rmb.edit')) --}}
                   <th class="align-content-center text-center">Amount</th>
                   {{-- @endif --}}

                   {{-- @if ($logged_in_user->can('admin.order.purchase.edit')) --}}
                   <th class="align-content-center text-center">Coupon</th>
                   {{-- @endif --}}

                   {{-- @if ($logged_in_user->can('admin.order.localdelivery.edit')) --}}
                   <th class="align-content-center text-center">Paid</th>
                   {{-- @endif --}}

                   {{-- <th class="align-content-center text-center">Product Name</th> --}}
                   <th class="align-content-center text-center">Due</th>
                   <th class="align-content-center text-center">PaymentMethod</th>
                   <th class="align-content-center text-center">Status</th>

                   <th class="align-content-center text-center">Actions</th>
               </tr>
           </thead>
           <tbody>
               @if ($orders && count($orders) > 0)
                   @foreach ($orders as $order)
                       <tr>
                           {{-- <th class="align-content-center text-center"><input type="checkbox" class="checkoneItem" name="checkOrder" id="checkOrder"></th>  --}}
                           <td class="align-content-center text-center">
                               {{ $order->created_at ? date('d/m/Y', strtotime($order->created_at)) : 'N/A' }}
                           </td>
                           <td class="align-content-center text-center">{{ $order->order_number ?? 'N/A' }}</td>
                           <td class="align-content-center text-center">{{ $order->transaction_id ?? 'N/A' }}</td>

                           {{-- @if ($logged_in_user->hasAllAccess()) --}}
                           <td class="align-content-center text-center">{{ $order->name ?? 'N/A' }}</td>
                           <td class="align-content-center text-center">{{ $order->phone ?? 'N/A' }}</td>
                           {{-- @endif --}}

                           {{-- @if ($logged_in_user->can('admin.order.order_rmb.edit')) --}}
                           <td class="align-content-center text-center">{{ $order->amount ?? 'N/A' }}</td>
                           {{-- @endif --}}

                           {{-- @if ($logged_in_user->can('admin.order.purchase.edit')) --}}
                           <td class="align-content-center text-center">{{ $order->coupon_victory ?? 'N/A' }}</td>
                           {{-- @endif --}}

                           {{-- @if ($logged_in_user->can('admin.order.localdelivery.edit')) --}}
                           <td class="align-content-center text-center">{{ $order->needToPay ?? 'N/A' }}</td>
                           {{-- @endif --}}

                           <td class="align-content-center text-center">{{ $order->dueForProducts ?? 'N/A' }}</td>
                           <td class="align-content-center text-center">{{ $order->pay_method ?? 'N/A' }}</td>
                           <td class="status-modal align-content-center text-right" data-value="{{ $order->id }}"><i
                                   class="fa-pencil"></i>{{ $order->status ?? 'N/A' }}</td>
                           <td class="align-content-center text-center select"><a
                                   href="{{ route('admin.order.show', $order->order_number) }}">Details </a></td>
                       </tr>
                   @endforeach
               @endif
           </tbody>
       </table>
   </div>
   <div class="mt-4">
       @if ($orders && count($orders) > 0)
           {{ $orders->links() }}
       @endif
   </div>
