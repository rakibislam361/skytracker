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

                     <a class="navbar-logo" href="{{ route('frontend.index') }}">
                         <img src="{{ asset(get_setting('frontend_logo_menu')) }}"
                             alt="{{ get_setting('site_name') }}" />
                     </a>
                 </div>
     </nav>

 </header>
