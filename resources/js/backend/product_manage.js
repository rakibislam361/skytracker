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
        });
});
