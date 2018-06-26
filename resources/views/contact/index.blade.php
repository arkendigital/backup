<!DOCTYPE html>
<html class="account_page">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
    <title>Account</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset("css/app.css") }}">
  </head>
  <body class="contact_page">

    <div class="contact_page_header">
      <div class="contact_page_header_inner">

        <a href="/">
          <img src="/images/logo.png" alt="Actuaries Online" title="Actuaries Online" class="contact_page_header_logo">
        </a>

      </div><!-- /.contact_page_header_inner -->
    </div><!-- /.contact_page_header -->

    <div class="contact_page_wrap">
      <div class="contact_page_wrap_inner">

        <h1 class="contact_page_title">Contact us</h1>
        <p class="contact_page_text">Fill in the form below and we'll get back to you</p>

        <form action="/contact" method="POST">
          {{ csrf_field() }}
          {{ method_field("POST") }}

          <div class="contact_page_form_item">
            <label class="contact_page_form_item_label" for="first_name">First Name</label>
            @if($errors->has("first_name"))
              <p class="contact_page_form_item_error">{{ $errors->first("first_name") }}</p>
            @endif
            <input class="contact_page_form_item_input" type="text" name="first_name" id="first_name" value="{{ old("first_name") }}">
          </div>

          <div class="contact_page_form_item">
            <label class="contact_page_form_item_label" for="second_name">Second Name</label>
            @if($errors->has("second_name"))
              <p class="contact_page_form_item_error">{{ $errors->first("second_name") }}</p>
            @endif
            <input class="contact_page_form_item_input" type="text" name="second_name" id="second_name" value="{{ old("second_name") }}">
          </div>

          <div class="contact_page_form_item">
            <label class="contact_page_form_item_label" for="email">Email</label>
            @if($errors->has("email"))
              <p class="contact_page_form_item_error">{{ $errors->first("email") }}</p>
            @endif
            <input class="contact_page_form_item_input" type="text" name="email" id="email" value="{{ old("email") }}">
          </div>

          <div class="contact_page_form_item">
            <label class="contact_page_form_item_label" for="phone">Telephone</label>
            @if($errors->has("phone"))
              <p class="contact_page_form_item_error">{{ $errors->first("phone") }}</p>
            @endif
            <input class="contact_page_form_item_input" type="text" name="phone" id="phone" value="{{ old("phone") }}">
          </div>

          <div class="contact_page_form_item">
            <label class="contact_page_form_item_label" for="comment">Comment</label>
            @if($errors->has("comment"))
              <p class="contact_page_form_item_error">{{ $errors->first("comment") }}</p>
            @endif
            <textarea class="contact_page_form_item_textarea" name="comment" id="comment">{{ old("comment") }}</textarea>
          </div>

          <input class="account_page_form_submit" value="Submit" type="submit">

        </form>

      </div><!-- /.contact_page_wrap_inner -->
    </div><!-- /.contact_page_wrap -->

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
