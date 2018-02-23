<!DOCTYPE html>
<html class="account_page">
  <head>
    <title>Account</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset("css/app.css") }}">
  </head>
  <body class="account_page">

    <div class="account_page_header">
      <div class="account_page_header_inner">

        <a href="/">
          <img src="/images/logo.png" alt="Actuaries Online" title="Actuaries Online" class="account_page_header_logo">
        </a>

      </div>

      <div class="account_page_header_user">
        <img src="{{ auth()->user()->avatar }}" alt="" title="" class="">
      </div>
    </div>

    <div class="account_page_wrap">
      {{ csrf_field() }}
      {{ method_field("PATCH") }}

      <div class="account_page_wrap_inner">

        <form action="{{ route("account.update", auth()->user()) }}" method="POST" enctype="multipart/form-data">
          {{ csrf_field() }}
          {{ method_field("PATCH") }}

          <div class="account_page_wrap_intro">
            <h1>My Account</h1>
            <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Cras justo odio, dapibus ac facilisis in, ege ras justo dapibus ac facilisis</p>
          </div>

          <div class="account_page_wrap_photo_wrap">
            <img src="{{ auth()->user()->avatar }}" alt="" title="" class="account_page_form_photo" id="avatar-image">
            <input type="file" name="image" style="display: none;" id="avatar">
            <p>Edit photo</p>
          </div>

          <div class="clear"></div>

          <h2 class="account_page_wrap_title">Account details</h2>

          <div class="account_page_form_item">
            <label class="account_page_form_item_label" for="name">Your Name</label>
            @if($errors->has("name"))
              <p class="account_page_form_item_error">{{ $errors->first("name") }}</p>
            @endif
            <input class="account_page_form_item_input" type="text" name="name" id="name" @if(null === old("name")) value="{{ auth()->user()->name }}" @else value="{{old("name")}}" @endif>
          </div>

          <div class="account_page_form_item">
            <label class="account_page_form_item_label" for="email">Your Email</label>
            @if($errors->has("email"))
              <p class="account_page_form_item_error">{{ $errors->first("email") }}</p>
            @endif
            <input class="account_page_form_item_input" required type="email" name="email" id="email" @if(null === old("email")) value="{{ auth()->user()->email }}" @else value="{{old("email")}}" @endif>
          </div>

          <div class="account_page_form_item">
            <label class="account_page_form_item_label" for="phone_number">Phone Number</label>
            @if($errors->has("phone_number"))
              <p class="account_page_form_item_error">{{ $errors->first("phone_number") }}</p>
            @endif
            <input class="account_page_form_item_input" required type="tel" name="phone_number" id="phone_number" @if(null === old("phone_number")) value="{{ auth()->user()->phone_number }}" @else value="{{old("phone_number")}}" @endif>
          </div>

          <div class="account_page_form_item">
            <label class="account_page_form_item_label" for="username">User Name</label>
            @if($errors->has("username"))
              <p class="account_page_form_item_error">{{ $errors->first("username") }}</p>
            @endif
            <input class="account_page_form_item_input" required type="text" name="username" id="username" @if(null === old("username")) value="{{ auth()->user()->username }}" @else value="{{old("username")}}" @endif>
          </div>

          <input class="account_page_form_submit" value="Update my details" type="submit">

        </form>

        <h2 class="account_page_wrap_title" style="margin-top: 50px;">Account Utilities</h2>

        <form action="{{ route("account.updatePassword", auth()->user()) }}" method="POST">
          {{ csrf_field() }}
          {{ method_field("PATCH") }}

          <div class="account_page_form_item">
            <label class="account_page_form_item_label" for="password">Password</label>
            @if($errors->has("password"))
              <p class="account_page_form_item_error">{{ $errors->first("password") }}</p>
            @endif
            <input class="account_page_form_item_input" type="password" name="password" id="password" placeholder="Old password">
          </div>

          <div class="account_page_form_double">
            <div class="account_page_form_item">
              @if($errors->has("password"))
                <p class="account_page_form_item_error">{{ $errors->first("password") }}</p>
              @endif
              <input class="account_page_form_item_input" type="password" name="password" id="password" placeholder="New password">
            </div>

            <div class="account_page_form_item">
              @if($errors->has("password"))
                <p class="account_page_form_item_error">{{ $errors->first("password") }}</p>
              @endif
              <input class="account_page_form_item_input" type="password" name="password" id="password" placeholder="Confirm new password">
            </div>

            <input class="account_page_form_submit" value="Update password" type="submit">

            <div class="clear"></div>

            <p><a href=""><input class="account_page_form_submit" value="Back" type="button" style="margin-top: 0;"></a></p>
          </div>

        </form>

      </div>
    </div>

    @if(session("alert"))
      <div class="alert">
        <div class="alert_inner">
          <p class="alert_title">{{ session("alert_title") }}</p>
          <p class="alert_message">{{ session("alert_message") }}</p>
          <a class="alert_button">{{ session("alert_button") }}</a>
        </div>
      </div>
    @endif

    <script src="{{ asset("js/app.js") }}"></script>

  </body>
</html>
