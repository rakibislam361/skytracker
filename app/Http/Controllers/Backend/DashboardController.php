<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Models\Content\Order;
use App\Traits\ApiOrderTrait;
use DB;

/**
 * Class DashboardController.
 */
class DashboardController
{

    use ApiOrderTrait;
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $all_orders = $this->orderList();
        $orders = json_decode($all_orders);
        $all_orders = $orders->data->result;
        return view('backend.dashboard', compact('all_orders'));
    }

    public function search(Request $request)
    {
        $data = Order::with('orderItems');
        if ($request->input('itemNO')) {
            $data = $data->where('order_number', 'LIKE', "%" . $request->itemNO . "%")->paginate(20);
        }
        return view('backend.content.order.search', compact('data'));
    }
}
