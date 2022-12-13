<div class="btn-group">
  <button type="button" class="btn  btn-sm btn-secondary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
    <i class="fa fa-cogs"></i>
  </button>
  <div class="dropdown-menu dropdown-menu-right">
    @if($order->status == "Waiting for Payment")
    <a href="{{ route('admin.order.makeAsPayment', $order) }}" class="dropdown-item toggle_make_top">
      Make Partial
    </a>
    @endif
    <a href="{{ route('admin.order.show', $order) }}" class="dropdown-item">
      Show Details
    </a>

    @if($order->pay_method == "bkash" && $order->bkash_payment_id && $order->bkash_trx_id && $order->bkash_refund_trx_id == null )
    <a href="{{ route('admin.order.bkash.operation', $order) }}" data-option="refund"
      class="dropdown-item bkash_refund">
      Refund on Bkash
    </a>
    @endif

    @if($order->pay_method == "bkash" && $order->bkash_trx_id )
    <a href="{{ route('admin.order.bkash.operation', $order) }}" data-option="payment_status"
      class="dropdown-item bkash_refund">
      Bkash Payment Status
    </a>
    @endif

    @if($order->pay_method == "bkash" && $order->bkash_refund_trx_id )
    <a href="{{ route('admin.order.bkash.operation', $order) }}" data-option="refund_status"
      class="dropdown-item bkash_refund">
      Bkash Refund Status
    </a>
    @endif

    @if ($order->id !== 1 & $logged_in_user->isAdmin())
    <a href="{{ route('admin.order.destroy', $order) }}" data-method="delete"
      data-trans-button-cancel="@lang('buttons.general.cancel')"
      data-trans-button-confirm="@lang('buttons.general.crud.delete')" data-trans-title="Are You Sure ?"
      class="dropdown-item text-danger" data-toggle="tooltip" data-placement="top"
      title="@lang('buttons.general.crud.delete')">
      Delete Order
    </a>
    @endif
  </div>
</div>