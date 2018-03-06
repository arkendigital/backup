@extends("layouts.master")

@section("content")

  <div class="section-hero" style="background-image: url(/images/temp/cvsupport-section-hero-bg.png); border-color: {{ $section->color }};"></div>

  <div class="website-container view-section">
    <div class="website-container-content">

      <h1>{{ $page->getField("page_title") }}</h1>

      {!! $page->getField("page_content") !!}

    </div>
    <div class="website-container-sidebar">
    </div>

    <div class="clear"></div>

  </div><!-- /.website-container -->

  @include("partials.join-discussion", [
    "advert" => isset($page_adverts[0]["discussion-widget"]) ? $page_adverts[0]["discussion-widget"] : [],
    "category_id" => $page->discussion_category_id
  ])

@endsection
