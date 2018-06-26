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
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,600,700" rel="stylesheet">
    <link href="https://use.fontawesome.com/releases/v5.0.8/css/all.css" rel="stylesheet">
    <link href="{{ asset("css/vendor.css") }}" rel="stylesheet">
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
</head>
<body>
  @include("layouts.header")

  @yield("content")

  @include("layouts.footer")

  @if(session("alert"))
    <div class="alert">
      <div class="alert_inner">
        <p class="alert_title">{{ session("alert_title") }}</p>
        <p class="alert_message">{{ session("alert_message") }}</p>
        <a class="alert_button">{{ session("alert_button") }}</a>
      </div>
    </div>
  @endif

  <!-- Scripts -->
  @stack("scripts-before")
    <script src="{{ asset("js/vendor.js") }}"></script>
    <script src="{{ asset("js/editor.js") }}"></script>
    <script src="{{ asset("js/app.js") }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.matchHeight/0.7.2/jquery.matchHeight-min.js"></script>
    <script>
        $(document).euCookieLawPopup().init({
            cookiePolicyUrl : "<?php echo url('privacy-cookies'); ?>",
            popupPosition : 'bottom',
            colorStyle : 'default',
            compactStyle : false,
            popupTitle : 'We use cookies to enhance your experience. By continuing to visit this site you agree to our use of cookies.',
            popupText : '',
            buttonContinueTitle : 'Continue',
            buttonLearnmoreTitle : 'More Info',
            buttonLearnmoreOpenInNewWindow : false,
            agreementExpiresInDays : 30,
            autoAcceptCookiePolicy : false,
            htmlMarkup : null
        });
    </script>
  @stack("scripts-after")

  @include("sweet::alert")
</body>
</html>
