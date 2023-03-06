@extends('frontend.layouts.app')
@section('title', __('Dashboard'))

@section('content')
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>

    <div class="container col-md-6">
        <div class="card" style="border:0px;">
            <div class="card-header" style="border:0px;">
                <div style="display: flex; justify-content: center; font-size: 150%; font-weight: bold;">
                    Book Your Order</div>
            </div>
            <div class="card-body">
                <form action="{{ route('frontend.content.booking') }}" method="post" id="booking" name="booking">
                    @csrf
                    <div class="form-row mb-1">Select Date:</div>
                    <div class="form-row mb-2">
                        <div class="col"><input type="date" name="date[]" value="{{ now()->format('Y-m-d') }}"
                                class="form-control" placeholder="approx date" style="border-radius: 10rem;">
                        </div>
                    </div>
                    <div class="form-row mb-1">Product Name:
                    </div>
                    <div class="form-row mb-2">
                        <div class="col"><input type="text" name="othersProductName[]" class="form-control"
                                placeholder="product name" style="border-radius: 10rem;">
                        </div>
                    </div>
                    <div class="form-row mb-1">Carton quantity:</div>
                    <div class="form-row mb-2">
                        <div class="col"><input type="text" name="ctnQuantity[]" class="form-control"
                                placeholder="quantity" style="border-radius: 10rem;">
                        </div>
                    </div>
                    <div class="form-row mb-1">Shipping Mark:</div>
                    <div class="form-row mb-2">
                        <div class="col"><input type="text" name="shipping_mark[]" class="form-control"
                                placeholder="shipping mark" style="border-radius: 10rem;">
                        </div>
                    </div>
                    <div class="form-row mb-1">Product Weight:</div>
                    <div class="form-row mb-2">
                        <div class="col"><input type="text" name="actual_weight[]" class="form-control"
                                placeholder="products weight" style="border-radius: 10rem;">
                        </div>
                    </div>
                    <div class="form-row mb-1">Total CBM:</div>
                    <div class="form-row mb-2">
                        <div class="col"><input type="text" name="totalCbm[]" class="form-control"
                                placeholder="total CBM" style="border-radius: 10rem;">
                        </div>
                    </div>
                    <div class="form-row mb-1">Product Quantity:</div>
                    <div class="form-row mb-2">
                        <div class="col"><input type="text" name="productQuantity[]" class="form-control"
                                placeholder="product quantity" style="border-radius: 10rem;">
                        </div>
                    </div>
                    <div class="form-row mb-1">Products Total Cost:</div>
                    <div class="form-row mb-2">
                        <div class="col"><input type="text" name="productsTotalCost[]" class="form-control"
                                placeholder="total Cost(BDT)" style="border-radius: 10rem;">
                        </div>
                    </div>


                    <fieldset>
                        <legend>Select Delivery Method:</legend>
                        <div>
                            <input type="radio" id="ofiice_delivery" name="delivery_method[]" checked
                                value="ofiice_delivery" />
                            <label for="ofiice_delivery">Office Delivery</label>

                            <input type="radio" id="on_address" name="delivery_method[]" value="on_address" />
                            <label for="on_address">On Address</label>
                        </div>
                    </fieldset>

                    <div id="add_address">
                        {{-- hidden --}}
                    </div>

                    <input id="status" name="status[]" value="booking-pending" type="hidden">
                    <input type="hidden" name="actual_weight[]" value="{{ 0 }}" />
                    <input type="hidden" name="unit_price[]" value="{{ 0 }}" />

                    <button class="btn btn-primary btn-lg btn-block" type="submit">Book Now</button>
                </form>

            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            $('input[type="radio"]').click(function() {
                var inputValue = $(this).attr("value");

                if (inputValue == "on_address") {

                    var address = `<div class="form-row mb-1">Address:</div>
                <div class="form-row mb-2">
                    <div class="col"><input type="text" name="customer_address[]" class="form-control"
                            placeholder="address" style="border-radius: 10rem;">
                    </div>
                </div>`;
                    $("#add_address").html(address);
                } else {
                    $("#add_address").html("");
                }

            });
        });
    </script>

    @if (session()->has('Createmessage'))
        <script>
            Swal.fire({
                icon: "success",
                text: "Your Booking Order Placed Successfully",
            })
        </script>
    @endif


@endsection
