@extends("layouts.master")

@section("content")

  <div class="section-hero" style="background-image: url(/images/temp/uni-corner-section-hero-bg.png); border-color: {{ $section->color }};"></div>

  <div class="website-container view-section">
    <div class="website-container-content">

      <h1>{{ $page->getField("page_title") }}</h1>

      {!! $page->getField("page_content") !!}

    </div>
    <div class="website-container-sidebar">
      @include("partials.sidebar.uni-corner")
    </div>

    <div class="clear"></div>

    <div class="carousel">Exam Entry Opens Monday 29 January 2018 • Exam Entry Opens Monday 29 January 2018 • Exam Entry Opens Monday 29 January 2018</div>

    <img src="/images/temp/jobs-advertise-banner.png" alt="" title="" class="margin-top--medium">

  </div><!-- /.website-container -->


  @include("partials.uni-corner-select")

  @include("partials.join-discussion", [
    "category_id" => $page->discussion_category_id
  ])

@endsection
