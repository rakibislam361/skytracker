import axios from "axios";
import { isEmpty } from "lodash";
const { message } = require("laravel-mix/src/Log");
const { parse } = require("postcss");

$(function () {
    var i = 0;
    let itemNumber = 0;

    $("body")
        .on("click", "#add-new-book", function (e) {
            e.preventDefault();
            ++i;
            var booking = $("#add_new_book").html();

            $("#add-booking").append(booking);
        })

        .on("click", ".remove-tr", function (e) {
            e.preventDefault();
            $(this).parents("tr").remove();
        })
        .on("click", "#remove", function (e) {
            e.preventDefault();
            $(this).parents("tr").remove();
        });
});

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
        let amount = Number(weight) * Number(unit_price);
        let round_amount = Number(amount).toFixed(2);
        $("#amount_" + product_id).val(round_amount);
        let val = 0;
        $(".invoiceTable tbody tr").each(function () {
            val += Number($(this).find(".amount").val());
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
        let amount = Number(weight) * Number(unit_price);
        let round_amount = Number(amount).toFixed(2);
        $("#amount_" + product_id).val(round_amount);

        let val = 0;

        $(".invoiceTable tbody tr").each(function () {
            val += Number($(this).find(".amount").val());
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

    $(document).on("click", "#InvoiceButtonBook", function () {
        var hiddenInput = "";
        var generate = false;
        var total_amount = 0;
        var amount = 0;
        var round_amount = 0;
        let packing = null;
        let local = null;
        let courier = null;
        let paid = null;
        let sl_no = 0;
        $("input.checkboxItemBook:checked").each(function (index) {
            var item = $(this).data("value");
            let status = item.status;
            let product = item.othersProductName;
            let carton_no = item.cartons.carton_number;
            let price = 0;
            let weight = 0;
            sl_no += 1;
            if (item.unit_price != null) {
                price = item.unit_price;
            }
            if (item.actual_weight != null) {
                weight = item.actual_weight;
            }

            if (status == "received-in-BD-warehouse" || status == "delivered") {
                generate = true;
            }
            if (generate) {
                amount = Number(item.actual_weight) * Number(item.unit_price);
                if (amount != null) {
                    round_amount = Number(amount).toFixed(2);
                    total_amount += amount;
                }

                hiddenInput = `<tr>
                          <td class=" align-middle">${sl_no}</td>
                          <td class=" align-middle">${item.customer_name}</td>
                            <td class=" align-middle">
                                <div class="col">                                                                                    
                                        <input type="text" class="form-control" placeholder="product"
                                            aria-label="Product Name" id="othersProductName" name="othersProductName[]" value='${product}'>                                                                        
                                    </div>
                                </div>
                            </td>
                          <td class=" align-middle">${item.shipping_mark}</td>
                          <td class="align-middle">                         
                                            <div class="col">
                                                <input type="text" class="form-control" placeholder="carton"
                                                    aria-label="Carton" id="carton_number" name="carton_number[]" value='${carton_no}'
                                                    aria-describedby="carton-addon2">
                                               
                                                
                                            </div></td>
                           <td class=" align-middle">${item.shipping_number}</td>
                          <td class=" align-middle">${item.status}</td>
                          <td class="text-right align-middle">
                                                <div class="col">

                                                   
                                                <input type="text" class="form-control actual_weight" placeholder="actual weight"
                                                    aria-label="Carton" id="actual_weight_${item.id}" id2="${item.id}" name="actual_weight[]" value='${weight}'
                                                    aria-describedby="carton-addon2">
                                               
                                            </div></td>  
                          <td class="text-right align-middle">
                         <div class="col">
                                                <input type="text" class="form-control unit_price" placeholder="unit price"
                                                    aria-label="Carton" id="unit_price_${item.id}" id2="${item.id}" name="unit_price[]" value='${price}'
                                                    aria-describedby="carton-addon2">
                                                
                                            </div></td>  
                          <td class="text-right align-middle">
                                            <div class="col">                  
                                                <input type="text" class="form-control amount" placeholder="amount"
                                                    aria-label="Carton" id="amount_${item.id}" id2="${item.id}" readonly name="amount[]" value='${round_amount}'
                                                    aria-describedby="carton-addon2">
                                               
                                            </div>
                                           <input type="hidden" name="booking_id[]" value="${item.id}"></td>                  
                        </tr>`;

                if (item.packing_cost != null) {
                    packing += Number(item.packing_cost);
                } else {
                    packing = 0;
                }

                if (item.chinalocal != null) {
                    local += Number(item.chinalocal);
                } else {
                    local = 0;
                }
                if (item.courier_bill != null) {
                    courier += Number(item.courier_bill);
                } else {
                    courier = 0;
                }
                if (item.paid != null) {
                    paid += Number(item.paid);
                } else {
                    paid = 0;
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

                $("#invoiceFooter").find(".paid").text(Number(paid).toFixed(2));

                $("#invoiceFooter")
                    .find(".total_due")
                    .text(Number(total_amount).toFixed(2));
                let total_payable =
                    Number(total_amount) +
                    Number(packing) +
                    Number(local) +
                    Number(courier) -
                    Number(paid);

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
    $(document).on("hidden.bs.modal", "#generateInvoiceModal", function () {
        $("#invoiceItem").html("");
    });
});
