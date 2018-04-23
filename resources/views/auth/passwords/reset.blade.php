<!DOCTYPE html>
<html class="login_page">
  <head>
    <title>Reset Password</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset("css/app.css") }}">
  </head>
  <body class="login_page">

    <a href="/">
      <img src="/images/logo.png" alt="Actuaries Online" title="Actuaries Online" class="login_page_logo">
    </a>

    <form method="POST" class="login_page_form" action="{{ route('password.request') }}">
        <div class="login_page_form_actions">
            <a href="{{ route("register") }}" class="login_page_form_actions_item">Sign up</a>
            <a href="{{ route("login") }}" class="login_page_form_actions_item">Log in</a>
        </div>

        {{ csrf_field() }}
        <input type="hidden" name="token" value="{{ $token }}">

        <p class="login_page_form_text">Please fill out the fields below.</p>

        <div class="login_page_form_item">
            <label class="login_page_form_item_label" for="email">E-Mail Address</label>
            @if($errors->has("email"))
                <p class="login_page_form_item_error">{{ $errors->first("email") }}</p>
            @endif
            <input id="email" type="email" class="login_page_form_item_input" name="email" value="{{ $email or old('email') }}" required autofocus>
        </div>

        <div class="login_page_form_item">
            <label class="login_page_form_item_label" for="password">Password</label>
            @if($errors->has("password"))
                <p class="login_page_form_item_error">{{ $errors->first("password") }}</p>
            @endif
            <input id="password" type="password" class="login_page_form_item_input" name="password" required>
        </div>

        <div class="login_page_form_item">
            <label class="login_page_form_item_label" for="password_confirmation">Confirm Password</label>
            @if($errors->has("password_confirmation"))
                <p class="login_page_form_item_error">{{ $errors->first("password_confirmation") }}</p>
            @endif
          <input id="password-confirm" type="password" class="login_page_form_item_input" name="password_confirmation" required>
        </div>

        <button type="submit" class="login_page_form_submit" style="margin-top: -10px">
            Reset Password
        </button>
    </form>

  </body>
</html>

