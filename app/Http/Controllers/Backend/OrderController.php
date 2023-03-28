<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Traits\ApiOrderTrait;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;
use App\Traits\PaginationTrait;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Content\OrderItem;

class OrderController extends Controller
{
    use ApiOrderTrait, PaginationTrait;

    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index(Request $request)
    {
        try {
            // $filter = [
            //     'item_number' => request('item_number', null),
            //     'carton_id' => request('carton_id', null),
            //     'customer' => request('customer', null),
            //     'status' => request('status', null),
            //     'shipping_from' => request('shipping_from', null),
            //     'from_date' => request('from_date', null),
            //     'to_date' => request('to_date', null),
            // ];
            $item_number = request('item_number', null);
            $carton = request('carton_id', null);
            $customer = request('customer', null);
            $status = request('status', null);
            $shipping_from = request('shipping_from', null);
            $from_date = request('from_date', null);
            $to_date = request('to_date', null);

            $ordersData = OrderItem::latest();
            if ($item_number) {
                $ordersData->where('id', $item_number);
            }
            if ($carton) {
                $ordersData->where('carton_id', 'like', '%' . ',' . '%' . $carton . '%' . ',' . '%')
                    ->orWhere('carton_id', 'like', '%' . $carton . '%')
                    ->orWhere('carton_id', 'like', '%' . ',' . '%' . $carton . '%')
                    ->orWhere('carton_id', 'like', '%' . $carton . '%' . ',' . '%');
            }

            if ($customer) {
                $ordersData->where('user_name', 'like', '%' . $customer . '%')
                    ->orWhere('phone', $customer)
                    ->orWhere('first_name', 'like', '%' . $customer . '%')
                    ->orWhere('last_name', 'like', '%' . $customer . '%');
            }
            if ($status) {
                $ordersData->where('status', $status);
            }
            if ($shipping_from) {
                $ordersData->where('shipping_from', $shipping_from);
            }
            if ($from_date && $to_date) {
                $ordersData->whereBetween('created_at', [$from_date, $to_date]);
            }
            $totalcount = count($ordersData->get());
            $totalweight = 0;
            $ordersData = $ordersData->get();
            $order = [];

            $userRole = auth()
                ->user()
                ->roles->first();
            $roles = $userRole ? $userRole->name : null;
            if ($roles == 'Administrator') {
                foreach ($ordersData as $data) {
                    $order[] = $data;
                    // dd($data);
                    if ($data->status == 'received-in-china-warehouse' || $data->status == 'shipped-from-china-warehouse' || $data->status == 'received-in-BD-warehouse') {
                        $totalweight += $data->actual_weight;
                    }
                }
            } else {
                foreach ($ordersData as $data) {
                    if ($data->status == 'received-in-china-warehouse' || $data->status == 'shipped-from-china-warehouse' || $data->status == 'received-in-BD-warehouse') {
                        $totalweight += $data->actual_weight;
                    }
                    if ($userRole->hasPermissionTo('admin.status.processing')) {
                        if ($data->status == 'processing' || $data->status == 'delivery-after-holiday') {
                            $order[] = $data;
                        }
                    }
                    if ($userRole->hasPermissionTo('admin.status.waiting-for-payment')) {
                        if ($data->status == 'Waiting for Payment') {
                            $order[] = $data;
                        }
                    }
                    if ($userRole->hasPermissionTo('admin.status.on-hold')) {
                        if ($data->status == 'on-hold') {
                            $order[] = $data;
                        }
                    }
                    if ($userRole->hasPermissionTo('admin.status.partial-paid')) {
                        if ($data->status == 'partial-paid') {
                            $order[] = $data;
                        }
                    }
                    if ($userRole->hasPermissionTo('admin.status.pending-to-pay')) {
                        if ($data->status == 'pending-to-pay') {
                            $order[] = $data;
                        }
                    }
                    if ($userRole->hasPermissionTo('admin.status.purchased')) {
                        if ($data->status == 'purchased') {
                            $order[] = $data;
                        }
                    }
                    if ($userRole->hasPermissionTo('admin.status.re-order')) {
                        if ($data->status == 're-order') {
                            $order[] = $data;
                        }
                    }
                    if ($userRole->hasPermissionTo('admin.status.refund')) {
                        if ($data->status == 'refunded' || $data->status == 'refund-please') {
                            $order[] = $data;
                        }
                    }
                    if ($userRole->hasPermissionTo('admin.status.shipped-from-suppliers')) {
                        if ($data->status == 'shipped-from-suppliers') {
                            $order[] = $data;
                        }
                    }
                    if ($userRole->hasPermissionTo('admin.status.received-in-chinawarehouse')) {
                        if ($data->status == 'received-in-china-warehouse') {
                            $order[] = $data;
                        }
                    }
                    if ($userRole->hasPermissionTo('admin.status.shipped-from-chinawarehouse')) {
                        if ($data->status == 'shipped-from-china-warehouse') {
                            $order[] = $data;
                        }
                    }
                    if ($userRole->hasPermissionTo('admin.status.received-in-bdwarehouse')) {
                        if ($data->status == 'received-in-BD-warehouse') {
                            $order[] = $data;
                        }
                    }
                    if ($userRole->hasPermissionTo('admin.status.delivered')) {
                        if ($data->status == 'delivered') {
                            $order[] = $data;
                        }
                    }
                }
            }
            $orders = $this->paginate($order, 50)->withQueryString();
            $orders->withPath('');

            return view('backend.content.order.index', compact('orders', 'totalcount', 'order', 'totalweight'));
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withFlashError('server error');
        }
    }

