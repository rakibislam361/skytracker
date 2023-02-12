import axios from "axios";
import { isEmpty } from "lodash";
const { message } = require("laravel-mix/src/Log");
const { parse } = require("postcss");

$(function () {
    var i = 0;
    let itemNumber = 0;

    $("body")
        .on("click", "#add-carton-btn", function (e) {
            e.preventDefault();
            ++i;
            var input_element = `<tr>
                                    <td>
                                      <input type="text" name="carton_number[]" placeholder="carton number" class="form-control" />
                                    </td>

                                   <td class="text-right" style="width:1%"> 
                                   <button type="button" id="add-carton-btn" class="btn btn-outline-success">+</button></td>

                                      <td class="text-right" style="width:1%"> 
                                      <button type="button" class="btn btn-outline-danger remove-tr">-</button></td> 
                                                                   
                                 </tr>`;

            $("#carton-number").append(input_element);
        })

        .on("click", "#add-weight-btn", function (e) {
            e.preventDefault();
            ++i;
            var weight = `<tr>
                                    <td>
                                      <input type="text" name="actual_weight[]" id="weights" placeholder="carton weight" class="form-control" />
                                    </td>

                                   <td class="text-right" style="width:1%"> 
                                   <button type="button" id="add-weight-btn" class="btn btn-outline-success">+</button></td>

                                      <td class="text-right" style="width:1%"> 
                                      <button type="button" class="btn btn-outline-danger remove-tr">-</button></td> 
                                                                   
                                 </tr>`;

            $("#booking-weight").append(weight);
        })

        .on("click", "#add-productName-btn", function (e) {
            e.preventDefault();
            ++i;
            var input_element = `<tr>
                                    <td>
                                      <input type="text" name="othersProductName[]" placeholder="product name" class="form-control" />
                                    </td>

                                   <td class="text-right" style="width:1%"> 
                                   <button type="button" id="add-productName-btn" class="btn btn-outline-success">+</button></td>

                                      <td class="text-right" style="width:1%"> 
                                      <button type="button" class="btn btn-outline-danger remove-tr">-</button></td> 
                                                                   
                                 </tr>`;

            $("#product-name").append(input_element);
        })
        .on("click", "#add-shipping-mark-btn", function (e) {
            e.preventDefault();
            ++i;
            var input_element = `<tr>
                                   <td><input type="text" required="" name="shipping_mark[]"
                                                placeholder="shipping mark" class="form-control" /></td>
                                        <td class="text-right" style="width:1%"> <button type="button"
                                                id="add-shipping-mark-btn" class="btn btn-outline-success">+</button></td>
                                        <td class="text-right" style="width:1%"> <button type="button"
                                                class="btn btn-outline-danger remove-tr">-</button></td>
                                                                   
                                 </tr>`;

            $("#shipping-mark").append(input_element);
        })
        .on("click", "#add-shipping-number-btn", function (e) {
            e.preventDefault();
            ++i;
            var input_element = `<tr>
                                    <td><input type="text" name="shipping_number[]" placeholder="shipping number"
                                                class="form-control" /></td>
                                        <td class="text-right" style="width:1%"> <button type="button"
                                                id="add-shipping-number-btn" class="btn btn-outline-success">+</button>
                                        </td>
                                        <td class="text-right" style="width:1%"> <button type="button"
                                                class="btn btn-outline-danger remove-tr">-</button></td>
                                                                   
                                 </tr>`;

            $("#shipping-number").append(input_element);
        })
        .on("click", "#add-tracking-id-btn", function (e) {
            e.preventDefault();
            ++i;
            var input_element = `<tr>
                                   <td><input type="text" name="tracking_id[]" placeholder="tracking number"
                                                class="form-control" /></td>
                                        <td class="text-right" style="width:1%"> <button type="button"
                                                id="add-tracking-id-btn" class="btn btn-outline-success">+</button>
                                        </td>
                                        <td class="text-right" style="width:1%"> <button type="button"
                                                class="btn btn-outline-danger remove-tr">-</button></td>
                                                                   
                                 </tr>`;

            $("#tracking-id").append(input_element);
        })

        .on("click", "#add-new-book", function (e) {
            e.preventDefault();
            ++i;
            var input_element = `  <tr>
                                <td>                                   
                                    <div class="row">

                                        <div class="form-group col-md-6">
                                            <label for="date">Date</label>
                                            <input type="date" name="date[]" class="form-control"
                                                placeholder="approx date" value="{{ now()->format('Y-m-d') }}">
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="shipping_mark">Shipping Mark</label>
                                            <input type="text" name="shipping_mark[]" placeholder="shipping mark"
                                                class="form-control" />
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="othersProductName">Product Name</label>
                                            <input type="text" name="othersProductName[]" placeholder="product name"
                                                class="form-control" />
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="productQuantity">Product Quantity</label>
                                            <input type="text" name="productQuantity[]" class="form-control"
                                                placeholder="product quantity">
                                        </div>
                                    </div>

                                    <div class="row">

                                        <div class="form-group col-md-6">
                                            <label for="ctnQuantity">Carton Quantity</label>
                                            <input type="text" name="ctnQuantity[]" class="form-control"
                                                placeholder="quantity">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="totalCbm">Total Cbm</label>
                                            <input type="text" name="totalCbm[]" class="form-control"
                                                placeholder="total CBM">
                                        </div>


                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="actual_weight">Products Weight</label>
                                            <input type="text" name="actual_weight[]" placeholder="carton weight"
                                                id="weights" class="form-control" />
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="tracking_number">Tracking Number</label>
                                            <input type="text" name="tracking_number[]" placeholder="tracking number"
                                                class="form-control" />
                                        </div>

                                    </div>


                                    <div class="row">


                                        <div class="form-group col-md-6">
                                            <label for="shipping_number">Shipping Number</label>
                                            <input type="text" name="shipping_number[]" placeholder="shipping number"
                                                class="form-control" />

                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="productsTotalCost">Products Total Cost</label>
                                            <input type="text" name="productsTotalCost[]" class="form-control"
                                                placeholder="products total Cost(BDT)">
                                        </div>
                                    </div>


                                    <div class="row">


                                        <div class="form-group col-md-6">
                                            <label for="unit_price">Unit Price/kg</label>
                                            <input type="text" name="unit_price[]" class="form-control"
                                                placeholder="unit price/kg">
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="remarks">Remarks</label>
                                            <input type="text" name="remarks[]" class="form-control"
                                                placeholder="remarks">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="chinalocal">China Local Delivery</label>
                                            <input type="text" name="chinalocal[]" class="form-control"
                                                placeholder="china local delivery">
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="packing_cost">Packing Cost</label>
                                            <input type="text" name="packing_cost[]" class="form-control"
                                                placeholder="packing cost">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="courier_bill">Courier Bill</label>
                                            <input type="text" name="courier_bill[]" class="form-control"
                                                placeholder="courier bill">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="paid">Paid</label>
                                            <input type="double" name="paid[]" class="form-control"
                                                placeholder="paid">
                                        </div>
                                    </div>

                                    <div class="row">

                                        <div class="form-group col-md-12">
                                            <label for="status">Products Status</label>
                                            <select class="form-control" name="status[]">
                                                <option value="">Select</option>
                                                <option value="received-in-china-warehouse">Received in china warehouse
                                                </option>
                                                <option value="shipped-from-china-warehouse">Shipped from china warehouse
                                                </option>
                                                <option value="received-in-BD-warehouse">Received in BD warehouse</option>
                                                <option value="delivered">Delivered</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label for="customer_name">Customer Name</label>
                                            <input type="text" name="customer_name[]" class="form-control"
                                                placeholder="customer name">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="customer_phone">Customer Phone</label>
                                            <input type="text" name="customer_phone[]" class="form-control"
                                                placeholder="customer phone">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="customer_address">Customer Address</label>
                                            <input type="text" name="customer_address[]" class="form-control"
                                                placeholder="customer address">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6" style="margin-top:35px">
                                            <button class="btn btn-outline-success" id="add-new-book" type="button">+ Add
                                            Product</button>
                                            <button class="btn btn-outline-danger remove-tr" id="remove-new-book"
                                            type="button">- Remove</button>
                                        </div>

                                    </div>
                                </td>
                            </tr>`;

            $("#add-booking").append(input_element);
        })

        .on("click", ".remove-tr", function (e) {
            e.preventDefault();
            $(this).parents("tr").remove();
        })
        .on("click", "#remove-new-book", function (e) {
            e.preventDefault();
            $(this).parents("tr").remove();
        });
});
function generate_process_related_data() {
    var invoiceFooter = $("#invoiceFooter");
    var courier_bill = invoiceFooter.find(".courier_bill").text();
    var payment_method = invoiceFooter.find("#payment_method").val();
    var delivery_method = invoiceFooter.find("#delivery_method").val();
    var total_payable = invoiceFooter.find(".total_payable").text();
    var total_due = invoiceFooter.find(".total_due").text();
    var customer_id = invoiceFooter.find(".total_payable").attr("data-user");
    var isNotify = $("#notifyUser").is(":checked") ? 1 : 0;
    var related_data = {};
    related_data.courier_bill = courier_bill;
    related_data.payment_method = payment_method;
    related_data.delivery_method = delivery_method;
    related_data.total_due = total_due;
    related_data.total_payable = total_payable;
    related_data.user_id = customer_id;
    related_data.isNotify = isNotify;
    return related_data;
}

