 <section class="s-slider-area">
     <div class="s-slider-bg fix" style="background-image:url({{ get_setting('banner_image_back') }})">
         <div class="container">
             <div class="row">
                 <div class="col-12">
                     <div class="slider-content text-center mt-145">
                         <h2 data-animation="fadeInUpS" data-delay=".3s" class="" style="animation-delay: 0.3s;color:{{ get_setting('banner_color_1') }}">
                             {{ get_setting('banner_text_header') }}
                         </h2>
                         <p data-animation="fadeInUpS" data-delay=".6s" class="" style="animation-delay: 0.6s; color:{{ get_setting('banner_color_2') }}">
                             {{ get_setting('banner_text_bottom') }}
                         </p>
                         {{-- <div class="slider-form" data-animation="fadeInUpS" data-delay=".9s"
                                    style="animation-delay: 0.9s;">
                                    <form method="GET" action="{{ route('frontend.pages.tracking') }}">
                         @csrf
                         <div class="col-md-1 mbb-10">
                             <select class="custom-select" name="service_type" id="service_type">
                                 <option value="d2d">D2D</option>
                             </select>
                         </div>
                         <div class="col-md-2 mbb-10">
                             <select class="custom-select" name="shipped_from" id="shipped_from">
                                 <option value="">Select Country</option>
                                 <option value="china">China</option>
                                 <option value="hongkong">Hongkong</option>
                             </select>
                         </div>
                         <div class="col-md-3">
                             <input type="text" placeholder="Dhaka Bangladesh" tabindex="0" spellcheck="false" readonly data-ms-editor="true">
                         </div>
                         <div class="col-md-2">
                             <input type="text" placeholder="Enter Weight(KG)" tabindex="0" spellcheck="false" data-ms-editor="true" name="weight" id="weight">
                         </div>
                         <div class="col-md-3 mbb-10">
                             <select class="custom-select" name="category" id="category">
                                 <option value="">Select Product Type</option>
                                 <option value="bag">Bag</option>
                                 <option value="jewelry">Jewelry</option>
                             </select>
                         </div>

                         <div class="col-md-1"><button data-toggle="modal" style="background-color: {{ get_setting('banner_color_3') }};" data-target="#exampleModalLong" class="btn" tabindex="-1"><i class="flaticon-magnifying-glass"></i></button></div>
                         <!-- <button class="btn" tabindex="-1">Tracking</button> -->
                         </form>
                     </div> --}}
                     @include('frontend.content.trackproduct')
                 </div>
             </div>
         </div>
     </div>

     <div class="slider-golve">
         <img src="{{ asset(get_setting('banner_image')) }}" class="rotateme" alt="">
     </div>

     </div>
 </section>