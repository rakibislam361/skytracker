 <header>

     <div id="header-sticky" class="main-header">
         <div class="container-fluid header-container-p">
             <div class="row align-items-center">
                 <div class="col-lg-3 col-md-6">
                     <div class="logo">
                         <a href="{{ route('frontend.index') }}"><img src="{{ asset(get_setting('frontend_logo_menu')) }}" class="mobile-logo" alt="Logo"></a>
                     </div>
                 </div>
                 <div class="col-lg-9 col-md-6 d-none d-md-block">
                     <div class="menu-area">
                         <div class="main-menu">
                             <div class="mean-push"></div>
                             <nav id="mobile-menu" style="display: none;">
                                 <ul>
                                     @php
                                     $headers = DB::table('pages')
                                     ->where('hearder', 1)
                                     ->get();
                                     @endphp
                                     <li class="active"><a href="{{ route('frontend.index') }}">Home</a></li>

                                     {{-- <li><a href="{{ route('frontend.auth.login') }}">Login</a></li> --}}
                                     {{-- <li><a href="{{ route('frontend.auth.register') }}">Register</a></li> --}}


                                     @foreach ($headers as $header)
                                     <li>
                                         <a href="/page/{{ $header->slug }}">{{ $header->title }}</a>
                                     </li>
                                     @endforeach
                                     @auth
                                     @if ($logged_in_user->isAdmin())
                                     <li>
                                         <a href="{{ route('admin.dashboard') }}">
                                             {{ $logged_in_user->name }} </a>
                                     </li>
                                     @endif

                                     @if ($logged_in_user->isUser())
                                     <li>
                                         <a href="{{ route('frontend.user.dashboard') }}">
                                             {{ $logged_in_user->name }} </a>
                                     </li>
                                     @endif
                                     @else
                                     @if (config('boilerplate.access.user.registration'))
                                     <li>
                                         <a href="{{ route('frontend.auth.login') }}">Login</a>
                                     </li>
                                     <li><a href="{{ route('frontend.auth.register') }}">Register</a></li>
                                     @endif

                                     @endauth
                                     </li>
                                     {{-- <li><a href="{{ route('frontend.pages.tracking') }}">Tracking</a></li> --}}
                                     <li><a href="#">Support</a></li>

                                 </ul>
                             </nav>
                         </div>


                         <div class="header-btn">
                             <!-- <a href="#" class="btn" data-toggle="modal" data-target="#exampleModalLong"><img src="img/icon/calculator-symbols.png" alt="icon">Get Fare Rate</a> -->

                             @auth
                             @if ($logged_in_user->isAdmin())
                             <li>
                                 <a href="{{ route('admin.dashboard') }}" class="btn">
                                     {{ $logged_in_user->name }} </a>
                             </li>
                             @endif

                             @if ($logged_in_user->isUser())
                             <li>
                                 <a href="{{ route('frontend.user.dashboard') }}" class="btn">
                                     {{ $logged_in_user->name }} </a>
                             </li>
                             @endif
                             @else
                             @if (config('boilerplate.access.user.registration'))
                             <li>
                                 <a href="{{ route('frontend.auth.login') }}" class="btn">Login/Register</a>
                             </li>
                             @endif

                             @endauth
                             {{-- <a href="{{ route('frontend.pages.tracking') }}" class="btn"
                             data-target="#exampleModalLong">Track Your
                             Order</a> --}}
                             <a href="#" class="btn">Track Your
                                 Order</a>
                         </div>
                     </div>
                 </div>
                 <div class="col-12">
                     <div class="mobile-menu mean-container">

                     </div>
                 </div>
                 <!-- Modal Search -->
                 <div class="modal fade" id="search-modal" tabindex="-1" role="dialog" aria-hidden="true">
                     <div class="modal-dialog" role="document">
                         <div class="modal-content">
                             <form>
                                 <input type="text" placeholder="Search here..." spellcheck="false" data-ms-editor="true">
                                 <button><i class="fa fa-search"></i></button>
                             </form>
                         </div>
                     </div>
                 </div>
                 <!-- Modal -->
                 {{-- @include('frontend.pages.tracking') --}}
                 @include('frontend.pages.shippingInformationModal')

             </div>
         </div>
 </header>