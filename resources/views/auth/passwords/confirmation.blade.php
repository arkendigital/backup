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

    <form class="login_page_form">
        <div class="login_page_form_actions">
            <a href="{{ route("register") }}" class="login_page_form_actions_item">Sign up</a>
            <a href="{{ route("login") }}" class="login_page_form_actions_item">Log in</a>
        </div>

        <p class="login_page_form_text">Great! We have a sent you an email with instructions on how to reset your password. You should receive this shortly.</p>

    </form>
  </body>
</html>
