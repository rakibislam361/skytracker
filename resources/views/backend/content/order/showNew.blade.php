@extends('backend.layouts.app')

@section('title', 'Show Order Details')

@php
    $currency = get_setting('currency_icon');
@endphp

@section('content')
    <div class="row justify-content-center">
        <div class="col-sm-10">
            <div class="card">

                <div class="card-header clearfix">
                    <div class="float-left">
                        <h3 class="card-title d-inline-block mr-2">Show Order Details</h3>
                        <span class="text-success font-weight-bold order-status">{{ $order->status ?? null }}</span>
                        <button class="status-modal btn btn-link" data-value="{{ $order->id ?? null }}"><small
                                class="form-text text-muted">change</small></button>
                    </div>
                    <div class="btn-toolbar float-right" role="toolbar" aria-label="@lang('labels.general.toolbar_btn_groups')">
                        <button type="button" class="btn btn-danger mr-2" id="generateInvoiceButton" data-toggle="tooltip"
                            title="Generate Invoice" disabled="true">
                            <i class="fa fa-refresh"></i> @lang('Generate')
                        </button>
                        <a href="{{ route('admin.order.recent') }}" class="btn btn-primary" data-toggle="tooltip"
                            title="Back Orders">
                            <i class="fa fa-arrow-left"></i> Back Orders
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <table class="table table-bordered table-sm">
                                <tr>
                                    <th colspan="2" class="text-center">Customer Details</th>
                                </tr>
                                <tr>
                                    <td style="width: 120px;">Order Id#</td>
                                    <td>{{ $order->order_number ?? null }}</td>
                                </tr>
                                <tr>
                                    <td>Transaction Id#</td>
                                    <td>{{ $order->transaction_id ?? null }}</td>
                                </tr>
                                <tr>
                                    <td>Customer Name</td>
                                    <td>{{ $order->user->name ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <td>Customer Phone</td>
                                    <td>{{ $order->user->phone ?? 'N/A' }}</td>
                                </tr>
                            </table>
                        </div> <!-- col -->
                        <div class="col-sm-6">
                            <table class="table table-bordered table-sm">
                                <tr>
                                    <th colspan="2" class="text-center">Shipping Details</th>
                                </tr>
                                @php
                                    $address = json_decode($order->address) ?? null;
                                @endphp
                                <tr>
                                    <td style="width: 130px;">Shipping Name</td>
                                    <td>{{ $address ? $address->name : 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <td>Shipping Phone1</td>
                                    <td>{{ $address ? $address->phone_one : 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <td>Shipping Phone2</td>
                                    <td>{{ $address ? $address->phone_two : 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <td>Shipping Address</td>
                                    <td>{{ $address ? $address->address : 'N/A' }}</td>
                                </tr>
                            </table>
                        </div> <!-- col -->

                    </div> <!-- row-->

                    <div class="row">
                        <div class="col">
                            <div class="table-responsive">

                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center" style="width: 120px;">#</th>
                                            <th class="text-center">Details</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center" style="width:130px">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $itemTotalPrice = 0;
                                            $invoiceTotal = 0;
                                            $totalChinaShipping = 0;
                                            $totalShippingCharge = 0;
                                        @endphp
                                        {{-- @dd($order->order_items); --}}
                                        @foreach ($order->order_items as $item)
                                            {{-- @dd($item); --}}
                                            @if (!empty($item->product_value))
                                                {{-- <button class="order-modal btn btn-link" data-value="{{$item->id}}">Purchase Item</button> --}}
                                                {{-- @dd($item->id); --}}
                                                <tr id="{{ $item->id }}">
                                                    <td class="text-center align-middle">
                                                        <div class="d-none">
                                                            <span class="productInfo"
                                                                data-product-name="{{ strip_tags($item->name) }}"
                                                                data-product-id="{{ $item->product_id }}"></span>
                                                            <span
                                                                class="order_item_number">{{ $item->order_item_number }}</span>
                                                            <span class="actual_weight">{{ $item->actual_weight }}</span>
                                                            <span class="due_payment">{{ $item->due_payment }}</span>
                                                        </div>
                                                        <div class="custome-checkbox">
                                                            <input type="checkbox" class="form-check-input checkboxItem"
                                                                data-status="{{ $item->status }}"
                                                                value="{{ $item->id }}"
                                                                data-user="{{ $item->user_id }}"
                                                                id="check_{{ $item->id }}">
                                                            <label class="form-check-label"
                                                                for="check_{{ $item->id }}"></label>
                                                        </div>
                                                    </td>
                                                    <td class="text-left" colspan="3">
                                                        <h6>{{ strip_tags($item->name) }}</h6>
                                                        @php
                                                            $link = explode('-', $item->link);
                                                            $linkId = end($link);
                                                        @endphp
                                                        <a href="https://detail.1688.com/offer/{{ $linkId }}.html"
                                                            target="_blank">
                                                            <i class="fa fa-link"></i> <span>1688 Link</span>
                                                        </a>
                                                        <a href="https://www.skybuybd.com{{ $item->link }}"
                                                            class="ml-3" target="_blank">
                                                            <i class="fa fa-link"></i> <span>SkyBuy Link</span>
                                                        </a>
                                                        <a href="{{ route('admin.order.edit', $item->id) }}"
                                                            class="ml-3 edit-item">
                                                            <i class="fa fa-pencil-square-o"></i> <span>Edit</span>
                                                        </a>
                                                        <span class="ml-3"># {{ $item->order_item_number }} </span>
                                                        @if ($item->invoice_no)
                                                            <span class="ml-3">InvoiceID: # {{ $item->invoice_no }}
                                                            </span>
                                                        @endif

                                                        <button class="order-item-modal btn btn-link"
                                                            data-value="{{ $item->id }}">Purchase Item</button>
                                                        <input id="actualrmb_rate" class="actualrmb_rate" type="hidden"
                                                            value="{{ get_setting('actualrmb_rate') }}">
                                                        <input id="local_rate" type="hidden"
                                                            value="{{ get_setting('local_rate') }}">
                                                        <input type="hidden" name="product_value" id="product_value"
                                                            value="{{ $item->product_value }}" class="form-control" />
                                                    </td>
                                                </tr>

                                                @php
                                                    $itemTotalPrice = 0;
                                                @endphp

                                                @foreach ($item->item_variations as $variationKey => $variation)
                                                    @php
                                                        $attributes = json_decode($variation->attributes);
                                                        $sinQuantity = $variation->quantity;
                                                        $price = $variation->price;
                                                        $subTotal = $variation->subTotal;
                                                        $itemTotalPrice += $subTotal;
                                                    @endphp
                                                    <tr>
                                                        <td class="align-middle text-center p-1">
                                                            <img src="{{ asset($variation->image) }}" class="img-fluid">
                                                        </td>
                                                        <td class="text-left align-middle">
                                                            @forelse ($attributes as $attribute)
                                                                @php
                                                                    $PropertyName = $attribute->PropertyName;
                                                                    $Value = $attribute->Value;
                                                                @endphp
                                                                @if ($loop->first)
                                                                    <p class="m-0">{!! $PropertyName !!}: <span
                                                                            class="ml-2">{!! $Value !!}</span>
                                                                    </p>
                                                                    <p class="m-0">
                                                                        Unit Price:
                                                                        <span class="ml-2">{{ $price }}</span>
                                                                    </p>
                                                                    <p class="m-0">
                                                                        Quantity: <span
                                                                            class="ml-2">{{ $sinQuantity }}</span>
                                                                    </p>
                                                                @else
                                                                    <p class="m-0">{!! $PropertyName !!}:
                                                                        {!! $Value !!}</p>
                                                                @endif
                                                            @empty

                                                                <p class="m-0">No Attributes</p>
                                                                <p class="m-0">UnitPrice: {{ $price }} </p>
                                                                <p class="m-0">Quantity: {{ $sinQuantity }}</p>
                                                            @endforelse

                                                        </td>
                                                        <td class="text-center align-middle">{{ $item->status }}</td>
                                                        <td class="text-right align-middle">{{ $subTotal }}</td>
                                                    </tr>
                                                @endforeach

                                                <tr>
                                                    <td class="text-right align-middle" colspan="3">Total</td>
                                                    <td class="text-right align-middle">{{ $itemTotalPrice }}</td>
                                                </tr>

                                                <tr>
                                                    @php
                                                        $chinaLocalDelivery = $item->chinaLocalDelivery;
                                                    @endphp
                                                    <td class="text-right align-middle" colspan="3">China local sipping
                                                        cost (+)
                                                    </td>
                                                    <td class="text-right align-middle">
                                                        {{ floating($chinaLocalDelivery) }}
                                                    </td>
                                                </tr>

                                                <tr>
                                                    @php
                                                        $shippingCharge = $item->shipping_rate * (is_numeric($item->actual_weight) ? $item->actual_weight : 0);
                                                    @endphp
                                                    <td class="text-right align-middle" colspan="3">
                                                        <p class="m-0">China to BD sipping cost (+)</p>
                                                        <p class="m-0 text-danger">Shipping Method
                                                            {{ $item->shipped_by . ' - ' . floating($item->shipping_rate) }}
                                                            Per
                                                            KG
                                                        </p>
                                                        <p class="m-0 text-danger">Approx weight -
                                                            {{ $item->actual_weight ? $item->actual_weight : 0 }} KG
                                                        </p>
                                                    </td>
                                                    <td class="text-right align-middle">{{ floating($shippingCharge) }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    @php
                                                        $itemTotalPrice = $itemTotalPrice + $chinaLocalDelivery + $shippingCharge;
                                                        $invoiceTotal += $itemTotalPrice;
                                                        $totalChinaShipping += $chinaLocalDelivery;
                                                        $totalShippingCharge += $shippingCharge;
                                                    @endphp
                                                    <td class="text-right" colspan="3">Item Total</td>
                                                    <td class="text-right"><span
                                                            class="totalItemPrice">{{ floating($itemTotalPrice) }}</span>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>

                                <table class="table table-bordered table-striped">
                                    @php
                                        $invoiceTotal = (int) $invoiceTotal;
                                        $coupon_victory = $order->coupon_victory ? $order->coupon_victory : 0;
                                    @endphp
                                    <tr>
                                        <td class="text-right">Subtotal</td>
                                        <td class="text-right" style="width: 130px">
                                            {{ $currency .
                                                '
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        ' .
                                                floating($invoiceTotal) }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-right">
                                            Coupon Discount
                                            @if ($order->status == 'on-hold')
                                                <form action="{{ route('admin.order.coupon.update', $order->id) }}"
                                                    method="post" class="d-inline-block" style="max-width:100px;">
                                                    @csrf
                                                    <input type="hidden" name="order_item_id" id="order_item_id"
                                                        value={{ $order->id }} class="form-control" />
                                                    <div class="input-group input-group-sm editField"
                                                        style="display: none">
                                                        {{ html()->text('total_coupon', $coupon_victory)->class('form-control text-right') }}
                                                        <div class="input-group-append">
                                                            <button type="submit" class="btn btn-primary">
                                                                <i class="fa fa-check"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                                <a href="/toggle-coupon" class="ml-2 toggleForm">
                                                    <i class="fa fa-pencil">*</i>
                                                </a>
                                            @endif
                                        </td>
                                        <td class="text-right">
                                            {{ $currency . ' ' . floating($coupon_victory) }}
                                        </td>
                                    </tr>
                                    @php
                                        $invoiceTotal = $invoiceTotal - $coupon_victory;
                                    @endphp
                                    <tr>
                                        <td class="text-right">Gross Total</td>
                                        <td class="text-right">{{ $currency . ' ' . floating($invoiceTotal) }}</td>
                                    </tr>
                                    @php
                                        $advanchedRate = (int) get_setting('advanced_payment');
                                        $advanched = $order->needToPay;
                                        $due = $order->dueForProducts;
                                        $courier_bill = 0;
                                        $out_of_stock = 0;
                                        $missing = 0;
                                        $adjustment = 0;
                                        $refunded = 0;
                                        $last_payment = 0;
                                        foreach ($order->order_items as $key => $items) {
                                            if ($items->courier_bill) {
                                                $courier_bill += $items->courier_bill;
                                            }
                                            if ($items->out_of_stock) {
                                                $out_of_stock += $items->out_of_stock;
                                            }
                                            if ($items->missing) {
                                                $missing += $items->missing;
                                            }
                                            if ($items->adjustment) {
                                                $adjustment += $items->adjustment;
                                            }
                                            if ($items->refunded) {
                                                $refunded += $items->refunded;
                                            }
                                            if ($items->last_payment) {
                                                $last_payment += $items->last_payment;
                                            }
                                        }
                                        
                                        if ($invoiceTotal & $advanched) {
                                            $advanchedRate = ($advanched / $invoiceTotal) * 100;
                                        }
                                    @endphp
                                    <tr>
                                        <td class="text-right">
                                            Deposit {{ round($advanchedRate) }}%
                                            @if ($order->status == 'on-hold')
                                                <form action="{{ route('admin.order.deposit.update', $order->id) }}"
                                                    method="post" class="d-inline-block" style="max-width:100px;">
                                                    @csrf
                                                    <input type="hidden" name="order_item_id" id="order_item_id"
                                                        value={{ $order->id }} class="form-control" />
                                                    {{ html()->hidden('total', $invoiceTotal) }}
                                                    {{ html()->hidden('due', $due) }}
                                                    <div class="input-group input-group-sm editField"
                                                        style="display: none">
                                                        {{ html()->text('deposit', $advanched)->class('form-control text-right') }}
                                                        <div class="input-group-append">
                                                            <button type="submit" class="btn btn-primary">
                                                                <i class="fa fa-check"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                                <a href="/toggle-coupon" class="ml-2 toggleForm">
                                                    <i class="fa fa-pencil">*</i>
                                                </a>
                                            @endif
                                        </td>
                                        <td class="text-right">{{ floating($advanched) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-right">Due</td>
                                        <td class="text-right">{{ floating($invoiceTotal - $advanched) }}</td>
                                    </tr>
                                    @if ($courier_bill)
                                        <tr>
                                            <td class="text-right text-danger">Courier Bill (+)</td>
                                            <td class="text-right text-danger">
                                                {{ floating($courier_bill) }}
                                            </td>
                                        </tr>
                                    @endif
                                    @if ($out_of_stock)
                                        <tr>
                                            <td class="text-right text-danger">Out Of Stock (-)</td>
                                            <td class="text-right text-danger">
                                                {{ floating($out_of_stock) }}
                                            </td>
                                        </tr>
                                    @endif
                                    @if ($missing)
                                        <tr>
                                            <td class="text-right text-danger">Missing (-)</td>
                                            <td class="text-right text-danger">
                                                {{ floating($missing) }}
                                            </td>
                                        </tr>
                                    @endif
                                    @if ($refunded)
                                        <tr>
                                            <td class="text-right text-danger">Refunded (-)</td>
                                            <td class="text-right text-danger">
                                                {{ floating($refunded) }}
                                            </td>
                                        </tr>
                                    @endif
                                    @if ($last_payment)
                                        <tr>
                                            <td class="text-right text-danger">Last Payment (-)</td>
                                            <td class="text-right text-danger">
                                                {{ floating($last_payment) }}
                                            </td>
                                        </tr>
                                    @endif
                                    @if ($adjustment)
                                        <tr>
                                            <td class="text-right text-danger">Adjustment (+/-)</td>
                                            <td class="text-right text-danger">
                                                {{ floating($adjustment) }}
                                            </td>
                                        </tr>
                                    @endif

                                    <tr>
                                        <td class="text-right text-danger">Total Due</td>
                                        <td class="text-right text-danger">{{ floating($due) }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div> <!-- col-->
                    </div> <!-- row-->

                </div> <!-- card-body-->
            </div> <!-- card-->
        </div> <!-- col-->
    </div> <!-- row-->



    <div class="modal fade" id="editItemForm" tabindex="-1" role="dialog" aria-labelledby="editItemFormTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editItemFormTitle">Edit</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Loading...</p>
                </div>
            </div>
        </div>
    </div> <!-- updateButton -->

    <!-- Modal -->
    @include('backend.content.order.recent.includes.status-modal')
    @include('backend.content.order.includes.edit_modal')
    @include('backend.content.order.wallet.includes.generate-modal')

@endsection


@push('after-scripts')
    {{ script('assets/plugins/select2/js/select2.full.min.js') }}
    {!! script('assets/js/manage-wallet.js') !!}
    <script>
        const popupCenter = ({
            url,
            title,
            w,
            h
        }) => {
            // Fixes dual-screen position Most browsers      Firefox
            const dualScreenLeft = window.screenLeft !== undefined ? window.screenLeft : window.screenX;
            const dualScreenTop = window.screenTop !== undefined ? window.screenTop : window.screenY;

            const width = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document
                .documentElement.clientWidth : screen.width;
            const height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document
                .documentElement.clientHeight : screen.height;

            const systemZoom = width / window.screen.availWidth;
            const left = (width - w) / 2 / systemZoom + dualScreenLeft
            const top = (height - h) / 2 / systemZoom + dualScreenTop
            const newWindow = window.open(url, title,
                `scrollbars=yes, width=${w / systemZoom}, height=${h / systemZoom}, top=${top},left=${left}`)

            if (window.focus) newWindow.focus();
        }

        $(function() {

            $(document).on('click', '.printOrder', function(event) {
                event.preventDefault();
                var href = $(this).attr('href');
                popupCenter({
                    url: href,
                    title: 'Print Order',
                    w: 800,
                    h: 700
                });
            });

            $(document).on('click', '.changeStatusButton', function(event) {
                event.preventDefault();
                $('#changeStatusButton').modal('show');
                var data_id = $(this).attr('data-id');
                var status = $(this).closest('tr').find('.singleStatus').text();
                $('#changeStatusButton').find('#item_id').val(data_id);
                // $('#change_status option[value='+status+']').attr('selected','selected');

                $('#change_status option').each(function() {
                    if ($(this).val() == status) {
                        $(this).prop("selected", true);
                    } else {
                        $(this).prop("selected", false);
                    }
                });
            });

            $(document).on('change', '#change_status', function(event) {
                event.preventDefault();
                var status = $(this).val();
                var additionStatus = $('#additionInputStatusForm');
                var inputData = '';

                if (status === 'purchased') {
                    inputData =
                        `<input type="text" name="order_number" placeholder="Order Number" class="form-control" required="true">`;
                } else if (status === 'shipped-from-suppliers') {
                    inputData =
                        `<input type="text" name="tracking_number" placeholder="Tracking Number" class="form-control" required="true">`;
                } else if (status === 'received-in-BD-warehouse') {
                    inputData =
                        `<input type="text" name="actual_weight" placeholder="Actual Weight" class="form-control" required="true">`;
                } else if (status === 'out-of-stock') {
                    inputData =
                        `<input type="text" name="out-of-stock" placeholder="partial/full" class="form-control" required="true"><input type="text" name="amount" placeholder="Amount" class="form-control" required="true">`;
                } else if (status === 'canceled-by-seller') {
                    inputData =
                        `<input type="text" name="adjustment" placeholder="Adjustment Amount" class="form-control" required="true">`;
                } else if (status === 'refunded') {
                    inputData =
                        `<input type="text" name="refunded" placeholder="Adjustment Amount" class="form-control" required="true">`;
                }

                additionStatus.html(inputData);

            });


        });
    </script>
@endpush
