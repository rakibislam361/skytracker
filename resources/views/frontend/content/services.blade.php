{{-- <script src="dist/clipboard.min.js"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.8/clipboard.min.js"></script>
<section class="services-area pt-110">
    <div class="faq-wrapper">
        <div class="row">
            <div class="col-xl-4 col-lg-5">
                <div class="nav flex-column nav-pills faq-tab-pills" id="v-pills-tab" role="tablist"
                    aria-orientation="vertical">
                    <a class="nav-link active show" id="v-pills-warehouse-tab" data-toggle="pill"
                        style="background-color: {{ get_setting('notice_color_1') }}" href="#v-pills-warehouse"
                        role="tab" aria-controls="v-pills-warehouse" aria-selected="false">
                        <div class="faq-tab-icon">
                            <i style="color: {{ get_setting('notice_color_3') }}" class="fa fa-home"></i>
                        </div>
                        <div class="faq-tab-content d-none d-lg-block">
                            <h5 class="mt-xl-3" style="color: {{ get_setting('notice_color_2') }}">China Warehouse
                                Address</h5>

                        </div>
                    </a>
                    <a class="nav-link" id="v-pills-home-tab" data-toggle="pill"
                        style="background-color: {{ get_setting('notice_color_1') }}" href="#v-pills-home"
                        role="tab" aria-controls="v-pills-home" aria-selected="true">
                        <div class="faq-tab-icon">
                            <i style="color: {{ get_setting('notice_color_3') }}" class="far fa-bell"></i>
                        </div>
                        <div class="faq-tab-content d-none d-lg-block">
                            <h5 class="mt-xl-3" style="color: {{ get_setting('notice_color_2') }}">Notice
                                Board</h5>

                        </div>
                    </a>
                    <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile"
                        style="background-color: {{ get_setting('notice_color_1') }}" role="tab"
                        aria-controls="v-pills-profile" aria-selected="true">
                        <div class="faq-tab-icon">
                            <i style="color: {{ get_setting('notice_color_3') }}" class="fas fa-info"></i>

                        </div>
                        <div class="faq-tab-content d-none d-lg-block">
                            <h5 class="mt-xl-3" style="color: {{ get_setting('notice_color_2') }}">More
                                Imformation</h5>

                        </div>
                    </a>

                </div>
            </div>
            <div class="col-xl-8 col-lg-7">
                <div class="tab-content" id="v-pills-tabContent">
                    <div class="tab-pane fade active show" id="v-pills-warehouse" role="tabpanel"
                        aria-labelledby="v-pills-warehouse-tab">
                        <div class="faq-accordion iconColor">
                            <div class="faq-tab-icon">
                                <i style="color: {{ get_setting('notice_color_1') }}" class="fa fa-address-card"></i>
                            </div>
                            <div class="faq-accordion-content fix">

                                <div class="accordion" id="accordionExample">
                                    <div class="card">
                                        <div class="f-rc-post">
                                            <ul>
                                                <li>

                                                    @php
                                                        $add = get_setting('warehouse_address');
                                                        $notice = get_setting('warehouse_notice');
                                                        $notice_note = get_setting('warehouse_notice_note');
                                                    @endphp

                                                    <p>
                                                        <pre id="copy_address" value="{{ $add }}">{{ $add }}</pre>
                                                    </p>

                                                    <div style="margin-left: 60px;margin-top: 40px;">
                                                        <button class="btn"
                                                            data-clipboard-target="#copy_address">Copy</button>

                                                        <script type="text/javascript">
                                                            var Clipboard = new ClipboardJS('.btn');
                                                        </script>
                                                    </div>

                                                </li>

                                                <li>
                                                    <textarea readonly cols='100' rows='20' style=" border: none;outline: none;">{{ $notice }}</textarea>

                                                </li>
                                                <li>
                                                    <div style="color: red;">

                                                        {{ $notice_note }}
                                                    </div>

                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                        <div class="faq-accordion iconColor">
                            <div class="faq-tab-icon">
                                <i style="color: {{ get_setting('notice_color_1') }}" class="far fa-bell"></i>
                            </div>
                            <div class="faq-accordion-content fix">

                                <div class="accordion" id="accordionExample">
                                    <div class="card">
                                        <div class="f-rc-post">
                                            <ul>
                                                @php
                                                    $notices = DB::table('notices')
                                                        ->where('is_active', 1)
                                                        ->take(5)
                                                        ->orderBy('id', 'DESC')
                                                        ->get();
                                                @endphp
                                                @foreach ($notices as $notice)
                                                    <li>
                                                        <div class="f-rc-content">
                                                            <h5><a
                                                                    href="/notice/details/{{ $notice->id }}">{{ $notice->title }}</a>
                                                            </h5>
                                                            <span>{{ $notice->updated_at }}</span>

                                                        </div>
                                                    </li>
                                                @endforeach

                                            </ul>
                                        </div>
                                    </div>
                                    <div class="" style="text-align: end;">
                                        <a href="/notice/all">View More</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="v-pills-profile" role="tabpanel"
                        aria-labelledby="v-pills-profile-tab">
                        <div class="faq-accordion iconColor1">
                            <div class="faq-tab-icon">
                                <i style="color: {{ get_setting('notice_color_1') }}" class="fas fa-info"></i>
                            </div>
                            <div class="faq-accordion-content fix">

                                <div class="accordion" id="accordionAwardExample">
                                    <div class="card">
                                        <div class="f-rc-post">
                                            <ul>
                                                @php
                                                    $infos = DB::table('infos')
                                                        ->where('is_active', 1)
                                                        ->take(5)
                                                        ->orderBy('id', 'DESC')
                                                        ->get();
                                                @endphp
                                                @foreach ($infos as $info)
                                                    <li>
                                                        <div class="f-rc-content">
                                                            <h5><a
                                                                    href="/info/details/{{ $info->id }}">{{ $info->title }}</a>
                                                            </h5>
                                                            <span>{{ $info->updated_at }}</span>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="" style="text-align: end;">
                                        <a href="/info/all">View More</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

</section>
