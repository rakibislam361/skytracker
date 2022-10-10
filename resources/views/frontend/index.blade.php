<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ appName() }}</title>
  <meta name="description" content="@yield('meta_description', appName())">
  <meta name="author" content="@yield('meta_author', 'Anthony Rappa')">
  @yield('meta')

  @include('frontend.style.style')
</head>

<body>
  <div id="app" class="flex-center position-ref full-height">

    <main class="wrapper">

      @include('frontend.content.header')

      <article>

        @include('frontend.content.banner')

        @include('frontend.content.trackproduct')

        @include('frontend.content.aboutus')

      </article>

      @include('frontend.content.footer')

      @include('frontend.auth.login')
      {{-- @include('frontend.auth.register') --}}

    </main>
    <div class="to-top theme-clr-bg transition"> <i class="fa fa-angle-up"></i> </div>



  </div>
  <!--app-->


</body>

</html>