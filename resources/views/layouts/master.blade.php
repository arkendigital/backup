<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  {!! SEO::generate() !!}

  @include('partials.favicon')

  <!-- Styles -->
  @stack("styles-before")
    <link href="{{ asset("css/app.css") }}" rel="stylesheet">
  @stack("styles-after")

  <!-- Scripts -->
  <script>
    window.Laravel = {!! json_encode([
      'csrfToken' => csrf_token(),
    ]) !!};
    window.App = {!!
      json_encode([
        'homeUrl' => route('index'),
        'signedIn' => auth()->check(),
        'user'     => auth()->user()
      ]);
    !!}
  </script>
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-WX2J4FW');</script>
    <!-- End Google Tag Manager -->
</head>
<body>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WX2J4FW"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
  @include("layouts.header")

  @yield("content")

  @include("layouts.footer")

  @if(session("alert"))
    <div class="alert">
      <div class="alert_inner">
        <p class="alert_title">{{ session("alert_title") }}</p>
        @if(session("new_user"))
            <p class="alert_message"><span class="form_success">{{ session("alert_message") }}</span></p>
        @else
            <p class="alert_message">{{ session("alert_message") }}</p>
        @endif
        <a class="alert_button">{{ session("alert_button") }}</a>
      </div>
    </div>
  @endif

  <!-- Scripts -->
  @stack("scripts-before")
    <link href="{{ asset("css/vendor.css") }}" rel="stylesheet">
    <script src="{{ asset("js/vendor.js") }}"></script>
    <script src="{{ asset("js/app.js") }}" async></script>
  @stack("scripts-after")

  @include("sweet::alert")
</body>
</html>
