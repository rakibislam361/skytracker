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

    $userRole = auth()->user()->roles->first();
    $roles =  $userRole ? $userRole->name : null;
    // dd($roles);
    if ($roles == "Administrator") {
      foreach ($ordersData->data as $data) {
        $order[] = $data;
      }
    } elseif ($roles == "BD Purchase Officer") {
      foreach ($ordersData->data as $data) {
        if (
          $data->status == "partial-paid"
          || $data->status == "processing"
          || $data->status == "Partial Paid"
        ) {
          $order[] = $data;
        }
      }
    } elseif ($roles == "China Purchase Officer") {
      foreach ($ordersData->data as $data) {
        if (
          $data->status == "processing"
          || $data->status == "on-hold"
          || $data->status == "purchased"
          || $data->status == "re-order"
          || $data->status == "refund-please"
          || $data->status == "shipped-from-suppliers"
        ) {
          $order[] = $data;
        }
      }
    } elseif ($roles == "China Warehouse Officer") {
      foreach ($ordersData->data as $data) {
        if (
          $data->status == "shipped-from-suppliers"
          || $data->status == "received-in-china-warehouse"
          || $data->status == "shipped-from-china-warehouse"
        ) {
          $order[] = $data;
        }
      }
    } elseif ($roles == "BD Logistic Officer") {
      foreach ($ordersData->data as $data) {
        if (
          $data->status == "shipped-from-china-warehouse"
          || $data->status == "received-in-BD-warehouse"
        ) {
          $order[] = $data;
        }
      }
    }


    $orders = $this->paginate($order, 20);
    $orders->withPath('');

    return view('backend.content.order.index', compact('orders'));
  }

  public function update($id)
  {
    $userRole = auth()->user()->roles->first();
    $roles =  $userRole ? $userRole->name : null;
    if ($roles == "Administrator") {
      $data = [
        'order_item_number' => request('order_item_number', null),
        'order_item_rmb' => request('order_item_rmb', null),
        'purchase_rmb' => request('purchase_rmb', null),
        'purchase_cost_bd' => request('purchase_cost_bd', null),
        'china_local_delivery_rmb' => request('china_local_delivery_rmb', null),
        'chinaLocalDelivery' => request('chinaLocalDelivery', null),
        'shipping_from' => request('shipping_from', null),
        'shipping_mark' => request('shipping_mark', null),
        'chn_warehouse_qty' => request('chn_warehouse_qty', null),
        'chn_warehouse_weight' => request('chn_warehouse_weight', null),
        'cbm' => request('cbm', null),
        'carton_id' => request('carton_id', null),
        'tracking_number' => request('tracking_number', null),
        'shipped_by' => request('shipped_by', null),
        'status' => request('status', null),
        'product_bd_received_cost' => request('product_bd_received_cost', null),
      ];
      // Log::info($roles, $data);
    } elseif ($roles == "BD Purchase Officer") {
      $data = [
        'order_item_number' => request('order_item_number', null),
        'order_item_rmb' => request('order_item_rmb', null),
        'status' => request('status', null),
      ];
      // Log::info($roles, $data);
    } elseif ($roles == "China Purchase Officer") {
      $data = [
        'order_item_number' => request('order_item_number', null),
        'purchase_rmb' => request('purchase_rmb', null),
        'purchase_cost_bd' => request('purchase_cost_bd', null),
        'china_local_delivery_rmb' => request('china_local_delivery_rmb', null),
        'chinaLocalDelivery' => request('chinaLocalDelivery', null),
        'status' => request('status', null),
        'product_bd_received_cost' => request('product_bd_received_cost', null),
      ];
      // Log::info($roles, $data);
    } elseif ($roles == "China Warehouse Officer") {
      $data = [
        'order_item_number' => request('order_item_number', null),
        'shipping_from' => request('shipping_from', null),
        'shipping_mark' => request('shipping_mark', null),
        'chn_warehouse_qty' => request('chn_warehouse_qty', null),
        'chn_warehouse_weight' => request('chn_warehouse_weight', null),
        'cbm' => request('cbm', null),
        'carton_id' => request('carton_id', null),
        'tracking_number' => request('tracking_number', null),
        'shipped_by' => request('shipped_by', null),
        'status' => request('status', null),
      ];
      // Log::info($roles, $data);
    } elseif ($roles == "BD Logistic Officer") {
      $data = [
        'order_item_number' => request('order_item_number', null),
        'status' => request('status', null),
      ];
      // Log::info($roles, $data);
    }
    $orderResponse = $this->order_update($data);
    return response(json_encode($orderResponse));
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
    // $order  = $receivedData->orders;
    $ordersData = $receivedData;
    $order = [];

    $userRole = auth()->user()->roles->first();
    $roles =  $userRole ? $userRole->name : null;
    // dd($roles);
    if ($roles == "Administrator") {
      foreach ($ordersData->orders as $data) {
        $order[] = $data;
      }
    } elseif ($roles == "BD Purchase Officer") {
      foreach ($ordersData->orders as $data) {
        if (
          $data->status == "partial-paid"
          || $data->status == "processing"
          || $data->status == "Partial Paid"
        ) {
          $order[] = $data;
        }
      }
    }
    $orders = $this->paginate($order, 20);
    $orders->withPath('');
    return view('backend.content.order.recent.index', compact('orders'));
  }

  public function show($id)
  {
    $receivedData = $this->singleOrder($id);
    $order  = $receivedData->orders;
    return view('backend.content.order.showNew', compact('order'));
  }

  public function recentorderStatusUpdate()
  {
    $data = [
      'order_id' => request('order_id', null),
      'status' => request('status', null),
    ];
    $orderResponse = $this->orderStatusUpdate($data);
    return redirect()->back()->withFlashSuccess('Status Updated Successfully');
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
        'title' => '#' . $orderItem->order_item_number . " | " . $title,
        'editForm' => view('backend.content.order.edit', compact('orderItem', 'orderStatus'))->render(),
      ]);
    }

    return \response([
      'status' => false,
      'title' => 'not found',
      'editForm' => 'Order item not found',
    ]);
  }

  public function orderitemUpdate($id)
  {
    $data = $this->validateOrderItems();
    $orderResponse = $this->orderItemUpdateTrait($id, $data);
    return redirect()->back()->withFlashSuccess('Status Updated Successfully');
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
    return request()->validate([
      'item_id' => 'required',
      'chinaLocalDelivery' => 'nullable|numeric|min:0|max:99999999',
      'order_number' => 'nullable|string|min:0|max:191',
      'tracking_number' => 'nullable|string|min:0|max:255',
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
      'status' => 'required|string|min:0|max:255',
    ]);
  }
}
