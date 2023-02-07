<div class="modal fade" id="generateInvoiceModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog  modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Generate Invoice</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.invoice.store') }}" method="POST">
                    @csrf
                    <div class="hiddenField">
                        {{-- hidden input field append here --}}
                    </div>

                    <table class="table table-bordered text-center">
                        <thead>
                            <tr>
                                <th scope="col">Customer</th>
                                <th scope="col">Products</th>
                                <th scope="col">Shipping Mark</th>
                                <th scope="col">Carton Number</th>
                                <th scope="col">Shipping Number</th>
                                <th scope="col">Status</th>
                                <th scope="col">Weight</th>
                                <th scope="col">Unit Price</th>
                                <th scope="col">Amount</th>
                            </tr>
                        </thead>
                        <tbody id="invoiceItem"></tbody>
                        <tfoot id="invoiceFooter">
                            <tr>
                                <td colspan="8" class="text-right">Total Amount</td>
                                <td class="align-middle"><span class="total_due">0.00</span></td>
                                <div class="totalDue">
                                    {{-- hidden input field append here --}}
                                </div>
                            </tr>
                            <tr>
                                <td colspan="8" class="align-middle text-right">
                                    <div class="row">
                                        <div class="col">
                                            @php
                                                $payment_method = [
                                                    '' => '- Payment Method -',
                                                    'Cash' => 'Cash',
                                                    'Bkash' => 'Bkash',
                                                    'Cash on Delivery' => 'Cash on Delivery',
                                                    'Bank' => 'Bank',
                                                    'sslcommerz' => 'SSLcommerz',
                                                    'Nagod' => 'Nagod',
                                                    'Rocket' => 'Rocket',
                                                    'others' => 'Others',
                                                ];
                                            @endphp
                                            {{ html()->select('payment_method', $payment_method)->class('form-control')->required() }}
                                        </div>
                                        <div class="col">
                                            @php
                                                $delivery_method = [
                                                    '' => '- Delivery Method -',
                                                    'office_delivery' => 'Office Delivery',
                                                    'sundarban' => 'Sundarban',
                                                    'sa_poribohon' => 'SA Poribohon',
                                                    'papperfly' => 'Papperfly',
                                                    'pathao' => 'Pathao',
                                                    'tiger' => 'Tiger',
                                                    'others' => 'Others',
                                                ];
                                            @endphp
                                            {{ html()->select('delivery_method', $delivery_method)->class('form-control')->required() }}
                                        </div>
                                        <div class="col">
                                            <p class="courier_bill_text m-0" style="display: none">
                                                Courier Bill <a href="#"
                                                    class="ml-3 removeCourierBtn text-danger">Remove</a>
                                            </p>
                                            <div class="input-group courierSubmitForm">
                                                <input type="text" class="form-control" placeholder="Courier Bill"
                                                    aria-label="Courier Bill" name="total_courier"
                                                    aria-describedby="Courier-addon2">
                                                <div class="input-group-append applyCourierBtn" style="cursor: pointer">
                                                    <span class="input-group-text" id="Courier-addon2">Apply</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div> <!-- row -->
                                </td>
                                <td class="align-middle"><span class="courier_bill">0.00</span></td>
                            </tr>
                            <tr>
                                <div class="row">
                                    <td colspan="8">
                                        <div class="col-4 float-right">
                                            <p class="packing_cost_text m-0 text-right" style="display: none">
                                                Packing Cost <a href="#"
                                                    class="ml-3 removePackingBtn text-danger">Remove</a>
                                            </p>
                                            <div class="input-group packingSubmitForm">
                                                <input type="text" class="form-control" placeholder="Packing Cost"
                                                    aria-label="Packing Cost" name="packing_cost"
                                                    aria-describedby="Packing-addon2">
                                                <div class="input-group-append applyPackingrBtn"
                                                    style="cursor: pointer">
                                                    <span class="input-group-text" id="Packing-addon2">Apply</span>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle"><span class="packing_cost">0.00</span></td>
                                </div>
                            </tr>
                            <tr>
                                <div class="row">
                                    <td colspan="8">
                                        <div class="col-4 float-right">
                                            <p class="chinalocal_text m-0 text-right" style="display: none">
                                                China Local Delivery <a href="#"
                                                    class="ml-3 removeChinalocalBtn text-danger">Remove</a>
                                            </p>
                                            <div class="input-group chinalocalSubmitForm">
                                                <input type="text" class="form-control"
                                                    placeholder="China Local Delivery" aria-label="Packing Cost"
                                                    name="chinalocal" aria-describedby="Chinalocal-addon2">
                                                <div class="input-group-append applyChinalocalBtn"
                                                    style="cursor: pointer">
                                                    <span class="input-group-text" id="Chinalocal-addon2">Apply</span>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle"><span class="chinalocal">0.00</span></td>
                                </div>
                            </tr>
                            <tr>
                                <div class="row">
                                    <td colspan="8">
                                        <div class="col-4 float-right">
                                            <p class="paid_text m-0 text-right" style="display: none">
                                                Paid <a href="#"
                                                    class="ml-3 removePaidBtn text-danger">Remove</a>
                                            </p>
                                            <div class="input-group paidSubmitForm">
                                                <input type="text" class="form-control" placeholder="Paid"
                                                    aria-label="Paid" name="paid"
                                                    aria-describedby="Paidlocal-addon2">
                                                <div class="input-group-append applyPaidBtn" style="cursor: pointer">
                                                    <span class="input-group-text" id="Paid-addon2">Apply</span>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle"><span class="paid">0.00</span></td>
                                </div>
                            </tr>

                            <tr>
                                <td colspan="8" class="text-right">Total Payable</td>
                                <td class="align-middle"><span class="total_payable">0.00</span></td>
                                <div class="totalPay">
                                    {{-- hidden input field append here --}}
                                </div>
                                <div id="packing">
                                    {{-- hidden input field append here --}}
                                </div>
                                <div id="localdelivery">
                                    {{-- hidden input field append here --}}
                                </div>
                                <div id="courier">
                                    {{-- hidden input field append here --}}
                                </div>
                                <div class="product_name">
                                    {{-- hidden input field append here --}}
                                </div>
                                <div class="carton">
                                    {{-- hidden input field append here --}}
                                </div>
                                <div class="weight">
                                    {{-- hidden input field append here --}}
                                </div>
                                <div class="unit">
                                    {{-- hidden input field append here --}}
                                </div>
                                <div class="total_pay">
                                    {{-- hidden input field append here --}}
                                </div>

                            </tr>
                        </tfoot>
                    </table>
            </div>
            <div class="modal-footer justify-content-start">
                <button type="submit" class="btn btn-success" id="generateSubmitBtn">Generate
                </button>
                </form>
                <button type="button" data-dismiss="modal" class="btn btn-primary">Cancel</button>
            </div>

        </div>
    </div>
</div> <!-- changeStatusButton -->
