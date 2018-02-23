<!DOCTYPE html>
<html class="login_page">
  <head>
    <title>Register</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset("css/app.css") }}">
  </head>
  <body class="login_page">

    <a href="/">
      <img src="/images/logo.png" alt="Actuaries Online" title="Actuaries Online" class="login_page_logo">
    </a>

    <form class="login_page_form" action="{{ route("register") }}" method="POST">
      {{ csrf_field() }}
      {{ method_field("POST") }}

      <div class="login_page_form_actions">
        <a href="{{ route("register") }}" class="login_page_form_actions_item login_page_form_actions_item_active">Sign up</a>
        <a href="{{ route("login") }}" class="login_page_form_actions_item">Log in</a>
      </div>

      @if($errors->has("exists"))
        <p class="login_page_form_item_error">{{ $errors->first("exists") }}</p>
      @else
        <p class="login_page_form_text">Cras justo odio, dapibus ac facilisis in, egestas eget quam. Cras justo odio,dapibus ac facilisis in, ege ras justo dapibus ac facilisis</p>
      @endif

      <div class="login_page_form_social">
        <i class="fa fa-facebook-official fa-2x"></i>
        <i class="fa fa-twitter-square fa-2x"></i>
        <i class="fa fa-linkedin-square fa-2x"></i>
      </div>

      <div class="login_page_form_item">
        <label class="login_page_form_item_label" for="name">Your Name</label>
        @if($errors->has("name"))
          <p class="login_page_form_item_error">{{ $errors->first("name") }}</p>
        @endif
        <input class="login_page_form_item_input" type="text" name="name" id="name" value="{{ old("name") }}">
      </div>

      <div class="login_page_form_item">
        <label class="login_page_form_item_label" for="email">Your Email</label>
        @if($errors->has("email"))
          <p class="login_page_form_item_error">{{ $errors->first("email") }}</p>
        @endif
        <input class="login_page_form_item_input" type="email" name="email" id="email" value="{{ old("email") }}">
      </div>

      <div class="login_page_form_item">
        <label class="login_page_form_item_label" for="username">User Name</label>
        @if($errors->has("username"))
          <p class="login_page_form_item_error">{{ $errors->first("username") }}</p>
        @endif
        <input class="login_page_form_item_input" type="text" name="username" id="username" value="{{ old("username") }}">
      </div>

      <div class="login_page_form_item">
        <label class="login_page_form_item_label" for="password">Create Password</label>
        @if($errors->has("password"))
          <p class="login_page_form_item_error">{{ $errors->first("password") }}</p>
        @endif
        <input class="login_page_form_item_input" type="password" name="password" id="password" value="{{ old("password") }}">
      </div>

      <input class="login_page_form_submit" value="Register" type="submit">
    </form>

  </body>
</html>
