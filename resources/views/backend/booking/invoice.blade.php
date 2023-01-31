<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Invoice No : {{ $invoice->invoice_id }}</title>

    {{-- <link rel="stylesheet" href="{{ asset('assets/plugins/print/font-awesome/css/font-awesome.min.css') }}"> --}}
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
                        $track = [];
                        $actualWeight = [];
                        $amount = $invoice->total_weight * $invoice->unit_price;
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
                        if ($invoice->tracking_number != null) {
                            $track = explode(',', $invoice->tracking_number);
                        }
                        if ($invoice->actual_weight != null) {
                            $actualWeight = explode(',', $invoice->actual_weight);
                        }
                        
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
                                    <td class="p_txt_6"><b>{{ $invoice->customer_name ?? 'N/A' }}</b></td>
                                </tr>
                                <tr>
                                    <td class="p_txt_5"><b>Phone:</b></td>
                                    <td class="p_txt_6">{{ $invoice->customer_phone ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <td class="p_txt_5"><b>Address:</b></td>
                                    <td class="p_txt_6">{{ $invoice->customer_address ?? 'N/A' }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col" class="text-center">Date</th>
                                <th scope="col" class="text-center">Product Name</th>
                                <th scope="col" class="text-center">Shipping Mark</th>
                                <th scope="col" class="text-center">Carton Number</th>
                                <th scope="col" class="text-center">Shipping Number</th>
                                <th scope="col" class="text-center">Carton Qty</th>
                                <th scope="col" class="text-center">Total Weight</th>
                                <th scope="col" class="text-center">Unit Price</th>
                                <th scope="col" class="text-center">Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- <tr>
                                <td class="text-center align-middle">
                                    {{ date('m/d/Y', strtotime($invoice->created_at)) }}
                                </td>
                                <td class="text-center align-middle">{{ $invoice->carton_qty ?? '00' }}</td>
                                <td class="text-center align-middle">{{ $invoice->carton_number ?? '0' }}</td>
                                <td class="text-center align-middle">{{ $invoice->product_name ?? 'N/A' }}</td>
                                <td class="text-center align-middle">{{ $invoice->product_qty ?? 'N/A' }}</td>
                                <td class="text-center align-middle">{{ $invoice->actual_weight }}</td>
                                <td class="text-center align-middle">{{ $invoice->remarks }}</td>
                                <td class="text-center align-middle">{{ $invoice->amount }}</td>
                            </tr> --}}

                            <tr>
                                <td class="text-center align-middle">
                                    {{ date('m/d/Y', strtotime($invoice->created_at)) }}
                                </td>
                                <td class="text-center align-middle">

                                    @foreach ($product as $p_name)
                                        <table>
                                            <tr>
                                                {{ $p_name }}
                                            </tr>
                                        </table>
                                    @endforeach

                                </td>
                                <td class="text-center align-middle">
                                    @foreach ($shipMark as $ship)
                                        <table>
                                            <tr>
                                                {{ $ship }}
                                            </tr>
                                        </table>
                                    @endforeach
                                </td>
                                <td class="text-center align-middle">
                                    @foreach ($carton as $cart)
                                        <table>
                                            <tr>
                                                {{ $cart }}
                                            </tr>
                                        </table>
                                    @endforeach
                                </td>
                                <td class="text-center align-middle">
                                    @foreach ($shipNo as $ship)
                                        <table>
                                            <tr>
                                                {{ $ship }}
                                            </tr>
                                        </table>
                                    @endforeach
                                </td>
                                <td class="text-center align-middle">{{ $invoice->carton_qty ?? '00' }}</td>
                                <td class="text-center align-middle">{{ $invoice->total_weight ?? '00' }}</td>
                                <td class="text-center align-middle">{{ $invoice->unit_price ?? '00' }}</td>
                                <td class="text-center align-middle">{{ $amount }}</td>

                            </tr>

                        </tbody>
                        <tfoot id="invoiceFooter">
                            <tr>
                                <td colspan="8" class="text-right">Subtotal</td>
                                <td class="text-center align-middle"><span
                                        data-user="{{ $invoice->user->id }}">{{ $amount ?? 0 }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="8" class="text-right">Courier Bill</td>
                                <td class="text-center align-middle"><span
                                        data-user="{{ $invoice->user->id }}">{{ round($invoice->total_courier) ?? 0 }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="8" class="text-right">China Local Delivery</td>
                                <td class="text-center align-middle"><span
                                        data-user="{{ $invoice->user->id }}">{{ round($invoice->chinalocal) ?? 0 }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="8" class="text-right">Packing Cost</td>
                                <td class="text-center align-middle"><span
                                        data-user="{{ $invoice->user->id }}">{{ round($invoice->packing_cost) ?? 0 }}</span>
                                </td>
                            </tr>
                            @php
                                $total_sub = round($invoice->total_courier) + round($amount) + round($invoice->chinalocal) + round($invoice->packing_cost);
                                $due = $total_sub - round($invoice->paid);
                                $payable = round($total_sub) - round($due);
                                
                            @endphp
                            <tr>
                                <td colspan="8" class="text-right">Subtotal</td>
                                <td class="text-center align-middle"><span
                                        data-user="{{ $invoice->user->id }}">{{ $total_sub }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="8" class="text-right">Paid</td>
                                <td class="text-center align-middle"><span
                                        data-user="{{ $invoice->user->id }}">{{ $invoice->paid ?? 0 }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="8" class="text-right">Due</td>
                                <td class="text-center align-middle"><span
                                        data-user="{{ $invoice->user->id }}">{{ $due ?? 0 }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="8" class="text-right">Total Payable</td>
                                <td class="text-center align-middle"><span
                                        data-user="{{ $invoice->user->id }}">{{ $payable }}</span>
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
        {{-- @dd('hi'); --}}
    </div>
    <script src="{{ asset('assets/plugins/print/print/jquery-2.0.3.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/print/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/print/print/custom.js') }}"></script>
    {{-- <script src="{{ asset('assets/plugins/print/onload_print.js') }}"></script> --}}

</body>

</html>
