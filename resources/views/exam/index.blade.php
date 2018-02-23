@extends("layouts.master")

@section("content")

  <div class="section-hero" style="background-image: url({{ $section->image }}); border-color: {{ $section->color }};"></div>

  <div class="website-container view-section">
    <div class="website-container-content">

      <h1>{{ $page->getField("page_title") }}</h1>

      {!! $page->getField("page_content") !!}

    </div>
    <div class="website-container-sidebar">
      @include("partials.sidebar.exams")
    </div>

    <div class="clear"></div>

    <div class="website-container">

      <div class="carousel">{{ $page->section->getField("exam_carousel") }}</div>

    </div>

  </div><!-- /.website-container -->

  @include("partials.exams-select")
  @include("partials.join-discussion", [
    "with" => "banner",
    "category_id" => $page->discussion_category_id
  ])

@endsection
