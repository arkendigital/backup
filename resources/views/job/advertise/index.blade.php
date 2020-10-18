@extends("layouts.master")

@section("content")

  <div class="section-hero" style="background-image: url(/images/temp/jobs-section-hero-bg.png); border-color: #d62731;"></div>

  <div class="website-container">
    <div class="website-container-content view-section">

      <h1>{{ $page->section->name }}</h1>
      <h2>{{ $page->getField("page_title") }}</h2>

      <p>{!! $page->getField("page_content") !!}</p>

      <div class="section-link-with-button">
        <span>Interested in advertising with us</span>
        <a class="advertising-toggle cursor-pointer" data-id="advert-form">Click</a>
      </div>

      <div class="section-link-with-button">
        <span>Advertising specification</span>
        <a class="advertising-toggle cursor-pointer" data-id="advert-specification">Click</a>
      </div>

    </div>

    <div class="website-container-sidebar">
      @include("partials.sidebar", [
        "sidebar" => $page->section->sidebar
      ])
    </div>

    <div class="clear"></div>

    <div class="advertising-toggle-item advertising-toggle-item-specification display-none" id="advert-specification">

      <div class="advertising-toggle-item-specification-title">Advert specifications</div>

      <div class="advertising-toggle-item-specification-spec advertising-toggle-item-specification-spec-large">945 x 446px</div>
      <div class="advertising-toggle-item-specification-spec advertising-toggle-item-specification-spec-medium">945 x 223px</div>
      <div class="advertising-toggle-item-specification-spec advertising-toggle-item-specification-spec-small">945 x 100px</div>

      <div class="advertising-toggle-item-specification-title margin-top--medium">Get in touch to advertise with us</div>
      <div class="advertising-toggle-item-specification-number"><a href="mailto:advertise@actuariesonline.com">advertise@actuariesonline.com</a></div>

    </div><!-- /#advert-specification -->

    <div class="advertising-toggle-item advertising-toggle-item-form @if(!$errors->any()) display-none @endif" id="advert-form">
      <form action="" method="POST">
        {{ csrf_field() }}
        {{ method_field("POST") }}
        
        <input type="hidden" name="recaptcha" id="recaptcha">

        @if($errors->any())
            <p class="advertising-toggle-item-form-error"><strong>There were some errors in your submission, please check below</strong></p>
        @endif

        <div class="advertising-toggle-item-form-item">
          @if($errors->has("company_name"))
              <p class="advertising-toggle-item-form-error">{{ $errors->first("company_name") }}</p>
          @endif
          <label>Company name</label>
          <input type="text" name="company_name" value="{{ old("company_name") }}">
        </div>

        <div class="advertising-toggle-item-form-item">
          @if($errors->has("name"))
              <p class="advertising-toggle-item-form-error">{{ $errors->first("name") }}</p>
          @endif
          <label>Your name</label>
          <input type="text" name="name" value="{{ old("name") }}">
        </div>

        <div class="advertising-toggle-item-form-item">
          @if($errors->has("phone"))
              <p class="advertising-toggle-item-form-error">{{ $errors->first("phone") }}</p>
          @endif
          <label>Contact number</label>
          <input type="tel" name="phone" value="{{ old("phone") }}">
        </div>

        <div class="advertising-toggle-item-form-item">
          @if($errors->has("email"))
              <p class="advertising-toggle-item-form-error">{{ $errors->first("email") }}</p>
          @endif
          @if($errors->has("email_confirmation"))
              <p class="advertising-toggle-item-form-error">{{ $errors->first("email_confirmation") }}</p>
          @endif
          <label>Email</label>
          <input type="email" name="email" value="{{ old("email") }}">
        </div>

        <div class="advertising-toggle-item-form-item">
          <label>Confirm Email</label>
          <input type="email" name="email_confirmation" value="{{ old("email_confirmation") }}">
        </div>

        <div class="advertising-toggle-item-form-item advertising-toggle-item-form-item-full">
          @if($errors->has("comment"))
              <p class="advertising-toggle-item-form-error">{{ $errors->first("comment") }}</p>
          @endif
          <label>Comment</label>
          <textarea name="comment">{{ old("comment") }}</textarea>
        </div>

        <button type="submit" class="advertising-toggle-item-form-submit">Submit</button>
        
      </form>
      

      <div class="clear"></div>
        <p style="padding: 10px 20px;">This website is protected by reCAPTCHA v3</p>
      <div class="advertising-toggle-item-form-bar"></div>
      
    </div><!-- /#advert-form -->

    <div class="clear"></div>

  </div><!-- /.website-container -->

  @include("partials.latest-jobs")
  @include("partials.join-discussion", [
    "advert" => isset($page_adverts[0]["discussion-widget"]) ? $page_adverts[0]["discussion-widget"] : [],
    "category_id" => $page->discussion_category_id
  ])

  @if($errors->any())
      @push("scripts-after")
          <script>
            $('html, body').animate({
                scrollTop: $(".advertising-toggle-item-form").offset().top - 50
            }, 1000);
          </script>
      @endpush
  @endif

@endsection

<script src="https://www.google.com/recaptcha/api.js?render={{ config('services.recaptcha.sitekey') }}"></script>
          <script>
            grecaptcha.ready(function() {
                grecaptcha.execute('{{ config('services.recaptcha.sitekey') }}', {action: 'advertise'}).then(function(token) {
                    if (token) {
                    document.getElementById('recaptcha').value = token;
                    }
                });
            });
          </script>
