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


          <div class="clear"></div>

          <br><br>

          <h2 class="account_page_wrap_title">Account Details</h2>

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
            <input class="account_page_form_item_input" type="tel" name="phone_number" id="phone_number" @if(null === old("phone_number")) value="{{ auth()->user()->phone_number }}" @else value="{{old("phone_number")}}" @endif>
          </div>

          <div class="account_page_form_item">
            <label class="account_page_form_item_label" for="username">User Name</label>
            @if($errors->has("username"))
              <p class="account_page_form_item_error">{{ $errors->first("username") }}</p>
            @endif
            <input class="account_page_form_item_input" required type="text" name="username" id="username" @if(null === old("username")) value="{{ auth()->user()->username }}" @else value="{{old("username")}}" @endif>
          </div>

          <div class="account_page_form_item">
            <label class="account_page_form_item_label" for="arn">Actuarial Reference Number (ARN)</label>
            @if($errors->has("arn"))
              <p class="account_page_form_item_error">{{ $errors->first("arn") }}</p>
            @endif
            <input class="account_page_form_item_input" type="text" name="arn" id="arn" value="{{ session()->exists("errors") ? old("arn") : auth()->user()->arn }}">
          </div>

          <div class="account_page_form_item">
            <label class="account_page_form_item_label" for="current_role">Current Role</label>
            @if($errors->has("current_role"))
              <p class="account_page_form_item_error">{{ $errors->first("current_role") }}</p>
            @endif
            <input class="account_page_form_item_input" type="text" name="current_role" id="current_role" value="{{ session()->exists("errors") ? old("current_role") : auth()->user()->current_role }}">
          </div>

          <div class="account_page_form_item">
            <label class="account_page_form_item_label" for="company_name">Company</label>
            @if($errors->has("company_name"))
              <p class="account_page_form_item_error">{{ $errors->first("company_name") }}</p>
            @endif
            <input class="account_page_form_item_input" type="text" name="company_name" id="company_name" value="{{ session()->exists("errors") ? old("company_name") : auth()->user()->company_name }}">
          </div>

          <div class="account_page_form_item">
            <label class="account_page_form_item_label" for="location">Location</label>
            @if($errors->has("location"))
              <p class="account_page_form_item_error">{{ $errors->first("location") }}</p>
            @endif
            <input class="account_page_form_item_input" type="text" name="location" id="location" value="{{ session()->exists("errors") ? old("location") : auth()->user()->location }}">
          </div>

          <div class="account_page_form_item">
            <label class="account_page_form_item_label" for="experience">Years of Experience</label>
            @if($errors->has("experience"))
              <p class="account_page_form_item_error">{{ $errors->first("experience") }}</p>
            @endif
            <select name="experience" class="account_page_form_item_select">
                <option value="">Select...</option>
                @for($x = 1; $x < 25; $x++)
                    <option value="{{ $x }}"
                    @if(session()->exists("errors"))
                        @if(old("experience") == $x) selected @endif
                    @else
                        @if(auth()->user()->experience == $x) selected @endif
                    @endif
                    >{{ $x }}</option>
                @endfor
                <option value="25+"
                    @if(session()->exists("errors"))
                        @if(old("experience") == "25+") selected @endif
                    @else
                        @if(auth()->user()->experience == "25+") selected @endif
                    @endif
                >25+</option>
            </select>
          </div>

          <div class="account_page_form_item">
              <label class="account_page_form_item_label" for="internal_marketing">Internal Marketing</label>
              <div class="checkbox_wrapper">
                  <input type="checkbox" name="internal_marketing" id="internal_marketing"
                      @if(session()->exists("errors"))
                          @if(old("internal_marketing")) checked @endif
                      @else
                          @if(auth()->user()->internal_marketing) checked @endif
                      @endif
                  >
                  <label for="internal_marketing">I would like to recieve marketing emails from actuaries.online</label>
              </div>
          </div>

          <div class="account_page_form_item">
              <label class="account_page_form_item_label" for="external_marketing">External Marketing</label>
              <div class="checkbox_wrapper">
                  <input type="checkbox" name="external_marketing" id="external_marketing"
                      @if(session()->exists("errors"))
                          @if(old("external_marketing")) checked @endif
                      @else
                          @if(auth()->user()->external_marketing) checked @endif
                      @endif
                  >
                  <label for="external_marketing">I would like to recieve marketing emails your assosiated companies</label>
              </div>
          </div>

          <div class="account_page_form_item account_image">
            <img src="{{ auth()->user()->avatar }}" alt="" title="" class="account_page_form_photo" id="avatar-image">
            <input type="file" name="image" style="display: none;" id="avatar">
            <p>Click photo to edit</p>
          </div>

          <input class="account_page_form_submit" value="Update my details" type="submit" style="margin-top: -15px">

        </form>

        <h2 class="account_page_wrap_title" style="margin-top: 50px;">Account Utilities</h2>

        <form action="{{ route("account.updatePassword", auth()->user()) }}" method="POST">
          {{ csrf_field() }}
          {{ method_field("PATCH") }}

          <div class="account_page_form_item">
            <label class="account_page_form_item_label" for="old_password">Password</label>
            @if($errors->has("old_password"))
              <p class="account_page_form_item_error">{{ $errors->first("old_password") }}</p>
            @endif
            <input class="account_page_form_item_input" type="password" name="old_password" id="old_password" placeholder="Old password">
          </div>


          @if($errors->has("new_password"))
            <p class="account_page_form_item_error">{{ $errors->first("new_password") }}</p>
          @endif
          <div class="account_page_form_double">
            <div class="account_page_form_item">
              <input class="account_page_form_item_input" type="password" name="new_password" id="new_password" placeholder="New password">
            </div>

            <div class="account_page_form_item">
              @if($errors->has("new_password_confirmation"))
                <p class="account_page_form_item_error">{{ $errors->first("new_password_confirmation") }}</p>
              @endif
              <input class="account_page_form_item_input" type="password" name="new_password_confirmation" id="new_password_confirmation" placeholder="Confirm new password">
            </div>

            <div class="clear"></div>

            <input class="account_page_form_submit" value="Update password" type="submit">

            <div class="clear"></div>

            <p><a href=""><input class="account_page_form_submit account_page_back" value="Back" type="button"></a></p>
          </div>

        </form>

        <p><button class="account_page_form_submit account_page_delete" type="button">Delete Account</button></p>

        <form id="delete_account_form" action="{{ route("account.destroy", auth()->user()) }}" method="POST" style="display: none;">
            {{ csrf_field() }}
            {{ method_field("DELETE") }}
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

    <script src="{{ asset("js/vendor.js") }}"></script>
    <script src="{{ asset("js/app.js") }}"></script>

  </body>
</html>
