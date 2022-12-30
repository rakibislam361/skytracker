<div class="table-responsive">
    <table class="table table-hover table-bordered mb-0 order-table table-striped" id="tableSelected">
        <thead>
            <tr>
                {{-- <th class="align-content-center text-center">Select<input type="checkbox" id="allSelectCheckbox" name="allSelectCheckbox" id="checkAllorder"></th> --}}
                <th class="align-content-center text-center">Date</th>
                <th class="align-content-center text-center">Item Number</th>
                <th class="align-content-center text-center">Order ID</th>
                @if ($logged_in_user->hasAllAccess())
                    <th class="align-content-center text-center">Customer</th>
                    <th class="align-content-center text-center">Phone </th>
                @endif
                @if ($logged_in_user->can('admin.order.order_rmb.edit'))
                    <th class="align-content-center text-center">Order RMB</th>
                    {{-- bd officer --}}
                @endif

                @if ($logged_in_user->can('admin.order.purchase.edit'))
                    {{-- china purchase officer --}}
                    <th class="align-content-center text-center">Actual RMB</th>
                @endif

                @if ($logged_in_user->can('admin.order.localdelivery.edit'))
                    {{-- local delivery --}}
                    <th class="align-content-center text-center">China Local Delivery</th>
                @endif

                {{-- <th class="align-content-center text-center">Product Name</th> --}}
                <th class="align-content-center text-center">Products Value</th>
                <th class="align-content-center text-center">Warehouse Qty</th>
                <th class="align-content-center text-center">Carton Number</th>
                <th class="align-content-center text-center">CBM</th>
                <th class="align-content-center text-center">Shipped By</th>
                <th class="align-content-center text-center">Product Type</th>
                <th class="align-content-center text-center">Shipping From</th>
                <th class="align-content-center text-center">Shipping Mark</th>
                <th class="align-content-center text-center">Tracking Number</th>
                <th class="align-content-center text-center">Warehouse Weight</th>
                <th class="align-content-center text-center">Status</th>

                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr class="order-modal" data-value="{{ json_encode($order) }}">
                    {{-- <td class="align-content-center text-center"><input type="checkbox" class="checkboxItem" name="checkboxItem" id="checkboxItem" value={{ $order->id }}></td> --}}
                    <td class="align-content-center text-center">
                        {{ $order->created_at ? date('d/m/Y', strtotime($order->created_at)) : 'N/A' }}
                    </td>
                    <td class="align-content-center text-center">{{ $order->order_item_number ?? 'N/A' }}</td>
                    <td class="align-content-center text-center">{{ $order->order_id ?? 'N/A' }}</td>

                    @if ($logged_in_user->hasAllAccess())
                        <td class="align-content-center text-center">{{ $order->user->name ?? 'N/A' }}</td>
                        <td class="align-content-center text-center"> {{ $order->user->phone ?? 'N/A' }} </td>
                    @endif

                    @if ($logged_in_user->can('admin.order.order_rmb.edit'))
                        <td class="align-content-center text-center">{{ $order->order_item_rmb ?? '' }}</td>
                    @endif

                    @if ($logged_in_user->can('admin.order.purchase.edit'))
                        <td class="align-content-center text-center">{{ $order->purchase_rmb ?? '' }}</td>
                    @endif

                    @if ($logged_in_user->can('admin.order.localdelivery.edit'))
                        <td class="align-content-center text-center">{{ $order->china_local_delivery_rmb ?? '' }}
                        </td>
                    @endif

                    {{-- <td class="align-content-center text-center">{{ $order->name ?? 'N/A' }}</td> --}}
                    <td class="align-content-center text-center">{{ $order->product_value ?? 'N/A' }}</td>
                    <td class="align-content-center text-center">{{ $order->chn_warehouse_qty ?? '' }}</td>
                    <td class="align-content-center text-center">{{ $order->carton_id ?? '' }}</td>
                    <td class="align-content-center text-center">{{ $order->cbm ?? '' }}</td>
                    <td class="align-content-center text-center">{{ $order->shipped_by ?? '' }}</td>
                    <td class="align-content-center text-center">{{ $order->product_type ?? '' }}</td>
                    <td class="align-content-center text-center">{{ $order->shipping_from ?? '' }}</td>
                    <td class="align-content-center text-center">{{ $order->shipping_mark ?? '' }}</td>
                    <td class="align-content-center text-center">{{ $order->tracking_number ?? '' }}</td>
                    <td class="align-content-center text-center">{{ $order->chn_warehouse_weight ?? '' }}</td>
                    <td class="align-content-center text-center">{{ $order->status ?? '' }}</td>
                    <td class="align-content-center text-center"><a>Edit</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="mt-4">
    {{ $orders->links() }}
</div>
