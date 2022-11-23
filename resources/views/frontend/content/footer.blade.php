<footer>
  <div class="footer-main pad-120 white-clr">
    <div class="theme-container container">
      <div class="row">
        <div class="col-md-3 col-sm-6 footer-widget">
          {{-- <a href="{{ route('frontend.index') }}"> <img class="logo" alt="#" src="{{asset(get_setting('frontend_logo_footer'))}}" /> </a> --}}
          <a class="navbar-logo" href="{{ route('frontend.index') }}">
            @php
            $logo = App\Models\Content\Setting::where('key','frontend_logo_footer')->first();
            @endphp
            @if ($logo)
            <img class="logo" src="{{ asset($logo->value) }}">
            @endif

          </a>
        </div>
        <div class="col-md-3 col-sm-6 footer-widget">
          <h2 class="title-1 fw-900">Company</h2>
          <ul>
            <li id="about"> <a href="{{ route('frontend.pages.about') }}">About Us</a> </li>
            <li id="contact"> <a href="{{ route('frontend.pages.contact') }}">Contact Us</a> </li>
            <li> <a href="#">Our Goal</a> </li>
          </ul>
        </div>
        <div class="col-md-3 col-sm-6 footer-widget">
          <h2 class="title-1 fw-900">important links</h2>
          <ul>
            <li> <a href="https://www.skybuybd.com/">Skybuy</a> </li>
            <li> <a href="https://www.chinabaz.com/">Chinabaz</a> </li>
          </ul>
        </div>
        <div class="col-md-3 col-sm-6 footer-widget">
          <h2 class="title-1 fw-900">get in touch</h2>
          <ul class="social-icons list-inline">
            <li class="wow fadeIn" data-wow-offset="50" data-wow-delay=".20s"> <a href="#" class="fa fa-facebook"></a> </li>
            <li class="wow fadeIn" data-wow-offset="50" data-wow-delay=".25s"> <a href="#" class="fa fa-twitter"></a> </li>
            <li class="wow fadeIn" data-wow-offset="50" data-wow-delay=".30s"> <a href="#" class="fa fa-google-plus"></a> </li>
            <li class="wow fadeIn" data-wow-offset="50" data-wow-delay=".35s"> <a href="#" class="fa fa-linkedin"></a> </li>
          </ul>

        </div>
      </div>
    </div>
  </div>

  <div class="footer-bottom">
    <div class="theme-container container">
      <div class="row">
        <div class="col-md-6 col-sm-6">
          <p> © Copyright 2022, All rights reserved. </p>
        </div>
        <div class="col-md-6 col-sm-6 text-right">
          <p> Design and <span class="theme-clr fa fa-heart"></span> by <a href="{{ route('frontend.index') }}" class="main-clr"> Avanteca Limited</a> </p>
        </div>
      </div>
    </div>
  </div>
  </div>

</footer>