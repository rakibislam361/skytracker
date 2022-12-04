<?php

namespace App\Http\Controllers\Backend;

use App\Domains\Page\Models\Page;
use App\Http\Controllers\Controller;
use App\Traits\ApiOrderTrait;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;
// use App\Traits\PaginationTrait;

class OrderController extends Controller
{
  use ApiOrderTrait;
  // , PaginationTrait;

  // use OrderTrait, ScheduleUpdated, BkashApiResponse;

  /**
   * Display a listing of the resource.
   *
   * @return Factory|View
   */
  public function index()
  {
    $receivedData = $this->orderList();
    $all_orders = json_decode($receivedData);
    $ordersData = $all_orders->data->result;
    // $orders = $this->paginate($ordersData, 100);
    $orders = $all_orders->data->result;
    // $orders->withPath('');
    return view('backend.content.order.index', compact('orders'));
  }

  public function update($id)
  {
  }

  public function orderUpdate()
  {
    $data = [
      'order_item_number' => request('order_item_number', null),
      'order_item_rmb' => request('order_item_rmb', null),
      'product_bd_received_coast' => request('product_bd_received_coast', null),
      'purchase_rmb' => request('purchase_rmb', null),
      'chinaLocalDelivery' => request('chinaLocalDelivery', null),
      'shipping_from' => request('shipping_from', null),
      'shipping_mark' => request('shipping_mark', null),
      'chn_warehouse_qty' => request('chn_warehouse_qty', null),
      'chn_warehouse_weight' => request('chn_warehouse_weight', null),
      'cbm' => request('cmd', null),
      'carton_id' => request('carton_id', null),
      'tracking_number' => request('tracking_number', null),
      'shipped_by' => request('shipped_by', null),
      'status' => request('status', null),
    ];
    $orderResponse = $this->order_update($data);
    return redirect()->back()->withFlashSuccess($orderResponse);
  }

  public function show($id)
  {
    dd("hello show");
  }
}
