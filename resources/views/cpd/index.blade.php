@extends("layouts.master")

@section("content")

  <div class="section-hero" style="background-image: url(/images/temp/cpd-section-hero-bg.png); border-color: #ffd600;"></div>

  <div class="website-container view-section">
    <div class="website-container-content">

      <h1>{{ $page->section->name }}</h1>

      <h2>{{ $page->getField("page_title") }}</h2>

      <p>{!! $page->getField("page_content") !!}</p>

    </div>
    <div class="website-container-sidebar">
      @include("partials.sidebar.cpd")
    </div>

    <div class="clear"></div>

  </div><!-- /.website-container -->


  @include("partials.cpd-select")
  @include("partials.join-discussion", [
    "with" => "banner",
    "category_id" => $page->discussion_category_id
  ])

@endsection
