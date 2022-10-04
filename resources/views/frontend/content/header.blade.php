 <header class="header-main">
   <nav class="menu-bar font2-title1">
     <div class="theme-container container">
       <div class="row">
         <div class="col-md-2 col-sm-2">
           <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-controls="navbar">
             <span class="sr-only">Toggle navigation</span>
             <span class="icon-bar"></span>
             <span class="icon-bar"></span>
             <span class="icon-bar"></span>
           </button>
           <a class="navbar-logo" href="{{ route('frontend.index') }}"> <img src="assets/img/logo/logo-black.png" alt="logo" /> </a>
         </div>
         <div class="col-md-10 col-sm-10 fs-12">
           <div id="navbar" class="collapse navbar-collapse no-pad">
             <ul class="navbar-nav theme-menu">
               <li> <a href="{{ route('frontend.index') }}">Home</a> </li>
               <li id="about"> <a href="{{ route('frontend.pages.about') }}">about</a> </li>
               <li id="tracking"> <a href="{{ route('frontend.pages.tracking') }}"> tracking </a> </li>
               <li id="contact"> <a href="{{ route('frontend.pages.contact') }}"> contact </a> </li>

               <li>
                 @auth
                 @if ($logged_in_user->isUser())
                 <button><a href="{{ route('frontend.user.dashboard') }}"> Dashboard </a></button>
                 @endif

                 <button><a href="{{ route('frontend.user.account') }}"> Account</a></button>
                 @else

                 @if (config('boilerplate.access.user.registration'))
                 <button><a data-toggle="modal" href="#login-popup" data- target="#login-popup"> Sign In </a></button>
                 @endif

                 @endauth
               </li>


             </ul>

           </div>
         </div>
       </div>
     </div>
   </nav>
 </header>