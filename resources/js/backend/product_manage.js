// Swal.fire({
//     title: "Are you sure you want to delete this item?",
//     showCancelButton: true,
//     confirmButtonText: "Confirm Delete",
//     cancelButtonText: "Cancel",
//     icon: "warning"
// }).then(result => {
//     if (result.value) {
//         this.submit();
//     } else {
//         enableSubmitButtons($(this));
//     }
// });

const { message } = require("laravel-mix/src/Log");
const { parse } = require("postcss");

$(function() {
    var i = 0;
    let itemNumber = 0;

    $("body")
        .on("click", "#add-btn", function(e) {
            e.preventDefault();
            ++i;
            var input_element = `<tr>
                                    <td>
                                      <input type="text" name="productName[]" placeholder="Enter product name" class="form-control" />
                                    </td>
                                    <td class="text-right" style="width:10%">
                                      <button type="button" name="add" id="add-btn" class="btn btn-success">Add</button>
                                    </td> 
                                    <td class="text-right" style="width:10%">
                                      <button type="button" class="btn btn-danger remove-tr">Remove</button>
                                    </td>                            
                                 </tr>`;

            $("#dynamicAddRemove").append(input_element);
        })
        .on("click", ".remove-tr", function(e) {
            e.preventDefault();
            $(this)
                .parents("tr")
                .remove();
        })

        .on("click", ".order-modal", function() {
            let itemValue = $(this).data("value");
            $("#statusChargeForm").attr(
                "action",
                `/admin/order/${itemValue.id}`
            );
            $("#order_item_number").val(itemValue.order_item_number);
            $("#order_item_rmb").val(itemValue.order_item_rmb);
            $("#purchase_rmb").val(itemValue.purchase_rmb);
            $("#chinaLocalDelivery").val(itemValue.chinaLocalDelivery);
            $("#shipping_from").val(itemValue.shipping_from);
            $("#shipping_mark").val(itemValue.shipping_mark);
            $("#name").val(itemValue.name);
            $("#chn_warehouse_qty").val(itemValue.chn_warehouse_qty);
            $("#chn_warehouse_weight").val(itemValue.chn_warehouse_weight);
            $("#cbm").val(itemValue.cbm);
            $("#carton_id").val(itemValue.carton_id);
            $("#tracking_number").val(itemValue.tracking_number);
            $("#shipped_by").val(itemValue.shipped_by);
            $("#status").val(itemValue.status);
            $("#changeStatusButton").modal("show");
        })

        .on("click", "#statusSubmitBtn", function(event) {
            event.preventDefault();
            var formData = $("#statusChargeForm").serialize();
            let url = $("#statusChargeForm").attr("action");
            $.ajax({
                type: "put",
                url: url,
                data: formData,
                beforeSend: function() {
                    $("#statusSubmitBtn").prop("disabled", true);
                },
                success: function(res) {
                    Swal.fire({
                        icon: "success",
                        text: "Update successful"
                    }).then(result => {
                        window.location.reload();
                    });
                },
                error: function() {
                    Swal.fire({
                        icon: "warning",
                        text: "Unsuccessful"
                    });
                }
            });
        })

        .on("keyup", "#purchase_rmb", function() {
            let prmb = $(this).val();
            let conRate = $("#actualrmb_rate").val();
            $("#productCost").val(prmb * conRate);
            let ormb = $("#order_item_rmb").val();
            if (parseInt(prmb) > parseInt(ormb)) {
                $("#statusSubmitBtn").prop("disabled", true);
                Swal.fire({
                    icon: "warning",
                    text: "Actual Rmb Cannot be Bigger Than Order Rmb"
                });
            } else {
                $("#statusSubmitBtn").prop("disabled", false);
            }
        })

        .on("keyup", "#chinaLocalDelivery", function() {
            let local = $(this).val();
            let localRate = $("#local_rate").val();
            $("#chinaLocalInBD").val(local * localRate);
            let conv = $("#chinaLocalInBD").val();
            let prcost = $("#productCost").val();
            $("#product_bd_received_coast").val(
                parseInt(conv) + parseInt(prcost)
            );
        });
});
