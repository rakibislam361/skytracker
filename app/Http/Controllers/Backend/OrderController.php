<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Traits\ApiOrderTrait;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

class OrderController extends Controller
{
  use ApiOrderTrait;

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
    $orders = $all_orders->data->result;
    return view('backend.content.order.index', compact('orders'));
  }

  public function update($id)
  {
    dd(request());
  }

  public function orderUpdate()
  {
    $orderResponse = $this->order_update();
    return redirect()->back()->withFlashSuccess($orderResponse);
  }

  public function show($id)
  {
    dd("hello");
  }
}
