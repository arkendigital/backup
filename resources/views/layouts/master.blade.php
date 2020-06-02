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
    <link href="{{ asset("css/app.css") }}?cb={{env('CACHEBUST_KEY', date('Ymd'))}}" rel="stylesheet">
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
    <!-- Google Analytics -->
    <script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-146799820-1', 'auto');
    ga('send', 'pageview');
    </script>
    <!-- End Google Analytics -->
    <!-- Global site tag (gtag.js) - Google Ads: 719018787 -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=AW-719018787"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'AW-719018787');
    </script>
    @yield("head_scripts")
</head>
<body>
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
    <link href="{{ asset("css/vendor.css") }}?cb={{env('CACHEBUST_KEY', date('Ymd'))}}" rel="stylesheet">
    <script src="{{ asset("js/vendor.js") }}?cb={{env('CACHEBUST_KEY', date('Ymd'))}}"></script>
    <script src="{{ asset("js/app.js") }}?cb={{env('CACHEBUST_KEY', date('Ymd'))}}" async></script>
  @stack("scripts-after")

  @include("sweet::alert")
</body>
</html>
