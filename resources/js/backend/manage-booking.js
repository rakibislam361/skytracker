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
                                                class="btn btn-outline-danger">-</button></td>
                                                                   
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
                                                class="btn btn-outline-danger">-</button></td>
                                                                   
                                 </tr>`;

            $("#tracking-id").append(input_element);
        })
        .on("click", ".remove-tr", function (e) {
            e.preventDefault();
            $(this).parents("tr").remove();
        });
});
