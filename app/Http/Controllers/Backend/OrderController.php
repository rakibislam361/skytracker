<?php

namespace App\Http\Controllers\Backend;

use App\Domains\Page\Models\Page;
use App\Http\Controllers\Controller;
use App\Traits\ApiOrderTrait;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;
use App\Traits\PaginationTrait;
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
      'item_number' => request('item_number', null),
      'status' => request('status', null),
      'shipping_from' => request('shipping_from', null),
      'from_date' => request('from_date', null),
      'to_date' => request('to_date', null),
    ];

    $receivedData = $this->recentorderList($filter);
    $order  = $receivedData->orders;
    $orders = $this->paginate($order, 20);
    $orders->withPath('');
    return view('backend.content.order.recent.index', compact('orders'));
  }

  public function show($id)
  {
    $receivedData = $this->recentorderList($id);
    $order  = $receivedData->orders;
    return view('backend.content.order.showNew', compact('order'));
  }
}