$(function () {
    const body = $(document);

    $(document).on("click", ".applyCourierBtn", function () {
        let courier_bill = $(this)
            .closest(".input-group")
            .find(".form-control")
            .val();
        let total_due = $("#invoiceFooter").find(".total_due").text();
        let packing = $("#invoiceFooter").find(".packing_cost").text();
        let local = $("#invoiceFooter").find(".chinalocal").text();
        let paid = $("#invoiceFooter").find(".paid").text();
        let total_payable =
            Number(courier_bill) +
            Number(total_due) +
            Number(packing) +
            Number(local) -
            Number(paid);
        $("#invoiceFooter")
            .find(".courier_bill")
            .text(Number(courier_bill).toFixed(2));
        $("#invoiceFooter")
            .find(".total_payable")
            .text(Number(total_payable).toFixed(2));

        $(".courier_bill_text").show();
        $(".courierSubmitForm").hide();
    });

    $(document).on("keyup", ".actual_weight", function () {
        let total = 0;
        let weight = $(this).val();
        let product_id = $(this).attr("id2");
        let unit_price = $("#unit_price_" + product_id).val();
        let amount = Math.round(Number(weight) * Number(unit_price));
        $("#amount_" + product_id).val(amount);
        let val = 0;
        $(".invoiceTable tbody tr").each(function () {
            val += parseInt($(this).find(".amount").val());
        });
        $("#invoiceFooter").find(".total_due").text(Number(val).toFixed(2));
        let packing = $("#invoiceFooter").find(".packing_cost").text();
        let local = $("#invoiceFooter").find(".chinalocal").text();
        let paid = $("#invoiceFooter").find(".paid").text();
        let courier_bill = $("#invoiceFooter").find(".courier_bill").text();
        let total_payable =
            Number(courier_bill) +
            Number(val) +
            Number(packing) +
            Number(local) -
            Number(paid);
        $("#invoiceFooter")
            .find(".total_payable")
            .text(Number(total_payable).toFixed(2));
    });

    $(document).on("keyup", ".unit_price", function () {
        let unit_price = $(this).val();
        let product_id = $(this).attr("id2");
        let weight = (weight = $("#actual_weight_" + product_id).val());
        let amount = Math.round(Number(weight) * Number(unit_price));

        $("#amount_" + product_id).val(amount);

        let val = 0;

        $(".invoiceTable tbody tr").each(function () {
            val += parseInt($(this).find(".amount").val());
        });
        $("#invoiceFooter").find(".total_due").text(Number(val).toFixed(2));
        let packing = $("#invoiceFooter").find(".packing_cost").text();
        let local = $("#invoiceFooter").find(".chinalocal").text();
        let paid = $("#invoiceFooter").find(".paid").text();
        let courier_bill = $("#invoiceFooter").find(".courier_bill").text();
        let total_payable =
            Number(courier_bill) +
            Number(val) +
            Number(packing) +
            Number(local) -
            Number(paid);
        $("#invoiceFooter")
            .find(".total_payable")
            .text(Number(total_payable).toFixed(2));
    });

    $(document).on("click", ".removeCourierBtn", function () {
        $(this).closest("div").find(".form-control").val("");
        $("#invoiceFooter").find(".courier_bill").text(0.0);

        let total_due = $("#invoiceFooter").find(".total_due").text();
        let courier_bill = $("#invoiceFooter").find(".courier_bill").text();
        let packing = $("#invoiceFooter").find(".packing_cost").text();
        let local = $("#invoiceFooter").find(".chinalocal").text();
        let paid = $("#invoiceFooter").find(".paid").text();

        let total_payable =
            Number(total_due) -
            Number(courier_bill) +
            Number(packing) +
            Number(local) -
            Number(paid);
        $("#invoiceFooter")
            .find(".total_payable")
            .text(Number(total_payable).toFixed(2));
        $(".courier_bill_text").hide();
        $(".courierSubmitForm").show();
    });

    $(document).on("click", ".applyPackingrBtn", function () {
        let packing_cost = $(this)
            .closest(".input-group")
            .find(".form-control")
            .val();
        let total_due = $("#invoiceFooter").find(".total_due").text();
        let courier = $("#invoiceFooter").find(".courier_bill").text();
        let local = $("#invoiceFooter").find(".chinalocal").text();
        let paid = $("#invoiceFooter").find(".paid").text();
        let total_payable =
            Number(packing_cost) +
            Number(total_due) +
            Number(courier) +
            Number(local) -
            Number(paid);
        $("#invoiceFooter")
            .find(".packing_cost")
            .text(Number(packing_cost).toFixed(2));
        $("#invoiceFooter")
            .find(".total_payable")
            .text(Number(total_payable).toFixed(2));

        $(".packing_cost_text").show();
        $(".packingSubmitForm").hide();
    });

    $(document).on("click", ".removePackingBtn", function () {
        $(this).closest("div").find(".form-control").val("");
        $("#invoiceFooter").find(".packing_cost").text(0.0);

        let total_due = $("#invoiceFooter").find(".total_due").text();
        let courier_bill = $("#invoiceFooter").find(".courier_bill").text();
        let packing = $("#invoiceFooter").find(".packing_cost").text();
        let local = $("#invoiceFooter").find(".chinalocal").text();
        let paid = $("#invoiceFooter").find(".paid").text();

        let total_payable =
            Number(total_due) +
            Number(courier_bill) -
            Number(packing) +
            Number(local) -
            Number(paid);
        $("#invoiceFooter")
            .find(".total_payable")
            .text(Number(total_payable).toFixed(2));
        $(".packing_cost_text").hide();
        $(".packingSubmitForm").show();
    });
    $(document).on("click", ".applyChinalocalBtn", function () {
        let chinalocal = $(this)
            .closest(".input-group")
            .find(".form-control")
            .val();
        let total_due = $("#invoiceFooter").find(".total_due").text();
        let courier_bill = $("#invoiceFooter").find(".courier_bill").text();
        let packing = $("#invoiceFooter").find(".packing_cost").text();
        let paid = $("#invoiceFooter").find(".paid").text();
        let total_payable =
            Number(chinalocal) +
            Number(total_due) +
            Number(courier_bill) +
            Number(packing) -
            Number(paid);
        $("#invoiceFooter")
            .find(".chinalocal")
            .text(Number(chinalocal).toFixed(2));
        $("#invoiceFooter")
            .find(".total_payable")
            .text(Number(total_payable).toFixed(2));

        $(".chinalocal_text").show();
        $(".chinalocalSubmitForm").hide();
    });
    $(document).on("click", ".applyPaidBtn", function () {
        let paid = $(this).closest(".input-group").find(".form-control").val();
        let amount = $("#invoiceFooter").find(".total_due").text();
        let courier_bill = $("#invoiceFooter").find(".courier_bill").text();
        let packing = $("#invoiceFooter").find(".packing_cost").text();
        let chinalocal = $("#invoiceFooter").find(".chinalocal").text();

        let total_payable =
            Number(chinalocal) +
            Number(amount) +
            Number(courier_bill) +
            Number(packing) -
            Number(paid);
        $("#invoiceFooter").find(".paid").text(Number(paid).toFixed(2));
        $("#invoiceFooter")
            .find(".total_payable")
            .text(Number(total_payable).toFixed(2));

        $(".paid_text").show();
        $(".paidSubmitForm").hide();
    });

    $(document).on("click", ".removePaidBtn", function () {
        $(this).closest("div").find(".form-control").val("");
        $("#invoiceFooter").find(".paid").text(0.0);

        let total_due = $("#invoiceFooter").find(".total_due").text();
        let courier_bill = $("#invoiceFooter").find(".courier_bill").text();
        let packing = $("#invoiceFooter").find(".packing_cost").text();
        let local = $("#invoiceFooter").find(".chinalocal").text();
        let paid = $("#invoiceFooter").find(".paid").text();

        let total_payable =
            Number(total_due) +
            Number(courier_bill) +
            Number(packing) +
            Number(local) -
            Number(paid);

        $("#invoiceFooter")
            .find(".total_payable")
            .text(Number(total_payable).toFixed(2));
        $(".paid_text").hide();
        $(".paidSubmitForm").show();
    });
    $(document).on("click", ".removeChinalocalBtn", function () {
        $(this).closest("div").find(".form-control").val("");
        $("#invoiceFooter").find(".chinalocal").text(0.0);

        let total_due = $("#invoiceFooter").find(".total_due").text();
        let courier_bill = $("#invoiceFooter").find(".courier_bill").text();
        let packing = $("#invoiceFooter").find(".packing_cost").text();
        let local = $("#invoiceFooter").find(".chinalocal").text();
        let paid = $("#invoiceFooter").find(".paid").text();

        let total_payable =
            Number(total_due) +
            Number(courier_bill) +
            Number(packing) -
            Number(local) -
            Number(paid);

        $("#invoiceFooter")
            .find(".total_payable")
            .text(Number(total_payable).toFixed(2));
        $(".chinalocal_text").hide();
        $(".chinalocalSubmitForm").show();
    });

    function enable_proceed_button() {
        $("#changeGroupStatusButtonBook").removeAttr("disabled");
        $("#InvoiceButtonBook").removeAttr("disabled");
    }

    function disabled_proceed_button() {
        $("#changeGroupStatusButtonBook").attr("disabled", "disabled");
        $("#InvoiceButtonBook").attr("disabled", "disabled");
    }
    $(document).on("change", "#allSelectCheckboxBook", function () {
        var tbodyCheckbox = $("tbody").find("input.checkboxItemBook");
        if ($(this).is(":checked")) {
            tbodyCheckbox.prop("checked", true);
            enable_proceed_button();
        } else {
            tbodyCheckbox.prop("checked", false);
            disabled_proceed_button();
        }
    });
    $(document).on("change", "input.checkboxItemBook", function () {
        var checked_item = $("input.checkboxItemBook:checked").length;
        var uncheck_item = $('input.checkboxItemBook:not(":checked")').length;

        if (uncheck_item == 0) {
            $("#allSelectCheckboxBook").prop("checked", true);
        } else {
            $("#allSelectCheckboxBook").prop("checked", false);
        }
        if (checked_item > 0) {
            enable_proceed_button();
        } else {
            disabled_proceed_button();
        }
    });
    $(document).on("click", "#changeGroupStatusButtonBook", function () {
        var changeStatusModal = $("#changeStatusButtonBook");
        var hiddenField = changeStatusModal.find(".hiddenFieldBook");
        var hiddenInput = "";

        $("input.checkboxItemBook:checked").each(function (index) {
            hiddenInput += `<input type="hidden" name="booking_id[]" value="${$(
                this
            ).val()}">`;
        });
        hiddenField.html(hiddenInput);
        changeStatusModal.modal("show");
        $("#statusChargeForm").trigger("reset");
    });

    $(document).on("hidden.bs.modal", "#generateInvoiceModal", function () {
        var hiddenInput = "";
        $(".invoiceItem").html(hiddenInput);
    });

    $(document).on("click", "#InvoiceButtonBook", function () {
        var hiddenInput = "";
        var generate = false;
        var total_amount = 0;
        let packing = null;
        let local = null;
        let courier = null;
        $("input.checkboxItemBook:checked").each(function (index) {
            var item = $(this).data("value");
            var status = item.status;
            if (status == "received-in-BD-warehouse" || status == "delivered") {
                generate = true;
            }
            if (generate) {
                if (item.amount) {
                    total_amount += item.amount;
                }

                hiddenInput = `<tr>
                          <td class=" align-middle">${item.customer_name}</td>
                            <td class=" align-middle">
                                <div class="col">                                                                                    
                                        <input type="text" class="form-control" placeholder="product"
                                            aria-label="Product Name" id="othersProductName" name="othersProductName[]" value=${item.othersProductName}>                                                                        
                                    </div>
                                </div>
                            </td>
                          <td class=" align-middle">${item.shipping_mark}</td>
                          <td class="align-middle">                         
                                            <div class="col">
                                                <input type="text" class="form-control" placeholder="carton"
                                                    aria-label="Carton" id="carton_number" name="carton_number[]" value=${item.cartons.carton_number}
                                                    aria-describedby="carton-addon2">
                                               
                                                
                                            </div></td>
                           <td class=" align-middle">${item.shipping_number}</td>
                          <td class=" align-middle">${item.status}</td>
                          <td class="text-right align-middle">
                                                <div class="col">

                                                   
                                                <input type="text" class="form-control actual_weight" placeholder="actual weight"
                                                    aria-label="Carton" id="actual_weight_${item.id}" id2="${item.id}" name="actual_weight[]" value=${item.actual_weight}
                                                    aria-describedby="carton-addon2">
                                               
                                            </div></td>  
                          <td class="text-right align-middle">
                         <div class="col">
                                                <input type="text" class="form-control unit_price" placeholder="unit price"
                                                    aria-label="Carton" id="unit_price_${item.id}" id2="${item.id}" name="unit_price[]" value=${item.unit_price}
                                                    aria-describedby="carton-addon2">
                                                
                                            </div></td>  
                          <td class="text-right align-middle">
                                            <div class="col">                  
                                                <input type="text" class="form-control amount" placeholder="amount"
                                                    aria-label="Carton" id="amount_${item.id}" id2="${item.id}" readonly name="amount[]" value=${item.amount}
                                                    aria-describedby="carton-addon2">
                                               
                                            </div>
                                           <input type="hidden" name="booking_id[]" value="${item.id}"></td>                  
                        </tr>`;

                if (item.packing_cost != null) {
                    packing += parseInt(item.packing_cost);
                } else {
                    packing = 0;
                }

                if (item.chinalocal != null) {
                    local += parseInt(item.chinalocal);
                } else {
                    local = 0;
                }
                if (item.courier_bill != null) {
                    courier += parseInt(item.courier_bill);
                } else {
                    courier = 0;
                }

                $("#invoiceFooter")
                    .find(".packing_cost")
                    .text(Number(packing).toFixed(2));

                $("#invoiceFooter")
                    .find(".chinalocal")
                    .text(Number(local).toFixed(2));

                $("#invoiceFooter")
                    .find(".courier_bill")
                    .text(Number(courier).toFixed(2));

                $("#invoiceFooter")
                    .find(".total_due")
                    .text(Number(total_amount).toFixed(2));
                let total_payable =
                    Number(total_amount) +
                    Number(packing) +
                    Number(local) +
                    Number(courier);

                $("#invoiceFooter")
                    .find(".total_payable")
                    .text(Number(total_payable).toFixed(2));

                $("#invoiceItem").append(hiddenInput);
                $("#generateInvoiceModal").modal("show");
            } else {
                Swal.fire({
                    icon: "warning",
                    text: "Selected booking are not ready for generate invoice",
                });
            }
        });
    });
});
