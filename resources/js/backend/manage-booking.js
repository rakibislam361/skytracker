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
                                                class="btn btn-outline-danger remove-trdD">-</button></td>
                                                                   
                                 </tr>`;

            $("#tracking-id").append(input_element);
        })

        .on("click", ".remove-tr", function (e) {
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
    body.on("click", "#generateInvoiceButton", function (e) {
        var duePayment = "";
        let itemValue = $(this).data("value");
        let due = itemValue.amount - itemValue.paid;
        $("#invoiceFooter").find(".total_due").text(Number(due).toFixed(2));

        duePayment += `<tr>
                          <td class=" align-middle">${itemValue.user.name}</td>
                          <td class=" align-middle">${
                              itemValue.othersProductName
                          }</td>
                          <td class="text-left align-middle">${
                              itemValue.cartons[0].carton_number
                          }</td>
                          <td class=" align-middle">${itemValue.status}</td>
                          <td class="text-right align-middle">${Number(
                              itemValue.cartons[0].actual_weight
                          ).toFixed(2)}</td>  
                           <td class="align-middle">${due}</td>                   
                        </tr>`;
        let hidden = `<input type="hidden" name="booking_id" id="booking_id" value="${itemValue.id}">`;
        $(".hiddenField").html(hidden);
        $("#invoiceItem").html(duePayment);
        $("#generateInvoiceModal").modal("show");
    });
    $(document).on("click", ".applyCourierBtn", function () {
        var courier_bill = $(this)
            .closest(".input-group")
            .find(".form-control")
            .val();
        var total_due = $("#invoiceFooter").find(".total_due").text();
        var total_payable = Number(courier_bill) + Number(total_due);
        let total_pay = `<input type="hidden" name="total_payable" id="total_payable" value="${total_payable}">`;
        let total_d = `<input type="hidden" name="total_due" id="total_due" value="${total_due}">`;
        $(".totalPay").html(total_pay);
        $(".totalDue").html(total_d);
        $("#invoiceFooter")
            .find(".courier_bill")
            .text(Number(courier_bill).toFixed(2));
        $("#invoiceFooter")
            .find(".total_payable")
            .text(Number(total_payable).toFixed(2));

        $(".courier_bill_text").show();
        $(".courierSubmitForm").hide();
    });

    $(document).on("click", ".removeCourierBtn", function () {
        $(this).closest("div").find(".form-control").val("");
        var total_due = $("#invoiceFooter").find(".total_due").text();
        $("#invoiceFooter").find(".courier_bill").text(0.0);
        $("#invoiceFooter")
            .find(".total_payable")
            .text(Number(total_due).toFixed(2));
        $(".courier_bill_text").hide();
        $(".courierSubmitForm").show();
    });
});
