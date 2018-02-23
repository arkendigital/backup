<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>404 - Page Not Found</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="404">

  <div class="error-404-container">
    <div>

      <img class="error-404-image" src="{{ asset("/images/404/404.png") }}">

      <h1 class="error-404-title">Oops. Page not found!</h1>

      <p class="error-404-text">Not sure what’s happened here but it looks like the page can’t be found</p>

      <div class="error-404-button-container">
        <a class="error-404-button" href="/">Homepage</a>
      </div>

    </div>
  </div>

</body>
</html>
