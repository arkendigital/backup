@extends("layouts.master")

@section("content")

  <div class="section-hero" style="background-image: url(/images/temp/jobs-section-hero-bg.png); border-color: {{ $section->color }};"></div>

  <div class="website-container view-section">
    <div class="website-container-content">

      <h1>{{ $page->getField("page_title") }}</h1>

      {!! $page->getField("page_content") !!}

    </div>
    <div class="website-container-sidebar">
      @include("partials.sidebar.jobs")
    </div>

    <div class="clear"></div>

    <img src="/images/temp/jobs-advertise-banner.png" alt="" title="">

  </div><!-- /.website-container -->

  @include("partials.latest-jobs")
  @include("partials.join-discussion", [
    "category_id" => $page->discussion_category_id
  ])

@endsection
