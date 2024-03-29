<!DOCTYPE html>
<html class="login_page">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset("css/app.css") }}">
  </head>
  <body class="login_page">

    <a href="/">
      <img src="/images/logo.png" alt="Actuaries Online" title="Actuaries Online" class="login_page_logo">
    </a>

    <form class="login_page_form" action="{{ route("login") }}" method="POST" style="padding-bottom: 20px">
      {{ csrf_field() }}
      {{ method_field("POST") }}

      @if(isset($_GET["from"]))
        <input type="hidden" name="forward" value="{{ $_GET["from"] }}">
      @endif

      <div class="login_page_form_actions">
        <a href="{{ route("register") }}" class="login_page_form_actions_item">Sign up</a>
        <a href="{{ route("login") }}" class="login_page_form_actions_item login_page_form_actions_item_active">Log in</a>
      </div>

      <div class="login_page_form_social">
        <a href="{{ route('socialAuth', 'facebook') }}">
          <i class="fa fa-facebook-official fa-2x"></i>
        </a>

        <a href="{{ route('socialAuth', 'twitter') }}">
          <i class="fa fa-twitter-square fa-2x"></i>
        </a>

        <a href="{{ route('socialAuth', 'linkedin') }}">
            <i class="fa fa-linkedin-square fa-2x"></i>
        </a>
      </div>

      <div class="login_page_form_item">
        <label class="login_page_form_item_label" for="username">Email</label>
        @if($errors->has("email"))
          <p class="login_page_form_item_error">{{ $errors->first("email") }}</p>
        @endif
        <input class="login_page_form_item_input" type="text" name="email" id="email" value="{{ old("email") }}">
      </div>

      <input type="hidden" name="recaptcha" id="recaptcha">

      <div class="login_page_form_item">
        <label class="login_page_form_item_label" for="password">Password</label>
        @if($errors->has("password"))
          <p class="login_page_form_item_error">{{ $errors->first("password") }}</p>
        @endif
        <input class="login_page_form_item_input" type="password" name="password" id="password" value="{{ old("password") }}">
      </div>

      <p>Forgot your password? <a href="{{ url('/password/reset') }}" title="reset password">Click here to reset it</a></p>
      <input class="login_page_form_submit" value="Log in" type="submit">
      <p>This website is protected by reCAPTCHA v3</p>
    </form>
    
  </body>
  <script src="https://www.google.com/recaptcha/api.js?render={{ config('services.recaptcha.sitekey') }}"></script>
  <script>
         grecaptcha.ready(function() {
             grecaptcha.execute('{{ config('services.recaptcha.sitekey') }}', {action: 'login'}).then(function(token) {
                if (token) {
                  document.getElementById('recaptcha').value = token;
                }
             });
         });
  </script> 
</html>
