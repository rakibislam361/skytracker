<!doctype html>
<html lang="{{ htmlLang() }}" @langrtl dir="rtl" @endlangrtl>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ appName() }} | @yield('title')</title>
  <meta name="description" content="@yield('meta_description', appName())">
  <meta name="author" content="@yield('meta_author', 'Anthony Rappa')">
  @yield('meta')

  <link href="{{ asset('css/icons.css') }}" rel="stylesheet">
  @stack('before-styles')
  <link href="{{ mix('css/backend.css') }}" rel="stylesheet">
  <livewire:styles />
  @stack('after-styles')
</head>

<body class="hold-transition sidebar-mini text-sm">

  <div class="wrapper">
    @include('backend.includes.header')

    @include('backend.includes.sidebar')

    <div class="content-wrapper">

      @include('includes.partials.read-only')
      @include('includes.partials.logged-in-as')
      @include('includes.partials.announcements')

      <section class="content-header">
        @include('includes.partials.messages')
        @include('backend.includes.partials.breadcrumbs') 
        
      </section> <!-- section -->

      <section class="content">
        @yield('content')
      </section> <!-- section -->
    </div> <!-- content -->

    @include('backend.includes.footer')
  </div> <!-- wrapper -->

  @stack('before-scripts')
  <script src="{{ mix('js/manifest.js') }}"></script>
  <script src="{{ mix('js/vendor.js') }}"></script>
  <script src="{{ mix('js/backend.js') }}"></script>
  <livewire:scripts />
  @stack('after-scripts')
</body>

</html>