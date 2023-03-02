/**
 * Place any jQuery/helper plugins in here.
 */
$(function () {
    /**
     * Checkbox tree for permission selecting
     */
    let permissionTree = $(".permission-tree :checkbox");

    permissionTree.on("click change", function () {
        if ($(this).is(":checked")) {
            $(this)
                .siblings("ul")
                .find('input[type="checkbox"]')
                .attr("checked", true)
                .attr("disabled", true);
        } else {
            $(this)
                .siblings("ul")
                .find('input[type="checkbox"]')
                .removeAttr("checked")
                .removeAttr("disabled");
        }
    });

    permissionTree.each(function () {
        if ($(this).is(":checked")) {
            $(this)
                .siblings("ul")
                .find('input[type="checkbox"]')
                .attr("checked", true)
                .attr("disabled", true);
        }
    });

    /**
     * Disable submit inputs in the given form
     *
     * @param form
     */
    function disableSubmitButtons(form) {
        form.find('input[type="submit"]').attr("disabled", true);
        form.find('button[type="submit"]').attr("disabled", true);
    }

    /**
     * Enable the submit inputs in a given form
     *
     * @param form
     */
    function enableSubmitButtons(form) {
        form.find('input[type="submit"]').removeAttr("disabled");
        form.find('button[type="submit"]').removeAttr("disabled");
    }

    /**
     * Disable all submit buttons once clicked
     */
    $("form").submit(function () {
        disableSubmitButtons($(this));
        return true;
    });

    /**
     * Add a confirmation to a delete button/form
     */
    $("body")
        .on("submit", "form[name=delete-item]", function (e) {
            e.preventDefault();

            Swal.fire({
                title: "Are you sure you want to delete this item?",
                showCancelButton: true,
                confirmButtonText: "Confirm Delete",
                cancelButtonText: "Cancel",
                icon: "warning",
            }).then((result) => {
                if (result.value) {
                    this.submit();
                } else {
                    enableSubmitButtons($(this));
                }
            });
        })
        .on("submit", "form[name=confirm-item]", function (e) {
            e.preventDefault();

            Swal.fire({
                title: "Are you sure you want to do this?",
                showCancelButton: true,
                confirmButtonText: "Continue",
                cancelButtonText: "Cancel",
                icon: "warning",
            }).then((result) => {
                if (result.value) {
                    this.submit();
                } else {
                    enableSubmitButtons($(this));
                }
            });
        })
        .on("click", "a[name=confirm-item]", function (e) {
            /**
             * Add an 'are you sure' pop-up to any button/link
             */
            e.preventDefault();

            Swal.fire({
                title: "Are you sure you want to do this?",
                showCancelButton: true,
                confirmButtonText: "Continue",
                cancelButtonText: "Cancel",
                icon: "info",
            }).then((result) => {
                result.value && window.location.assign($(this).attr("href"));
            });
        });

    // Remember tab on page load
    $('a[data-toggle="tab"], a[data-toggle="pill"]').on(
        "shown.bs.tab",
        function (e) {
            let hash = $(e.target).attr("href");
            history.pushState
                ? history.pushState(null, null, hash)
                : (location.hash = hash);
        }
    );

    let hash = window.location.hash;
    if (hash) {
        $('.nav-link[href="' + hash + '"]').tab("show");
    }

    // Enable tooltips everywhere
    $('[data-toggle="tooltip"]').tooltip();

    $("body")
        .on("click", "#withOtpLogin", function () {
            $("#loginOption").html(
                `<a href="#" id="hasOTP">Already has an OTP ? Click Here</a><br>
                <a href="#" id="withEmailLogin">Email Users ? Click Here</a>`
            );
            $("#withEmailLogin").removeClass("btn-dark");
            $(".loginWithOtp").removeClass("d-none");
            $(".loginWithEmail").addClass("d-none");
        })
        .on("click", "#withEmailLogin", function () {
            console.log("hi");
            $("#loginOption").html(
                `<a href="#" id="withOtpLogin">Login With OTP</a>`
            );

            $("#withOtpLogin").removeClass("btn-dark");
            $(".loginWithOtp").addClass("d-none");
            $(".loginWithEmail").removeClass("d-none");
        })
        .on("click", "#hasOTP", function () {
            $("#otpSubmitBtn").text("Login");
            $(
                ".oldOTP"
            ).html(`<input type="text" name="otp_code" class="form-control otp_code"
                 placeholder="OTP Code" maxlength="4" required="true" autofocus="true">`);
        });
    function replace_phone_prefix(phone) {
        let ItemOne = phone.replace(/^(?:\+?88|0088)/, "");
        return ItemOne.replace(/\s+/g, "");
    }

    function checkValidPhone(inputPhone = null) {
        const phoneSelect = $('input[name="phone"]');
        const phone = inputPhone ? inputPhone : phoneSelect.val();
        const generatePhone = replace_phone_prefix(phone);
        // const method = "^(?:\\+?88|0088)?01[15-9]\\d{8}$";
        // const regExpression = new RegExp(method);
        if (/^(01[3456789])(\d{8})$/.test(generatePhone)) {
            phoneSelect.removeClass("is-invalid").addClass("is-valid");
            return true;
        } else {
            phoneSelect.removeClass("is-valid").addClass("is-invalid");
        }
        return false;
    }

    $(document).on("keyup", 'input[name="phone"]', function () {
        let phone = $(this).val();
        checkValidPhone(phone);
    });

    $(document).on("click", "#otpSubmitBtn", function () {
        let phoneNumber = $('input[name="phone"]').val();
        let checkPhone = checkValidPhone(phoneNumber);
        if (checkPhone) {
            ajaxSendOtpForVerification(phoneNumber);
        } else {
            Swal.fire({
                text: "Phone Number is Not Valid!",
            });
        }
    });
    $(document).on("click", "#backToLoginCard", function () {
        $(".loginSubmitCard").removeClass("d-none");
        $(".otpSubmitCard").addClass("d-none");
    });
    $(document).on("click", "#otpCodeSubmitBtn", function () {
        let phoneNumber = $(document).find(".userPhone").val();
        let checkPhone = checkValidPhone(phoneNumber);
        if (checkPhone) {
            ajaxSendOtpForVerification(phoneNumber);
        } else {
            Swal.fire({
                text: "Phone Number is Not Valid!",
            });
        }
    });

    $(document).on("keyup", 'input[name="otp_code"]', function () {
        const product_cart = productCart();
        let otp_code = $(this).val();
        let userId = $(this).closest(".form-group").find(".userId").val();
        let userPhone = $("#user-phone").val();

        if (typeof userPhone === "undefined") {
            userPhone = $(this).closest(".form-group").find(".userPhone").val();
        }

        if (otp_code.length === 4) {
            $.ajax({
                type: "POST",
                url: "/ajax/IEMsZPlg72Adiuc1pSVrkI6iiUzKXWykNhd",
                data: {
                    otp_code: otp_code,
                    userPhone: userPhone,
                    userId: userId,
                },
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                beforeSend: function () {
                    loadingWebsite();
                },
                success: function (response) {
                    if (response.status) {
                        if (product_cart.length > 0) {
                            window.location.href = "/checkout";
                        } else {
                            window.location.href = "/dashboard";
                        }
                    } else {
                        Swal.fire({
                            text: "Phone Number Verification Fail!",
                        });
                    }
                },
                error: function (xhr) {
                    console.log(xhr);
                },
                complete: function () {
                    loadingOutWebsite();
                },
            });
        }
    });
});