    public function update($id)
    {
        $data = $this->validateOrderItems();
        $id = request()->order_item_id;
        $update = OrderItem::findOrFail($id);
        if (request()->chn_warehouse_weight) {
            $data['chn_warehouse_weight'] = implode(',', request()->chn_warehouse_weight);
        }
        if (request()->tracking_number) {
            $data['tracking_number'] = implode(',', request()->tracking_number);
        }

        if (request()->carton_id) {
            $data['carton_id'] = implode(',', request()->carton_id);
        }

        if (request()->chn_warehouse_qty) {
            $data['chn_warehouse_qty'] = implode(',', request()->chn_warehouse_qty);
        }

        if (array_key_exists('chinaLocalDelivery', $data)) {
            if ($data['chinaLocalDelivery'] == 0 || $data['chinaLocalDelivery'] == null) {
                unset($data['chinaLocalDelivery']);
            }
        }

        unset($data['shipping_charge'], $data['quantity'], $data['product_value'], $data['first_payment']);

        if ($data['order_update'] == 'withoutajax') {
            unset($data['order_update']);
            if ($update) {
                unset($data['order_item_id']);
                $update->update($data);
            }
            $data['order_item_id'] = request()->order_item_id;
            $orderResponse = $this->order_update($data);
            if (!($orderResponse = null)) {
                return redirect()
                    ->back()
                    ->withFlashSuccess('Order Updated Successfully');
            } else {
                return redirect()
                    ->back()
                    ->withFlashError('Error');
            }
        }

        if ($data['order_update'] == null) {
            unset($data['order_update']);
            if ($update) {
                unset($data['order_item_id']);
                $update->update($data);
            }
            $data['order_item_id'] = request()->order_item_id;
            // $update->update($data);
            $orderResponse = $this->order_update($data);
            return $orderResponse;
        }
    }

