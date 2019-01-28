<!DOCTYPE html>
<html class="login_page">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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

      @if($errors->any())
          <p class="login_page_form_item_error">We were unable to register you due to some validation errors below, please attend to the fields marked red</p>
      @else
          @if($errors->has("exists"))
            <p class="login_page_form_item_error">{{ $errors->first("exists") }}</p>
          @else
            {{-- <p class="login_page_form_text">Cras justo odio, dapibus ac facilisis in, egestas eget quam. Cras justo odio,dapibus ac facilisis in, ege ras justo dapibus ac facilisis</p> --}}
          @endif
      @endif

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
        <label class="login_page_form_item_label" for="name">Your Name <sup>*</sup></label>
        @if($errors->has("name"))
          <p class="login_page_form_item_error">{{ $errors->first("name") }}</p>
        @endif
        <input class="login_page_form_item_input" type="text" name="name" id="name" value="{{ old("name") }}">
      </div>

      <div class="login_page_form_item">
        <label class="login_page_form_item_label" for="email">Your Email <sup>*</sup></label>
        @if($errors->has("email"))
          <p class="login_page_form_item_error">{{ $errors->first("email") }}</p>
        @endif
        <input class="login_page_form_item_input" type="email" name="email" id="email" value="{{ old("email") }}">
      </div>

      <div class="login_page_form_item">
        <label class="login_page_form_item_label" for="username">Choose a Username (Your email and name will not be published)</label>
        @if($errors->has("username"))
          <p class="login_page_form_item_error">{{ $errors->first("username") }}</p>
        @endif
        <input class="login_page_form_item_input" type="text" name="username" id="username" value="{{ old("username") }}">
      </div>

      {{--
          *
          * Temporary removal of these fields requested by Actuaries on 21/11/2018
          *
          <div class="login_page_form_item">
            <label class="login_page_form_item_label" for="arn">Actuarial Reference Number (ARN)</label>
            @if($errors->has("arn"))
              <p class="login_page_form_item_error">{{ $errors->first("arn") }}</p>
            @endif
            <input class="login_page_form_item_input" type="text" name="arn" id="arn" value="{{ old("arn") }}">
          </div>

          <div class="login_page_form_item">
            <label class="login_page_form_item_label" for="current_role">Current Role</label>
            @if($errors->has("current_role"))
              <p class="login_page_form_item_error">{{ $errors->first("current_role") }}</p>
            @endif
            <input class="login_page_form_item_input" type="text" name="current_role" id="current_role" value="{{ old("current_role") }}">
          </div>

          <div class="login_page_form_item">
            <label class="login_page_form_item_label" for="company_name">Company</label>
            @if($errors->has("company_name"))
              <p class="login_page_form_item_error">{{ $errors->first("company_name") }}</p>
            @endif
            <input class="login_page_form_item_input" type="text" name="company_name" id="company_name" value="{{ old("company_name") }}">
          </div>

          <div class="login_page_form_item">
            <label class="login_page_form_item_label" for="location">Location</label>
            @if($errors->has("location"))
              <p class="login_page_form_item_error">{{ $errors->first("location") }}</p>
            @endif
            <input class="login_page_form_item_input" type="text" name="location" id="location" value="{{ old("location") }}">
          </div>

          <div class="login_page_form_item">
            <label class="login_page_form_item_label" for="experience">Years of Experience</label>
            @if($errors->has("experience"))
              <p class="login_page_form_item_error">{{ $errors->first("experience") }}</p>
            @endif
            <select name="experience" class="login_page_form_item_select">
                <option value="">Select...</option>
                @for($x = 1; $x < 25; $x++)
                    <option value="{{ $x }}" @if(old("experience") == $x) selected @endif>{{ $x }}</option>
                @endfor
                <option value="25+" @if(old("experience") == "25+") selected @endif>25+</option>
            </select>
          </div>
      --}}

      <div class="login_page_form_item">
        <label class="login_page_form_item_label" for="password">Create Password <sup>*</sup></label>
        @if($errors->has("password"))
          <p class="login_page_form_item_error">{{ $errors->first("password") }}</p>
        @endif
        <input class="login_page_form_item_input" type="password" name="password" id="password" value="{{ old("password") }}">
      </div>

      <div class="login_page_form_item">
          <label class="login_page_form_item_label" for="terms">Terms and Conditions <sup>*</sup></label>
          @if($errors->has("terms"))
            <p class="login_page_form_item_error">{{ $errors->first("terms") }}</p>
          @endif
          <div class="checkbox_wrapper">
              <input type="checkbox" name="terms" id="terms" @if(old("terms")) checked @endif>
              <label for="terms">I have read and agree to the <a href="{{ url("/terms-and-conditions") }}" target="_blank">terms and conditions</a> for registering and using this site</label>
          </div>
      </div>

      <div class="login_page_form_item">
          <label class="login_page_form_item_label" for="privacy">Cookies and Privacy <sup>*</sup></label>
          @if($errors->has("privacy"))
            <p class="login_page_form_item_error">{{ $errors->first("privacy") }}</p>
          @endif
          <div class="checkbox_wrapper">
              <input type="checkbox" name="privacy" id="privacy" @if(old("privacy")) checked @endif>
              <label for="privacy">I have read and agree to the <a href="{{ url("/privacy-cookies") }}" target="_blank">cookies and privacy policy</a></label>
          </div>
      </div>

      <div class="login_page_form_item">
          <label class="login_page_form_item_label" for="internal_marketing">Internal Marketing</label>
          <div class="checkbox_wrapper">
              <input type="checkbox" name="internal_marketing" id="internal_marketing"
                @if(session()->exists("errors"))
                    @if(old("internal_marketing")) checked @endif
                @endif
              >
              <label for="internal_marketing">I would like to receive marketing emails from actuariesonline.com</label>
          </div>
      </div>

      <div class="login_page_form_item">
          <label class="login_page_form_item_label" for="external_marketing">External Marketing</label>
          <div class="checkbox_wrapper">
              <input type="checkbox" name="external_marketing" id="external_marketing"
                @if(session()->exists("errors"))
                    @if(old("external_marketing")) checked @endif
                @endif
              >
              <label for="external_marketing">I would like to receive marketing emails from your associated companies</label>
          </div>
      </div>

      <input class="login_page_form_submit" value="Register" type="submit">
    </form>

  </body>
</html>
