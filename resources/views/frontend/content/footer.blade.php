<footer>
    <div class="footer-wrap pt-95 pb-150" data-background="img/bg/footer_bg.jpg">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="footer-widget mb-50">
                        <div class="footer-logo mb-35">
                            <a href="{{ route('frontend.index') }}"><img
                                    src="{{ asset(get_setting('frontend_logo_footer')) }}" alt="img"></a>
                        </div>
                        <div class="footer-text">
                            <p><strong>Head Office</strong></p>
                            <p>{{ get_setting('office_address') }}</p>
                            <p><strong>Email</strong></p>
                            <p>{{ get_setting('office_email') }}</p>
                            <p><strong>Phone</strong></p>
                            <p>{{ get_setting('office_phone') }}</p>
                            <p><strong>WeChat</strong></p>
                            <img src="{{ asset(get_setting('meta_image')) }}" alt="WeChat QR"
                                style="width: 50%;height: 50%;">


                        </div>

                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="footer-widget mb-50">
                        <div class="fw-title mb-30">
                            <h5>CUSTOMER</h5>
                        </div>
                        <div class="fw-link">
                            <ul>
                                @php
                                    $footer_lefts = DB::table('pages')
                                        ->where('footer_left', 2)
                                        ->get();
                                @endphp
                                @foreach ($footer_lefts as $footer_left)
                                    <li><a href="/page/{{ $footer_left->slug }}"><i
                                                class="fas fa-caret-right"></i>{{ $footer_left->title }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="footer-widget mb-50">
                        <div class="fw-title mb-30">
                            <h5>INFORMATION</h5>
                        </div>
                        <div class="fw-link">
                            <ul>
                                @php
                                    $footer_rights = DB::table('pages')
                                        ->where('footer_right', 3)
                                        ->get();
                                @endphp
                                @foreach ($footer_rights as $footer_right)
                                    <li><a href="/page/{{ $footer_right->slug }}"><i
                                                class="fas fa-caret-right"></i>{{ $footer_right->title }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="footer-widget mb-50">
                        <div class="fw-title mb-30">
                            <h5>MOBILE APPS</h5>
                        </div>
                        <div class="f-support-content mb-30">
                            <a href="#" class="f-download-btn"><img
                                    src="{{ asset('assets/images/images-f_download_btn01.png') }}" alt="img"></a>
                            <a href="#" class="f-download-btn"><img
                                    src="{{ asset('assets/images/images-f_download_btn02.png') }}" alt="img"></a>
                        </div>
                        <div class="fw-title mb-30">
                            <h5>SOCIAL LINKS</h5>
                        </div>
                        <div class="f-support-content">
                            <div class="footer-social">
                                <ul>
                                    <li><a href="{{ get_setting('facebook') }}"><i class="fab fa-facebook-f"></i></a>
                                    </li>
                                    <li><a href="{{ get_setting('twitter') }}"><i class="fab fa-twitter"></i></a>
                                    </li>
                                    <li><a href="{{ get_setting('linkedin') }}"><i class="fab fa-pinterest-p"></i></a>
                                    </li>
                                    <li><a href="{{ get_setting('youtube') }}"><i class="fab fa-linkedin-in"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="companyLogos">
                    <div class="sisters">
                        <a href="https://www.skybuybd.com/" aria-label="">
                            <img src="https://www.skybuybd.com/storage/setting/logo/foterlogo.png" alt=""
                                loading="lazy"></a>
                        <a href="https://www.skytrackbd.com/" aria-label="">
                            <img src="{{ asset(get_setting('frontend_logo_footer')) }}" alt="" loading="lazy"
                                style="margin:20px"></a>
                        <a href="https://www.skyonebd.com/" target="_blank" rel="noopener noreferrer" aria-label="">
                            <img src="https://www.skyonebd.com/storage/setting/logo/foter_logo.png" alt=""
                                loading="lazy" style="padding: 0.75rem;"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="copyright-wrap">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="copyright-text">
                        <p>{{ get_setting('copyright_text') }}</p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</footer>
