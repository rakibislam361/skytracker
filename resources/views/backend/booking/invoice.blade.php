<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Invoice No : {{ $invoice->invoice_id }}</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('assets/plugins/print/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/print/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/print/order_print.css') }}" type="text/css" />
</head>

<body>
    <div id="wrapper">
        <div id="receiptData">
            <div id="receipt-data">
                <div id="receipt-data">
                    <div class="logo_header" style="padding-bottom: 50px">
                        <table class="width_100_p">
                            <tr>
                                <td style="width: 20% !important;">
                                    @php
                                        $fLogo = get_setting('invoice_logo', 'img/backend/no-image.gif');
                                    @endphp
                                    <img src="{{ asset($fLogo) }}">
                                </td>
                                <td class="text-center">
                                    <h1 class="p_txt_1">{{ get_setting('invoice_site_name', config('app.name')) }}</h1>
                                    {!! get_setting('invoice_site_address') !!}
                                    <p class="inv_black">Invoice</p>
                                </td>
                                <td style="width: 20% !important;"></td>
                            </tr>
                        </table>
                    </div>
                    @php
                        
                        $product = [];
                        $carton = [];
                        $shipMark = [];
                        $shipNo = [];
                        $cartonQty = [];
                        $actualWeight = [];
                        $unit_price = [];
                        $amount = [];
                        $customer = [];
                        $phone = [];
                        $address = [];
                        $sl_no = 0;
                        
                        if ($invoice->product_name != null) {
                            $product = explode(',', $invoice->product_name);
                        }
                        if ($invoice->carton_number != null) {
                            $carton = explode(',', $invoice->carton_number);
                        }
                        if ($invoice->shipping_mark != null) {
                            $shipMark = explode(',', $invoice->shipping_mark);
                        }
                        if ($invoice->shipping_number != null) {
                            $shipNo = explode(',', $invoice->shipping_number);
                        }
                        if ($invoice->carton_qty != null) {
                            $cartonQty = explode(',', $invoice->carton_qty);
                        }
                        if ($invoice->actual_weight != null) {
                            $actualWeight = explode(',', $invoice->actual_weight);
                        }
                        if ($invoice->unit_price != null) {
                            $unit_price = explode(',', $invoice->unit_price);
                        }
                        if ($invoice->amount != null) {
                            $amount = explode(',', $invoice->amount);
                        }
                        if ($invoice->customer_name != null) {
                            $customer = explode(',', $invoice->customer_name);
                            $customer = array_unique($customer);
                            $customer = implode(',', $customer);
                        } else {
                            $customer = null;
                        }
                        if ($invoice->customer_phone != null) {
                            $phone = explode(',', $invoice->customer_phone);
                            $phone = array_unique($phone);
                            $phone = implode(',', $phone);
                        } else {
                            $phone = null;
                        }
                        if ($invoice->customer_address != null) {
                            $address = explode(',', $invoice->customer_address);
                            $address = array_unique($address);
                            $address = implode(',', $address); 
                        } else {
                            $address = null;
                        }
                        // $count = count($product);
                    @endphp
                    <div class="row" style="margin-bottom: 15px">
                        <div class="col-sm-4">
                            <table class="table table-bordered table-condensed">
                                <tr>
                                    <td class="p_txt_5"> Invoice: </td>
                                    <td class="p_txt_6"> {{ $invoice->invoice_id }} </td>
                                </tr>
                                <tr>
                                    <td class="p_txt_5"> Date: </td>
                                    <td class="p_txt_6"> {{ date('M d, Y', strtotime($invoice->created_at)) }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-sm-4">
                        </div>
                        <div class="col-sm-4">

                            <table class="table table-bordered table-condensed">
                                <tr>
                                    <td class="p_txt_5"><b>Customer:</b></td>
                                    <td class="p_txt_6"><b>{{ $customer ?? 'N/A' }}</b></td>
                                </tr>
                                <tr>
                                    <td class="p_txt_5"><b>Phone:</b></td>
                                    <td class="p_txt_6">{{ $phone ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <td class="p_txt_5"><b>Address:</b></td>
                                    <td class="p_txt_6">{{ $address ?? 'N/A' }}</td>
                                </tr>
                            </table>

                        </div>
                    </div>

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col" class="text-center">SL No</th>
                                <th scope="col" class="text-center">Product Name</th>
                                <th scope="col" class="text-center">Shipping Mark</th>
                                <th scope="col" class="text-center">Carton Number</th>
                                <th scope="col" class="text-center">Shipping Number</th>
                                <th scope="col" class="text-center">Carton Qty</th>
                                <th scope="col" class="text-center">Weight</th>
                                <th scope="col" class="text-center">Unit Price</th>
                                <th scope="col" class="text-center">Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>

                                <td class="text-center align-middle" style="padding: 0%">
                                    @foreach ($product as $sl)
                                        @php
                                            $sl_no += 1;
                                        @endphp
                                        <table class="table table-condensed" style="margin: 0px;">
                                            <tr>
                                                <td>
                                                    {{ $sl_no }}
                                                </td>
                                            </tr>

                                        </table>
                                    @endforeach
                                </td>

                                <td class="text-center align-middle" style="padding: 0%">

                                    @foreach ($product as $p_name)
                                        @if ($p_name == null)
                                            <table class="table table-condensed" style="margin: 0px;">
                                                <tr>
                                                    <td>
                                                        N/A
                                                    </td>
                                                </tr>

                                            </table>
                                        @else
                                            <table class="table table-condensed" style="margin: 0px;">
                                                <tr>
                                                    <td>
                                                        {{ $p_name ?? 'N/A' }}
                                                    </td>
                                                </tr>

                                            </table>
                                        @endif
                                    @endforeach

                                </td>
                                <td class="text-center align-middle" style="padding: 0%">
                                    @foreach ($shipMark as $ship)
                                        @if ($ship == null)
                                            <table class="table table-condensed" style="margin: 0px;">
                                                <tr>
                                                    <td>
                                                        N/A
                                                    </td>
                                                </tr>

                                            </table>
                                        @else
                                            <table class="table table-condensed" style="margin: 0px;">
                                                <tr>
                                                    <td>
                                                        {{ $ship ?? 'N/A' }}
                                                    </td>
                                                </tr>
                                            </table>
                                        @endif
                                    @endforeach

                                </td>
                                <td class="text-center align-middle" style="padding: 0%">
                                    @foreach ($carton as $cart)
                                        @if ($cart == null)
                                            <table class="table table-condensed" style="margin: 0px;">
                                                <tr>
                                                    <td>
                                                        N/A
                                                    </td>
                                                </tr>

                                            </table>
                                        @else
                                            <table class="table table-condensed" style="margin: 0px;">
                                                <tr>
                                                    <td>
                                                        {{ $cart ?? 'N/A' }}
                                                    </td>
                                                </tr>
                                            </table>
                                        @endif
                                    @endforeach
                                </td>
                                <td class="text-center align-middle" style="padding: 0%">
                                    @foreach ($shipNo as $ship)
                                        @if ($ship == null)
                                            <table class="table table-condensed" style="margin: 0px;">
                                                <tr>
                                                    <td>
                                                        N/A
                                                    </td>
                                                </tr>

                                            </table>
                                        @else
                                            <table class="table table-condensed" style="margin: 0px;">
                                                <tr>
                                                    <td>
                                                        {{ $ship ?? 'N/A' }}
                                                    </td>
                                                </tr>
                                            </table>
                                        @endif
                                    @endforeach
                                </td>
                                <td class="text-center align-middle" style="padding: 0%">
                                    @foreach ($cartonQty as $ctnQty)
                                        @if ($ctnQty == null)
                                            <table class="table table-condensed" style="margin: 0px;">
                                                <tr>
                                                    <td>
                                                        N/A
                                                    </td>
                                                </tr>

                                            </table>
                                        @else
                                            <table class="table table-condensed" style="margin: 0px;">
                                                <tr>
                                                    <td>
                                                        {{ $ctnQty ?? 'N/A' }}
                                                    </td>
                                                </tr>
                                            </table>
                                        @endif
                                    @endforeach
                                </td>
                                <td class="text-center align-middle" style="padding: 0%">
                                    @foreach ($actualWeight as $weight)
                                        @if ($weight == null)
                                            <table class="table table-condensed" style="margin: 0px;">
                                                <tr>
                                                    <td>
                                                        N/A
                                                    </td>
                                                </tr>
                                            </table>
                                        @else
                                            <table class="table table-condensed" style="margin: 0px;">
                                                <tr>
                                                    <td>
                                                        {{ $weight ?? 'N/A' }}
                                                    </td>
                                                </tr>
                                            </table>
                                        @endif
                                    @endforeach
                                </td>
                                <td class="text-center align-middle" style="padding: 0%">
                                    @foreach ($unit_price as $unit)
                                        @if ($unit == null)
                                            <table class="table table-condensed" style="margin: 0px;">
                                                <tr>
                                                    <td>
                                                        N/A
                                                    </td>
                                                </tr>

                                            </table>
                                        @else
                                            <table class="table table-condensed" style="margin: 0px;">
                                                <tr>
                                                    <td>
                                                        {{ $unit ?? 'N/A' }}
                                                    </td>
                                                </tr>
                                            </table>
                                        @endif
                                    @endforeach
                                </td>
                                <td class="text-center align-middle" style="padding: 0%">
                                    @foreach ($amount as $amt)
                                        @if ($amt == null)
                                            <table class="table table-condensed" style="margin: 0px;">
                                                <tr>
                                                    <td>
                                                        N/A
                                                    </td>
                                                </tr>

                                            </table>
                                        @else
                                            <table class="table table-condensed" style="margin: 0px;">
                                                <tr>
                                                    <td>
                                                        {{ abs($amt) ?? 'N/A' }}
                                                        {{-- {{ number_format((float) $amt, 2, '.', '') ?? 'N/A' }} --}}
                                                    </td </tr>
                                            </table>
                                        @endif
                                    @endforeach
                                </td>
                            </tr>
                        </tbody>
                        @php
                            $subtotal = 0;
                            $weight = 0;
                            foreach ($amount as $amt) {
                                $subtotal += $amt;
                            }
                            foreach ($actualWeight as $key => $value) {
                                $weight += $value;
                            }
                            
                        @endphp
                        <tfoot id="invoiceFooter">
                            <tr>
                                <td colspan="6" class="text-right">total</td>
                                <td class="text-center align-middle"><span
                                        data-user="{{ $invoice->user->id ?? null }}">{{ $weight ?? 0 }}</span>
                                </td>
                                <td class="text-right">Subtotal</td>
                                <td class="text-center align-middle">
                                    {{ $subtotal ?? 0 }}
                                </td>
                            </tr>
                            <tr>
                                <td colspan="8" class="text-right">Courier Bill</td>
                                <td class="text-center align-middle"><span
                                        data-user="{{ $invoice->user->id ?? null }}">{{ $invoice->total_courier ?? 0 }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="8" class="text-right">China Local Delivery</td>
                                <td class="text-center align-middle"><span
                                        data-user="{{ $invoice->user->id ?? null }}">{{ $invoice->chinalocal ?? 0 }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="8" class="text-right">Packing Cost</td>
                                <td class="text-center align-middle"><span
                                        data-user="{{ $invoice->user->id ?? null }}">{{ $invoice->packing_cost ?? 0 }}</span>
                                </td>
                            </tr>
                            @php
                                $total_sub = $invoice->total_courier + $subtotal + $invoice->chinalocal + $invoice->packing_cost;
                                $due = abs($total_sub) - abs($invoice->paid);
                                
                            @endphp
                            <tr>
                                <td colspan="8" class="text-right">Subtotal</td>
                                <td class="text-center align-middle"><span
                                        data-user="{{ $invoice->user->id ?? null }}">{{ $total_sub }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="8" class="text-right">Paid</td>
                                <td class="text-center align-middle"><span
                                        data-user="{{ $invoice->user->id ?? null }}">{{ $invoice->paid ?? 0 }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="8" class="text-right">Due</td>
                                <td class="text-center align-middle"><span
                                        data-user="{{ $invoice->user->id ?? null }}">{{ $due ?? 0 }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="8" class="text-right">Total Payable</td>
                                <td class="text-center align-middle"><span
                                        data-user="{{ $invoice->user->id ?? null }}">{{ round($due) ?? 0 }}</span>
                                </td>
                            </tr>
                        </tfoot>
                    </table>


                </div>
            </div>
            <div class="clear_both"></div>
        </div>

        <footer style="margin-top: 70px;">
            <td class="p_txt_12">
                <div class="p_txt_13">
                    <p class="p_txt_14">&nbsp;&nbsp;&nbsp;&nbsp; Customer Signature</p>
                </div>
                <div class="p_txt_13">
                    <p>&nbsp;</p>
                </div>
                <div class="p_txt_13">
                    <p>&nbsp;</p>
                </div>
                <p class="p_txt_14">Authorized Signature</p>
            </td>
        </footer>
        <div class="p_txt_16 no_print">
            <hr>
            <span class="pull-right col-xs-12">
                <button onclick="window.print();" class="btn btn-block btn-primary">Print</button> </span>
            <div class="clear_both"></div>
            <div class="p_txt_17">
                <div class="p_txt_18">
                    Please follow these steps before you print for first tiem:
                </div>
                <p class="p_txt_19">
                    1. Disable Header and Footer in browser's print setting<br>
                    For Firefox: File &gt; Page Setup &gt; Margins &amp; Header/Footer &gt; Headers & Footers &gt; Make
                    all
                    --blank--<br>
                    For Chrome: Menu &gt; Print &gt; Uncheck Header/Footer in More Options
                </p>
                <p class="p_txt_19">
                    2. Set margin 0.5<br>
                    For Firefox: File &gt; Page Setup &gt; Margins &amp; Header/Footer &gt; Headers & Footers &gt;
                    Margins
                    (inches) &gt; set all margins
                    0.5<br>
                    For Chrome: Menu &gt; Print &gt; Set Margins to Default
                </p>
            </div>
            <div class="clear_both"></div>
        </div>
    </div>
    <script src="{{ asset('assets/plugins/print/print/jquery-2.0.3.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/print/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/print/print/custom.js') }}"></script>
    {{-- <script src="{{ asset('assets/plugins/print/onload_print.js') }}"></script> --}}

</body>

</html>
