<?php

namespace App\Http\Controllers\Backend;

use App\Domains\Page\Models\Page;
use App\Http\Controllers\Controller;
use App\Traits\ApiOrderTrait;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;
use App\Traits\PaginationTrait;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Http\Controllers\Backend\Auth;
use Log;

class OrderController extends Controller
{
    use ApiOrderTrait, PaginationTrait;

    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        try {

            $filter = [
                'item_number' => request('item_number', null),
                'status' => request('status', null),
                'shipping_from' => request('shipping_from', null),
                'from_date' => request('from_date', null),
                'to_date' => request('to_date', null),
            ];

            $receivedData = $this->orderList($filter);
            $ordersData = $receivedData->data->result;
            $order = [];

            $userRole = auth()
                ->user()
                ->roles->first();
            $roles = $userRole ? $userRole->name : null;
            if ($roles == 'Administrator') {
                foreach ($ordersData->data as $data) {
                    $order[] = $data;
                }
            } else {
                foreach ($ordersData->data as $data) {
                    if ($data->status != 'Waiting for Payment') {
                        $order[] = $data;
                    }
                }
            }



            $totalcount = count($order);
            $orders = $this->paginate($order, 20);
            $orders->withPath('');



            return view('backend.content.order.index', compact('orders', 'totalcount', 'order'));
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withFlashError('server error');
        }
        $totalcount = count($order);
        $orders = $this->paginate($order, 20);
        $orders->withPath('');

        return view('backend.content.order.index', compact('orders', 'totalcount'));
    }

    public function update($id)
    {
        $data = $this->validateOrderItems();

        // $data['chn_warehouse_weight'] = implode(',', request()->chn_warehouse_weight);
        $data['tracking_number'] = implode(',', request()->tracking_number);
        $data['carton_id'] = implode(',', request()->carton_id);
        $chinaLocal = request('chinaLocalDelivery', null);
        if ($chinaLocal == 0) {
            $data['chinaLocalDelivery'] = null;
        }
        if ($data['order_update'] == "withoutajax") {
            unset($data['order_update'], $data['shipping_charge'], $data['quantity'], $data['product_value'], $data['first_payment']);
            $orderResponse = $this->order_update($data);
            if (!$orderResponse = null) {
                // dd('hi');
                return redirect()
                    ->back()
                    ->withFlashSuccess('Order Updated Successfully');
            } else {
                return redirect()
                    ->back()
                    ->withFlashError('Error');
            }
        }

        if ($data['order_update'] == "") {
            $orderResponse = $this->order_update($data);
            // dd($orderResponse);
            return $orderResponse;
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
        $filter = [
            'order_number' => request('order_number', null),
            'status' => request('status', null),
            'from_date' => request('from_date', null),
            'to_date' => request('to_date', null),
        ];

        $receivedData = $this->recentorderList($filter);
        $ordersData = $receivedData->data->result;
        // dd($ordersData->data);
        $order = [];

        $userRole = auth()
            ->user()
            ->roles->first();
        $roles = $userRole ? $userRole->name : null;

        if ($roles == 'Administrator') {
            foreach ($ordersData->data as $data) {
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
        $count = !empty($order) && count($order) > 0 ? $order : null;
        $orders = null;

        if ($count) {
            $orders = $this->paginate($count, 20);
            $orders->withPath('');
        }
        return view('backend.content.order.recent.index', compact('orders'));
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
            'Partial Paid' => 'Partial Paid',
        ];
    }

    public function validateOrderItems($update_id = null)
    {
        // $weight = json_encode(request()->chn_warehouse_weight);
        // $weight = request()->chn_warehouse_weight;
        // Log::info($weight);


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
            'due_payment' => 'nullable|numeric|min:0|max:99999999',
            'last_payment' => 'nullable|numeric|min:0|max:99999999',

            'order_item_rmb' => 'nullable',
            'purchase_rmb' => 'nullable|string',
            'purchase_cost_bd' => 'nullable|string',
            'china_local_delivery_rmb' => 'nullable|string',
            'shipping_from' => 'nullable|string',
            'shipping_mark' => 'nullable|string',
            'chn_warehouse_qty' => 'nullable',
            'chn_warehouse_weight' => 'nullable',
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
