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
                                <th scope="col" class="text-center">Carton Qty</th>
                                <th scope="col" class="text-center">Carton Number</th>
                                <th scope="col" class="text-center">Products</th>
                                <th scope="col" class="text-center">Product Qty</th>
                                <th scope="col" class="text-center">Carton Weight</th>
                                <th scope="col" class="text-center">Remarks</th>
                                <th scope="col" class="text-center">Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @php
                            $cartons = $booking->cartons;
                            $carton_number = [];
                            $shipping_mark = [];
                            $shipping_number = [];
                            $actual_weight = null;
                            $tracking_id = [];
                            foreach ($cartons as $key => $value) {
                            $carton_number = $value->carton_number;
                            $shipping_mark = $value->shipping_mark;
                            $shipping_number = $value->shipping_number;
                            $actual_weight = $value->actual_weight;
                            $tracking_id = $value->tracking_id;
                            }
                            @endphp --}}

                            <tr>
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
                            </tr>

                        </tbody>
                        <tfoot id="invoiceFooter">
                            <tr>
                                <td colspan="7" class="text-right">Subtotal</td>
                                <td class="text-center align-middle"><span
                                        data-user="{{ $invoice->user->id }}">{{ round($invoice->amount) ?? 0 }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="7" class="text-right">Courier Bill</td>
                                <td class="text-center align-middle"><span
                                        data-user="{{ $invoice->user->id }}">{{ round($invoice->total_courier) ?? 0 }}</span>
                                </td>
                            </tr>
                            @php
                                $total_sub = round($invoice->total_courier) + round($invoice->amount);
                                $due = $total_sub - round($invoice->paid);
                            @endphp
                            <tr>
                                <td colspan="7" class="text-right">Subtotal</td>
                                <td class="text-center align-middle"><span
                                        data-user="{{ $invoice->user->id }}">{{ $total_sub }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="7" class="text-right">Paid</td>
                                <td class="text-center align-middle"><span
                                        data-user="{{ $invoice->user->id }}">{{ $invoice->paid ?? 0 }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="7" class="text-right">Due</td>
                                <td class="text-center align-middle"><span
                                        data-user="{{ $invoice->user->id }}">{{ $due ?? 0 }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="7" class="text-right">Total Payable</td>
                                <td class="text-center align-middle"><span
                                        data-user="{{ $invoice->user->id }}">{{ $invoice->total_payable }}</span>
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
