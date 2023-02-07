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
                                                placeholder="approx date">
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
    body.on("click", "#generateInvoiceButtonBook", function (e) {
        var duePayment = "";
        let itemValue = $(this).data("value");
        let total_amount = itemValue.amount;
        let customer = null;
        let packing = null;
        let local = null;
        let actual_weight = null;
        let unit_price = null;
        let amount = null;

        if (itemValue.actual_weight != null) {
            actual_weight = itemValue.actual_weight;
        } else {
            actual_weight = 0;
        }
        if (itemValue.unit_price != null) {
            unit_price = itemValue.unit_price;
        } else {
            unit_price = 0;
        }
        if (itemValue.amount != null) {
            amount = itemValue.amount;
        }
        if (unit_price != 0 && actual_weight != 0) {
            amount = Math.round(Number(actual_weight) * Number(unit_price));
        } else {
            amount = 0;
        }
        if (itemValue.customer_name != null) {
            customer = itemValue.customer_name;
        } else {
            customer = itemValue.user.name;
        }
        if (itemValue.packing_cost != null) {
            packing = itemValue.packing_cost;
        } else {
            packing = 0;
        }
        if (itemValue.chinalocal != null) {
            local = itemValue.chinalocal;
        } else {
            local = 0;
        }
        $("#invoiceFooter")
            .find(".total_due")
            .text(Number(total_amount).toFixed(2));

        duePayment += `<tr>
                          <td class=" align-middle">${customer}</td>
                          <td class=" align-middle">
                         <div class="col">
                                            <p class="product_name_text m-0" style="display: none">
                                               <a href="#"
                                                    class="ml-3 removeProduct text-danger">remove</a>
                                            </p> <div class="input-group productSubmit">
                                                <input type="text" class="form-control" placeholder="product"
                                                    aria-label="Product Name" id="othersProductName" name="othersProductName" value=${itemValue.othersProductName}
                                                    aria-describedby="Product-addon2">
                                                <div class="input-group-append applyProductName" style="cursor: pointer">
                                                    <span class="input-group-text" id="product-addon2">✓</span>
                                                </div>
                                            </div>
                                            </div></td>
                          <td class=" align-middle">${itemValue.shipping_mark}</td>
                          <td class="align-middle"><p class="carton_text m-0" style="display: none">
                                               <a href="#"
                                                    class="ml-3 removeProduct text-danger">remove</a>
                                            </p> <div class="input-group cartonSubmit">
                                                <input type="text" class="form-control" placeholder="carton"
                                                    aria-label="Carton" id="carton_number" name="carton_number" value=${itemValue.cartons.carton_number}
                                                    aria-describedby="carton-addon2">
                                                <div class="input-group-append applyCarton" style="cursor: pointer">
                                                    <span class="input-group-text" id="carton-addon2">✓</span>
                                                </div>
                                            </div></td>
                           <td class=" align-middle">${itemValue.shipping_number}</td>
                          <td class=" align-middle">${itemValue.status}</td>
                          <td class="text-right align-middle"><p class="weight_text m-0" style="display: none">
                                               <a href="#"
                                                    class="ml-3 removeProduct text-danger">remove</a>
                                            </p><div class="input-group weightForm">
                                                <input type="text" class="form-control" placeholder="actual weight"
                                                    aria-label="Carton" id="actual_weight" name="actual_weight" value=${actual_weight}
                                                    aria-describedby="carton-addon2">
                                                <div class="input-group-append applyWeight" style="cursor: pointer">
                                                    <span class="input-group-text" id="carton-addon2">✓</span>
                                                </div>
                                            </div></td>  
                          <td class="text-right align-middle"><p class="unit_price_text m-0" style="display: none">
                                               <a href="#"
                                                    class="ml-3 removeProduct text-danger">remove</a>
                                            </p><div class="input-group UnitPriceForm">
                                                <input type="text" class="form-control" placeholder="unit price"
                                                    aria-label="Carton" id="unit_price" name="unit_price" value=${unit_price}
                                                    aria-describedby="carton-addon2">
                                                <div class="input-group-append applyUnitPrice" style="cursor: pointer">
                                                    <span class="input-group-text" id="carton-addon2">✓</span>
                                                </div>
                                            </div></td>  
                          <td class="text-right align-middle"><p class="amount_text m-0" style="display: none">
                                               <a href="#"
                                                    class="ml-3 removeProduct text-danger">remove</a>
                                            </p><div class="input-group amountForm">
                                                <input type="text" class="form-control" placeholder="amount"
                                                    aria-label="Carton" id="amount" name="amount" value=${amount}
                                                    aria-describedby="carton-addon2">
                                                <div class="input-group-append applyAmount" style="cursor: pointer">
                                                    <span class="input-group-text" id="carton-addon2">✓</span>
                                                </div>
                                            </div></td>                  
                        </tr>`;
        let hidden = `<input type="hidden" name="booking_id" id="booking_id" value="${itemValue.id}">`;
        $("#invoiceFooter")
            .find(".packing_cost")
            .text(Number(packing).toFixed(2));
        $("#invoiceFooter").find(".chinalocal").text(Number(local).toFixed(2));

        let payable = Number(total_amount) + Number(packing) + Number(local);

        $("#invoiceFooter")
            .find(".total_payable")
            .text(Number(payable).toFixed(2));

        $(".hiddenField").html(hidden);
        $("#invoiceItem").html(duePayment);
        $("#generateInvoiceModal").modal("show");
    });
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
    $(document).on("click", ".applyProductName", function () {
        let product_name = $(this)
            .closest(".input-group")
            .find(".form-control")
            .val();

        $(".product_name_text").show();
        $(".productSubmit").hide();
        $("#invoiceItem").find(".product_name_text").text(product_name);
    });
    $(document).on("click", ".applyCarton", function () {
        let carton = $(this)
            .closest(".input-group")
            .find(".form-control")
            .val();

        $(".carton_text").show();
        $(".cartonSubmit").hide();
        $("#invoiceItem").find(".carton_text").text(carton);
    });
    $(document).on("click", ".applyWeight", function () {
        let weight = $(this)
            .closest(".input-group")
            .find(".form-control")
            .val();
        let unit_price = null;

        if ($("#unit_price").val() != null) {
            unit_price = $("#unit_price").val();
        } else {
            unit_price = $("#invoiceItem").find(".unit_price_text").text();
        }

        let amount = Math.round(Number(weight) * Number(unit_price));

        $("#amount").val(amount);

        $("#invoiceFooter").find(".total_due").text(Number(amount).toFixed(2));

        $(".weight_text").show();
        $(".weightForm").hide();
        $("#invoiceItem").find(".weight_text").text(weight);
    });
    $(document).on("click", ".applyUnitPrice", function () {
        let unit_price = $(this)
            .closest(".input-group")
            .find(".form-control")
            .val();
        let weight = null;
        if ($("#actual_weight").val() != null) {
            weight = $("#actual_weight").val();
        } else {
            weight = $("#invoiceItem").find(".weight_text").text();
        }
        let amount = Math.round(Number(weight) * Number(unit_price));

        $("#amount").val(amount);

        $("#invoiceFooter").find(".total_due").text(Number(amount).toFixed(2));

        $(".unit_price_text").show();
        $(".UnitPriceForm").hide();
        $("#invoiceItem").find(".unit_price_text").text(unit_price);
    });
    $(document).on("click", ".applyAmount", function () {
        let amount = $(this)
            .closest(".input-group")
            .find(".form-control")
            .val();
        let courier_bill = $("#invoiceFooter").find(".courier_bill").text();
        let packing = $("#invoiceFooter").find(".packing_cost").text();
        let chinalocal = $("#invoiceFooter").find(".chinalocal").text();
        let paid = $("#invoiceFooter").find(".paid").text();

        let total_payable =
            Number(chinalocal) +
            Number(amount) +
            Number(courier_bill) +
            Number(packing) -
            Number(paid);

        $("#invoiceFooter").find(".total_due").text(Number(amount).toFixed(2));

        $("#invoiceFooter")
            .find(".total_payable")
            .text(Number(total_payable).toFixed(2));

        $(".amount_text").show();
        $(".amountForm").hide();
        $("#invoiceItem").find(".amount_text").text(amount);
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
    $(document).on("click", "#generateSubmitBtn", function () {
        let product_name = null;
        let carton_number = null;
        let actual_weight = null;
        let unit_price = null;
        let courier_bill = null;
        let packing = null;
        let local = null;

        let amount = $("#invoiceFooter").find(".total_due").text();

        if ($("#invoiceFooter").find(".courier_bill").text() != null) {
            courier_bill = $("#invoiceFooter").find(".courier_bill").text();
        } else {
            courier_bill = $("#invoiceFooter")
                .find(".courier_bill_text")
                .text();
        }
        if ($("#invoiceFooter").find(".packing_cost").text() != null) {
            packing = $("#invoiceFooter").find(".packing_cost").text();
        } else {
            packing = $("#invoiceFooter").find(".packing_cost_text").text();
        }
        if ($("#invoiceFooter").find(".chinalocal").text() != null) {
            local = $("#invoiceFooter").find(".courier_bill").text();
        } else {
            local = $("#invoiceFooter").find(".chinalocal_text").text();
        }

        // let packing = $("#invoiceFooter").find(".packing_cost").text();
        // let local = $("#invoiceFooter").find(".chinalocal").text();

        let total_payable = $("#invoiceFooter").find(".total_payable").text();
        let paid = $("#invoiceFooter").find(".paid").text();

        if ($("#othersProductName").val() != null) {
            product_name = $("#othersProductName").val();
        } else {
            product_name = $("#invoiceItem").find(".product_name_text").text();
        }
        if ($("#carton_number").val() != null) {
            carton_number = $("#carton_number").val();
        } else {
            carton_number = $("#invoiceItem").find(".carton_text").text();
        }
        if ($("#actual_weight").val() != null) {
            actual_weight = $("#actual_weight").val();
        } else {
            actual_weight = $("#invoiceItem").find(".weight_text").text();
        }
        if ($("#unit_price").val() != null) {
            unit_price = $("#unit_price").val();
        } else {
            unit_price = $("#invoiceItem").find(".unit_price_text").text();
        }

        var total_pay = `<input type="hidden" name="total_payable" value="${total_payable}">`;
        var total_courier = `<input type="hidden" name="total_courier" value="${courier_bill}">`;
        var total_chinalocal = `<input type="hidden" name="chinalocal" value="${local}">`;
        var total_packing = `<input type="hidden" name="packing_cost" value="${packing}">`;
        var total_d = `<input type="hidden" name="total_due" value="${amount}">`;
        var product = `<input type="hidden" name="othersProductName" value="${product_name}">`;
        var carton = `<input type="hidden" name="carton_number" value="${carton_number}">`;
        var weight = `<input type="hidden" name="actual_weight" value="${actual_weight}">`;
        var unit = `<input type="hidden" name="unit_price" value="${unit_price}">`;
        var total_paid = `<input type="hidden" name="paid" value="${paid}">`;

        $(".totalPay").html(total_pay);
        $(".totalDue").html(total_d);
        $("#packing").html(total_packing);
        $("#localdelivery").html(total_chinalocal);
        $("#courier").html(total_courier);
        $(".product_name").html(product);
        $(".carton").html(carton);
        $(".weight").html(weight);
        $(".unit").html(unit);
        $(".total_pay").html(total_paid);
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
        // console.log(hiddenInput);
        hiddenField.html(hiddenInput);
        changeStatusModal.modal("show");
        $("#statusChargeForm").trigger("reset");
    });
    $(document).on("click", "#InvoiceButtonBook", function () {
        console.log("hello inv");
    });
});
