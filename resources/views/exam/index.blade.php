@extends("layouts.master")

@section("content")

  <div class="section-hero" style="background-image: url({{ $page->section->image }}); border-color: {{ $page->section->color }};"></div>

  <div class="website-container">
    <div class="website-container-content view-section">

      <h1>{{ $page->getField("page_title") }}</h1>

      {!! $page->getField("page_content") !!}

    </div>

    <div class="website-container-sidebar">
      @include("partials.sidebar.exams")
    </div>

    <div class="clear"></div>

    <div class="website-container">
    <div class="carousel">
      <div class="ticker">
      @foreach (json_decode($page->section->getField("exams", "exam_carousel")) as $item)
        <p class="ticker__item">{{ $item }}</p>
      @endforeach
      </div>
    </div>

    </div>

  </div><!-- /.website-container -->

  @include("widgets.loop")

  @include("partials.join-discussion", [
    "advert" => isset($page_adverts[0]["discussion-widget"]) ? $page_adverts[0]["discussion-widget"] : [],
    "category_id" => $page->discussion_category_id
  ])

@endsection
