 <header class="header-main">
     <nav class="menu-bar font2-title1">
         <div class="theme-container container">
             <div class="row">
                 <div class="col-md-2 col-sm-2">
                     <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                         aria-controls="navbar">
                         <span class="sr-only">Toggle navigation</span>
                         <span class="icon-bar"></span>
                         <span class="icon-bar"></span>
                         <span class="icon-bar"></span>
                     </button>

                     @php
                         dd(get_setting('frontend_logo_menu'));
                     @endphp

                     <a class="navbar-logo" href="{{ route('frontend.index') }}">
                         @php
                             $logo = App\Models\Content\Setting::where('key', 'frontend_logo_menu')->first();
                         @endphp
                         @if ($logo)
                             <img src="{{ asset($logo->value) }}">
                         @endif
                     </a>
                     {{-- <a class="navbar-logo" href="{{ route('frontend.index') }}"> <img src="assets/img/logo/logo-black.png" alt="logo" /> </a> --}}
                 </div>
                 <div class="col-md-10 col-sm-10 fs-12">
                     <div id="navbar" class="collapse navbar-collapse no-pad">
                         <ul class="navbar-nav theme-menu">
                             <li> <a href="{{ route('frontend.index') }}">Home</a> </li>
                             <li id="about"> <a href="{{ route('frontend.pages.about') }}">about</a> </li>
                             <li id="contact"> <a href="{{ route('frontend.pages.contact') }}"> contact </a> </li>


                             @auth

                                 @if ($logged_in_user->isAdmin())
                                     <li>
                                         <button><a href="{{ route('admin.dashboard') }}"> {{ $logged_in_user->name }}
                                             </a></button>
                                     </li>
                                 @endif

                                 @if ($logged_in_user->isUser())
                                     <li>
                                         <button><a href="{{ route('frontend.user.dashboard') }}">
                                                 {{ $logged_in_user->name }} </a></button>
                                     </li>
                                 @endif
                             @else
                                 @if (config('boilerplate.access.user.registration'))
                                     <li>
                                         <button><a data-toggle="modal" href="#login-popup" data- target="#login-popup">
                                                 Sign In </a></button>
                                     </li>
                                 @endif

                             @endauth

                         </ul>

                     </div>
                 </div>
             </div>
         </div>
     </nav>

 </header>
