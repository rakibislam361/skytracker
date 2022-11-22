<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Traits\OrderTrait;
use App\Http\Traits\ScheduleUpdated;
use App\Models\Auth\User;
use App\Models\Content\Order;
use App\Models\Content\OrderItem;
use App\Models\Content\OrderItemVariation;
use App\Traits\BkashApiResponse;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Throwable;

class OrderController extends Controller
{

  // use OrderTrait, ScheduleUpdated, BkashApiResponse;

  /**
   * Display a listing of the resource.
   *
   * @return Factory|View
   */
  public function index()
  {
    // $this->updateOrderMissingInformation();

    $orders = [];
    $trashedOrders = [];
    return view('backend.content.order.index', compact('orders', 'trashedOrders'));
  }


  public function makeAsPayment($id)
  {
    $order = Order::findOrFail($id);
    $order_id = $id;
    $order_user_id = $order->user_id;
    if ($order) {
      DB::transaction(function () use ($order, $order_id, $order_user_id) {
        $order->update([
          'status' => 'Partial Paid'
        ]);
        OrderItem::where('order_id', $order_id)
          ->where('user_id', $order_user_id)
          ->update([
            'status' => 'Partial Paid',
          ]);
      });
    }
    $tran = $order->order_number ?? '';
    return redirect()->back()->withFlashSuccess('Incomplete order #' . $tran . ' make as partial paid');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param Request $request
   * @return \Illuminate\Http\JsonResponse
   * @throws Throwable
   */
  public function store(Request $request)
  {
    $status = request('status');
    $item_id = request('item_id');
    $orderItem = null;
    $is_array = false;
    if (is_array($item_id)) {
      $is_array = true;
      foreach ($item_id as $item) {
        $orderItem[] = $this->update_order_wallet_status($item, $status, $request);
      }
    } else {
      $is_array = false;
      $orderItem = $this->update_order_wallet_status($item_id, $status, $request);
    }

    $csrf = csrf_token();

    if (!empty($orderItem)) {
      $order_data = [
        'status' => true,
        'csrf' => $csrf,
        'is_array' => $is_array,
        'orderItem' => $orderItem,
      ];
      return \response()->json($order_data);
    }

    return \response()->json(['status' => false, 'csrf' => $csrf]);
  }


  public function update_order_wallet_status($item_id, $status, $request)
  {
    $orderItem = OrderItem::find($item_id);
    $data = [];
    // $order_id = $orderItem->order_item_number;  {--UNDO--}
    $amount = '';
    $tracking = '';
    if ($status === 'purchased') {
      $data = $request->only('order_number', 'status');
    } elseif ($status === 'shipped-from-suppliers') {
      $data = $request->only('tracking_number', 'status');
      $tracking = $data['tracking_number'];
    } elseif ($status === 'received-in-china-warehouse') {
      $data = $request->only('status');
    } elseif ($status === 'shipped-from-china-warehouse') {
      $data = $request->only('status');
    } elseif ($status === 'received-in-BD-warehouse') {
      $data = $request->only('actual_weight', 'status');
      $data['shipping_charge'] = round($orderItem->shipping_rate * $data['actual_weight']);
    } elseif ($status === 'on-transit-to-customer') {
      $data = $request->only('status');
    } elseif ($status === 'delivered') {
      $data = $request->only('status');
    } elseif ($status === 'out-of-stock') {
      $data = $request->only('out_of_stock', 'out_of_stock_type', 'status');
      $amount = $data['out_of_stock'];
    } elseif ($status === 'adjustment') {
      $data = $request->only('adjustment', 'status');
      $amount = $data['adjustment'];
    } elseif ($status === 'refunded') {
      $data = $request->only('refunded', 'status');
      $amount = $data['refunded'];
    }

    // manage customer Messages
    // $user = $orderItem->user;    {--UNDO--}
    // if ($request->input('notify')) {
    //   generate_customer_notifications($status, $user, $order_id, $amount, $tracking);
    // }  {--UNDO--}

    if (!empty($data)) {
      $orderItem->update($data);
      $recheckOrderItem = OrderItem::find($item_id);
      $due_payment = calculateItemDue($recheckOrderItem);
      $recheckOrderItem->update(['due_payment' => $due_payment]);
    }

    return $orderItem;
  }

  public function show_details($id)
  {
    $order = Order::with('orderItems')->findOrFail($id);
    $order = Order::with('orderItems', 'user')->find($id);
    $render = '';
    $title = 'Wallet details';
    $status = false;
    if ($order) {
      $customer = $order->user->first_name . ' ' . $order->user->last_name;
      $item_no = $order->order_number;
      $status = true;
      $title = "Order details of Mr. {$customer} and Order No #{$item_no}";
      $render = view('backend.content.order.showNew', compact('order'))->render();
    }

    return \response([
      'status' => $status,
      'title' => $title,
      'render' => $render,
    ]);
  }


  public function changeStatus($id)
  {
    $status = request('status');
    $order = Order::with('orderItems')->findOrFail($id);
    if ($order) {
      $order->update(['status' => $status]);
    }
    return redirect()->back()->withFlashSuccess('Order status changed successfully');
  }


  public function updateCoupon($id)
  {
    $total_coupon = request('total_coupon');
    $order = Order::withCount('orderItems')->findOrFail($id);
    if ($total_coupon && $order) {
      $totalItems = $order->order_items_count;
      if ($totalItems) {
        $perItemCoupon = ($total_coupon / $totalItems);
        $orderItems = $order->orderItems;
        foreach ($orderItems as $item) {
          $item->update(['coupon_contribution' => round($perItemCoupon)]);
        }

        $this->recalculateOrderItemsDue($order->id);
      }
      $order->update(['coupon_code' => 'manual', 'coupon_victory' => $total_coupon]);
    }

    return redirect()->back()->withFlashSuccess('Coupon updated successfully');
  }

  public function depositCoupon($id)
  {
    $deposit = request('deposit');
    $order = Order::with('orderItems')->withCount('orderItems')->findOrFail($id);
    if ($deposit && $order) {
      $amount = $order->orderItems->sum('first_payment');
      $order_items = $order->order_items_count;
      if ($order_items) {
        foreach ($order->orderItems as $item) {
          $weight_avg = $item->first_payment / $amount;
          $newFirstPayment = $deposit * $weight_avg;
          $item->update([
            'first_payment' => round($newFirstPayment)
          ]);
        }
        $this->recalculateOrderItemsDue($order->id);
      }
    }

    return redirect()->back()->withFlashSuccess('Deposit updated successfully');
  }


  /**
   * Display the specified resource.
   *
   * @param int $id
   * @return \Illuminate\Contracts\Routing\ResponseFactory|Response
   */
  public function show($id)
  {
    $this->recalculateOrderItemsDue($id);
    $order = Order::with('orderItems', 'user')->where('id', $id)->firstOrFail();

    return view('backend.content.order.showNew', compact('order'));
  }


  public function walletOrders()
  {
    $customers = User::role('user')->withCount('orders')->orderBy('first_name')->get();
    $findable[''] = ' - Select Customer - ';
    foreach ($customers as $customer) {
      if ($customer->first_name && $customer->first_name != "") {
        $findable[$customer->id] = $customer->full_name;
      } else {
        $findable[$customer->id] = $customer->phone;
      }
    }
    return view('backend.content.order.wallet.index', ['findable' => $findable]);
  }

  public function walletDetails($id)
  {
    $order = OrderItem::with('user', 'order', 'product', 'itemVariations')
      ->where('id', $id)->firstOrFail();
    return view('backend.content.order.wallet.details', compact('order'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param int $id
   * @return Response
   */
  public function edit($item_id)
  {
    $orderItem = OrderItem::with('order', 'itemVariations')->find($item_id);
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

  /**
   * Update the specified resource in storage.
   *
   * @param Request $request
   * @param int $id
   * @return Response
   */
  public function update(Request $request, $item_id)
  {
    $validData = $this->validateOrderItems($item_id);
    $variations = request('variation', []);
    $keys = [];
    if (!empty($variations)) {
      foreach ($variations as $key => $variation) {
        $itemVariation = OrderItemVariation::find($key);
        if ($itemVariation) {
          $price = $variation['price'] ?? 0;
          $quantity = $variation['quantity'] ?? 0;
          $subTotal = $price * $quantity;
          $itemVariation->update([
            'price' => $price,
            'quantity' => $quantity,
            'subTotal' => $subTotal,
          ]);
        }
      }
    }

    $orderItem = OrderItem::with('order', 'itemVariations')->find($item_id);
    if ($orderItem) {
      $validData['quantity'] = $orderItem->itemVariations->sum('quantity');
      $validData['product_value'] = $orderItem->itemVariations->sum('subTotal');
      $orderItem->update($validData);
      $order_id = $orderItem->order->id ?? null;
      $this->recalculateOrderItemsDue($order_id);
    }

    return redirect()->back()->withFlashSuccess('Order updated successfully');
  }


  public function bkashOperation($id)
  {
    $order = Order::find($id);
    $option = request('option', 'refund');
    $html = '';
    if ($option == 'refund') {
      $html = view('backend.content.order.ajax.refund', compact('order'))->render();
    } elseif ($option == 'refund_status') {
      $status = $this->RefundStatus([
        'paymentID' => $order->bkash_payment_id,
        'trxID' => $order->bkash_trx_id,
      ]);
      $html = view('backend.content.order.ajax.refundStatus', compact('status'))->render();
    } elseif ($option == 'payment_status') {
      $status = $this->SearchTransaction($order->bkash_trx_id);
      $html = view('backend.content.order.ajax.refundStatus', compact('status'))->render();
    }

    return response(['html' => $html, 'option' => $option]);
  }


  public function refundPayment($id)
  {
    $order = Order::find($id);
    $reason = request('reason');

    $refund = $this->RefundTransaction([
      'paymentID' => $order->bkash_payment_id,
      'amount' => $order->needToPay,
      'trxID' => $order->bkash_trx_id,
      'sku' => $order->transaction_id,
      'reason' => $reason,
    ]);

    $transactionStatus = getArrayKeyData($refund, 'transactionStatus');
    $refundTrxID = getArrayKeyData($refund, 'refundTrxID');
    $status = false;

    if ($transactionStatus == 'Completed') {
      $order->update([
        'bkash_refund_trx_id' => $refundTrxID,
        'status' => 'refunded',
      ]);
      $status = true;
    }

    $html = view('backend.content.order.ajax.refundStatus', ['status' => $refund])->render();

    $order = Order::find($id);

    return response(['status' => $status, 'order' => $order, 'html' => $html]);
  }














  /**
   * Remove the specified resource from storage.
   *
   * @param int $page
   * @return Response
   */
  public function destroy($id)
  {
    $order = Order::withTrashed()->find($id);
    $order_id = $id;
    $order_user_id = $order->user_id ?? null;
    $orderItem = OrderItem::withTrashed()->where('order_id', $order_id)
      ->where('user_id', $order_user_id);
    $orderItemItems = $orderItem->pluck('id')->toArray();
    $OrderItemVariation = OrderItemVariation::withTrashed()->whereIn('order_item_id', $orderItemItems)->where('user_id', $order_user_id);

    if ($order->trashed()) {
      $order->forceDelete();
      $orderItem->forceDelete();
      $OrderItemVariation->forceDelete();
      return \response([
        'status' => true,
        'icon' => 'success',
        'msg' => 'Order, Order Item and Item variation permanently deleted',
      ]);
    } else if ($order->delete()) {
      $orderItem->delete();
      $OrderItemVariation->delete();
      return \response([
        'status' => true,
        'icon' => 'success',
        'msg' => 'Order, Order Item and Item variation delete successfully',
      ]);
    }
    return \response([
      'status' => false,
      'icon' => 'error',
      'msg' => 'Delete failed',
    ]);
  }


  public function restore($id)
  {
    $trashOrder = Order::onlyTrashed()->findOrFail($id);

    $order_id = $id;
    $order_user_id = $trashOrder->user_id;

    $orderItem = OrderItem::onlyTrashed()->where('order_id', $order_id)
      ->where('user_id', $order_user_id);
    $orderItemItems = $orderItem->pluck('id')->toArray();
    $OrderItemVariation = OrderItemVariation::onlyTrashed()->whereIn('order_item_id', $orderItemItems)->where('user_id', $order_user_id);

    $trashOrder->restore();
    $orderItem->restore();
    $OrderItemVariation->restore();

    return redirect()->route('admin.order.index')->withFlashSuccess('Order Recovered Successfully');
  }


  public function validateOrderItems($update_id = null)
  {
    return request()->validate([
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
}
