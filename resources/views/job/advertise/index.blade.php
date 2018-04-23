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

      <p>Ut eos enisciaspe ma dolorpo rerunti oreseque di ulparum etur seque vellaut int facea am inci uscius. Con comnis alictatus veligni hillessequia core, sin peribea quatem nost liae modi tectoru ptaturio illant as am exerite mporepedis vel eoste est, qui is suntis expliqui am, tem alis dolor
tent. quatem nost liae modi tectoru ptaturio illant.</p>

      <div class="advertising-toggle-item-specification-title">Get in touch to advertise with us</div>
      <div class="advertising-toggle-item-specification-number">01234 56789</div>

    </div><!-- /#advert-specification -->

    <div class="advertising-toggle-item advertising-toggle-item-form display-none" id="advert-form">
      <form action="" method="POST">
        {{ csrf_field() }}
        {{ method_field("POST") }}

        <div class="advertising-toggle-item-form-item">
          <label>Company name</label>
          <input type="text" name="company_name">
        </div>

        <div class="advertising-toggle-item-form-item">
          <label>Your name</label>
          <input type="text" name="name">
        </div>

        <div class="advertising-toggle-item-form-item">
          <label>Contact number</label>
          <input type="tel" name="phone">
        </div>

        <div class="advertising-toggle-item-form-item">
          <label>Email</label>
          <input type="email" name="email">
        </div>

        <div class="advertising-toggle-item-form-item-full">
          <label>Comment</label>
          <textarea name="comment"></textarea>
        </div>

        <button type="submit" class="advertising-toggle-item-form-submit">Submit</button>

      </form>

      <div class="clear"></div>

      <div class="advertising-toggle-item-form-bar"></div>
    </div><!-- /#advert-form -->

    <div class="clear"></div>

    <img src="/images/temp/jobs-advertise-banner.png" alt="" title="">

  </div><!-- /.website-container -->

  @include("partials.latest-jobs")
  @include("partials.join-discussion", [
    "category_id" => $page->discussion_category_id
  ])

@endsection