    public function itemStatusUpdate()
    {
        $order_items_id = request('order_item_id', []);
        $status = request('status', null);
        // dd($order_items_id);

        $orderResponse = $this->order_item_status_update($status, $order_items_id);
        foreach ($order_items_id as $data) {
            $update = OrderItem::findOrFail($data);
            $update->status = $status;
            $update->save();
        }
        if ($orderResponse && $update) {
            return redirect()
                ->back()
                ->withFlashSuccess('Items Status Updated Successfully');
        } else {
            return redirect()
                ->back()
                ->withFlashError('Error');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|Response
     */

    public function recentOrders()
    {
        try {
            $filter = [
                'order_number' => request('order_number', null),
                'status' => request('status', null),
                'from_date' => request('from_date', null),
                'to_date' => request('to_date', null),
            ];

            $receivedData = $this->recentorderList($filter);
            $ordersData = $receivedData->data->result;
            $totalcount = $ordersData->total;
            $amount = 0;
            $order = [];

            $userRole = auth()
                ->user()
                ->roles->first();
            $roles = $userRole ? $userRole->name : null;

            if ($roles == 'Administrator') {
                foreach ($ordersData->data as $data) {
                    // dd($data->address);
                    $order[] = $data;
                }
            } elseif ($roles == 'BD Purchase Officer') {
                foreach ($ordersData->data as $data) {
                    if ($data->status == 'partial-paid' || $data->status == 'processing' || $data->status == 'Partial Paid' || $data->status == 'on-hold') {
                        $order[] = $data;
                    }
                }
            } elseif ($roles == 'China Purchase Officer') {
                foreach ($ordersData->data as $data) {
                    if ($data->status == 'processing' || $data->status == 'on-hold' || $data->status == 'purchased' || $data->status == 're-order' || $data->status == 'refund-please' || $data->status == 'shipped-from-suppliers') {
                        $order[] = $data;
                    }
                }
            } elseif ($roles == 'China Warehouse Officer') {
                foreach ($ordersData->data as $data) {
                    if ($data->status == 'shipped-from-suppliers' || $data->status == 'received-in-china-warehouse' || $data->status == 'shipped-from-china-warehouse') {
                        $order[] = $data;
                    }
                }
            } elseif ($roles == 'BD Logistic Officer') {
                foreach ($ordersData->data as $data) {
                    if ($data->status == 'shipped-from-china-warehouse' || $data->status == 'received-in-BD-warehouse') {
                        $order[] = $data;
                    }
                }
            }
            foreach ($order as $value) {
                $price = $value->amount;
                $amount += $price;
            }

            $count = !empty($order) && count($order) > 0 ? $order : null;
            $orders = null;

            if ($count) {
                $orders = $this->paginate($count, 30);
                $orders->withPath('');
            }
            return view('backend.content.order.recent.index', compact('orders', 'amount', 'totalcount'));
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withFlashError('server error');
        }
    }

    public function show($id)
    {
        $receivedData = $this->singleOrder($id);
        $order = $receivedData->orders;
        return view('backend.content.order.showNew', compact('order'));
    }

    public function recentorderStatusUpdate()
    {
        $data = [
            'order_id' => request('order_id', null),
            'status' => request('status', null),
        ];
        $orderResponse = $this->orderStatusUpdate($data);
        return redirect()
            ->back()
            ->withFlashSuccess('Status Updated Successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $orderItem = $this->OrderItem($id);
        if ($orderItem) {
            $title = Str::words($orderItem->name, 6, '...');
            $orderStatus = $this->orderStatus();
            return \response([
                'status' => true,
                'title' => '#' . $orderItem->order_item_number . ' | ' . $title,
                'editForm' => view('backend.content.order.edit', compact('orderItem', 'orderStatus'))->render(),
            ]);
        }

        return \response([
            'status' => false,
            'title' => 'not found',
            'editForm' => 'Order item not found',
        ]);
    }

    public function updateCoupon($id)
    {
        $data = [
            'order_id' => request('order_item_id', null),
            'total_coupon' => request('total_coupon', null),
        ];
        $orderResponse = $this->updateCouponTrait($data);
        if ($orderResponse->status == 'Success') {
            return redirect()
                ->back()
                ->withFlashSuccess('Coupon Updated Successfully');
        } else {
            return redirect()
                ->back()
                ->withFlashError('Error');
        }
    }

    public function depositCoupon($id)
    {
        $data = [
            'order_id' => request('order_item_id', null),
            'deposit' => request('deposit', null),
        ];
        $orderResponse = $this->depositCouponTrait($data);
        if ($orderResponse->status == 'Success') {
            return redirect()
                ->back()
                ->withFlashSuccess('Coupon Deposited Successfully');
        } else {
            return redirect()
                ->back()
                ->withFlashError('Error');
        }
    }

    public function orderStatus()
    {
        return [
            'on-hold' => 'On Hold ',
            'processing' => 'Processing',
            'purchased' => 'Purchased Complete',
            'pending-to-pay' => 'pending-to-pay',
            'after-sales-services' => 'after-sales-services',
            'shipped-from-suppliers' => 'shipped-from-suppliers',
            'received-in-china-warehouse' => 'received-in-china-warehouse',
            'shipped-from-china-warehouse' => 'shipped-from-china-warehouse',
            'received-in-BD-warehouse' => 'received-in-BD-warehouse',
            'on-transit-to-customer' => 'on-transit-to-customer',
            'delivered' => 'delivered',
            'out-of-stock' => 'out-of-stock',
            'adjustment' => 'adjustment',
            'refunded' => 'refunded',
            'Waiting for Payment' => 'Waiting for Payment',
            'Partial Paid' => 'partial-paid',
        ];
    }

    public function validateOrderItems($update_id = null)
    {
        return request()->validate([
            'order_update' => 'nullable',
            'order_item_id' => 'required',
            'chinaLocalDelivery' => 'nullable|numeric|min:0|max:99999999',
            'order_number' => 'nullable|string|min:0|max:191',
            'shipping_rate' => 'nullable|numeric|min:0|max:99999999',
            'actual_weight' => 'nullable|numeric|min:0|max:99999999',
            'shipping_charge' => 'nullable|numeric|min:0|max:99999999',
            'quantity' => 'nullable|numeric|min:0|max:99999999',
            'product_value' => 'nullable|numeric|min:0|max:99999999',
            'first_payment' => 'nullable|numeric|min:0|max:99999999',
            'coupon_contribution' => 'nullable|numeric|min:0|max:99999999',
            'courier_bill' => 'nullable|numeric|min:0|max:99999999',
            'out_of_stock' => 'nullable|numeric|min:0|max:99999999',
            'missing' => 'nullable|numeric|min:0|max:99999999',
            'adjustment' => 'nullable|numeric|max:99999999',
            'refunded' => 'nullable|numeric|min:0|max:99999999',
            'remarks' => 'nullable|string',
            'feedback' => 'nullable|string',
            'claim' => 'nullable|string',
            'solution' => 'nullable|string',
            'due_payment' => 'nullable|numeric|min:0|max:99999999',
            'last_payment' => 'nullable|numeric|min:0|max:99999999',

            'order_item_rmb' => 'nullable',
            'purchase_rmb' => 'nullable|string',
            'purchase_cost_bd' => 'nullable|string',
            'china_local_delivery_rmb' => 'nullable|string',
            'shipping_from' => 'nullable|string',
            'shipping_mark' => 'nullable|string',
            'chn_warehouse_qty.*' => 'nullable',
            'chn_warehouse_weight.*' => 'nullable',
            'cbm' => 'nullable|string',
            'carton_id.*' => 'nullable',
            'product_type' => 'nullable|string',
            'tracking_number.*' => 'nullable',
            'shipped_by' => 'nullable|string',
            'status' => 'nullable|string',
            'product_bd_received_cost' => 'nullable|string',
        ]);
    }
}
