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
    $("body")
        .on("click", "#add-btn", function(e) {
            e.preventDefault();
            ++i;
            var input_element = `<tr>
                              <td>
                                <input type="text" name="productName[]" placeholder="Enter product name" class="form-control" />
                              </td>
                              <td class="text-right" style="width:10%">
                                 <button type="button" name="add" id="add-btn" class="btn btn-success">Add More</button>
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
        });
});
