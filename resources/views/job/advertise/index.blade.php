@extends("layouts.master")

@section("content")

  <div class="section-hero" style="background-image: url(/images/temp/jobs-section-hero-bg.png); border-color: #d62731;"></div>

  <div class="website-container view-section">
    <div class="website-container-content">

      <h1>{{ $page->section->name }}</h1>
      <h2>{{ $page->getField("page_title") }}</h2>

      <p>{!! $page->getField("page_content") !!}</p>

      <div class="section-link-with-button">
        <span>Interested in advertising with us</span>
        <a href="">Click</a>
      </div>

      <div class="section-link-with-button">
        <span>Advertising specification</span>
        <a href="">Click</a>
      </div>

    </div>
    <div class="website-container-sidebar">
      @include("partials.sidebar.jobs", ["key" => "advertise"])
    </div>

    <div class="clear"></div>

    <img src="/images/temp/jobs-advertise-banner.png" alt="" title="">

  </div><!-- /.website-container -->

  @include("partials.latest-jobs")
  @include("partials.join-discussion", [
    "category_id" => $page->discussion_category_id
  ])

@endsection
