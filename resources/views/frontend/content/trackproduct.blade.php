<section>
    {{-- <div class="theme-container container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2 track-prod clrbg-before wow slideInUp" data-wow-offset="50"
                data-wow-delay=".20s">
                <h2 class="title-1"> track your product </h2> <span class="font2-light fs-12">Now you can
                    track your product easily</span>
                <div class="row">
                    <form class="trackproduct" action="{{ route('frontend.pages.tracking') }}" method="GET">
                        <div class="col-md-7 col-sm-7">
                            <div class="form-group">
                                <input id="trackid" type="search" placeholder="Enter your Invoice ID" required=""
                                    class="form-control box-shadow" name="trackid">
                            </div>
                        </div>
                        <div class="col-md-5 col-sm-5">
                            <div class="form-group">
                                <button class="btn-1">Track your product</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div> --}}
    <div class="slider-form" data-animation="fadeInUpS" data-delay=".9s" style="animation-delay: 0.9s;">
        <form method="GET" action="{{ route('frontend.pages.shippingInformationModal') }}">
            @csrf
            <div class="col-md-1 mbb-10">
                <select class="custom-select" name="service_type" id="service_type">
                    <option value="d2d">D2D</option>
                </select>
            </div>
            <div class="col-md-2 mbb-10">
                <select class="custom-select" name="shipped_from" id="shipped_from" required>
                    <option value="">Select Country</option>
                    <option value="china">China</option>
                    <option value="hongkong">Hongkong</option>
                </select>
            </div>
            <div class="col-md-3">
                <input type="text" placeholder="Dhaka Bangladesh" tabindex="0" spellcheck="false" readonly
                    data-ms-editor="true">
            </div>
            <div class="col-md-2">
                <input type="text" placeholder="Enter Weight(KG)" tabindex="0" spellcheck="false"
                    data-ms-editor="true" name="weight" id="weight" required>
            </div>
            <div class="col-md-3 mbb-10">
                <select class="custom-select" name="category" id="category" required>
                    <option value="">Select Product Type</option>
                    @foreach ($product as $pro)
                        <option required value="{{ $pro->category ?? null }}">{{ $pro->category }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-1"><button data-toggle="modal" data-target="#exampleModalLong" class="btn"
                    tabindex="-1"><i class="flaticon-magnifying-glass"></i></button></div>
            <!-- <button class="btn" tabindex="-1">Tracking</button> -->
        </form>
    </div>
    {{-- @include('frontend.pages.shippingInformationModal') --}}
</section>
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).on('change', '#shipped_from', function() {
        console.log('hi');
        if ($("#shipped_from").val() == "china") {
            $.ajax({
                url: "{{ url('/') }}/" + shipped_from,
                type: "GET",

                success: function(data) {
                    $('select[name="category"]').html('');
                    var d = $('select[name="category"]').empty();
                    $.each(data, function(key, value) {
                        $('select[name="CityID"]').append(
                            '<option value="' + value.CityID + '">' + value
                            .CityName + '</option>');
                    });
                },
            });
        }
        if ($("#shipped_from").val() == "hongkong") {

        }
    });
</script> --}}
