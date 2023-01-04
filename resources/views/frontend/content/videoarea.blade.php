<section class="video-area"
    style="background-image: url({{ get_setting('bottombanner_image') }});overflow: hidden;background-position: center;background-size: cover;">
    <div class="container">
        <div class="" style="background-color:{{ get_setting('bottom_bg_color') }};width:880px">
            <div class="row align-items-center">
                <div class="col-xl-5 col-lg-8 order-2 order-lg-0">
                    <div class="video-title">
                        <span
                            style="color: {{ get_setting('btbanner_color_1') }}">{{ get_setting('bottombanner_text_header') }}</span>
                        <h2 style="color: {{ get_setting('btbanner_color_2') }}">
                            {{ get_setting('bottombanner_text_bottom') }}
                        </h2>
                        <a href="#">more services<span></span></a>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="video-play">
                        <a href="{{ get_setting('bottom_video_link') }}" class="popup-video"><img
                                src="{{ asset('assets/images/icon-play_btn.png') }}" alt="img"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
