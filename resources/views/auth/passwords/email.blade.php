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

    <form class="login_page_form" method="POST" action="{{ route('password.email') }}">
        <div class="login_page_form_actions">
            <a href="{{ route("register") }}" class="login_page_form_actions_item">Sign up</a>
            <a href="{{ route("login") }}" class="login_page_form_actions_item">Log in</a>
        </div>

        <p class="login_page_form_text">To reset your password, please enter your email and instructions will be sent to you.</p>

        {{ csrf_field() }}

        <div class="login_page_form_item">
            <label class="login_page_form_item_label" for="email">Email Address</label>
            @if($errors->has("email"))
                <p class="login_page_form_item_error">{{ $errors->first("email") }}</p>
            @endif
            <input id="email" type="email" class="login_page_form_item_input" name="email" value="{{ old('email') }}" required>
        </div>

        <button type="submit" class="login_page_form_submit" style="margin-top: -10px">
            Send Password Reset Link
        </button>
    </form>
  </body>
</html>
