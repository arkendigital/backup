@extends("layouts.master")

@section("content")

  <div class="section-hero" style="background-image: url({{ $section->image }}); border-color: {{ $section->color }};"></div>

  <div class="website-container">
    <div class="website-container-content view-section">

      <h1>{{ $page->getField("page_title") }}</h1>

      {!! $page->getField("page_content") !!}

    </div>

    <div class="website-container-sidebar">
      @include("partials.sidebar", [
        "sidebar" => $page->section->sidebar
      ])
    </div>

    <div class="clear"></div>

    @if(isset($page_adverts[0]["main-content"]))
      @include('partials.advert', [
        'advert' => $page_adverts[0]["main-content"]
      ])
    @endif

  </div><!-- /.website-container -->

  @foreach($page->getWidgets() as $widget)
    @if($widget->is_visible)
      @include("widgets.".$widget->widget["slug"], [
        "group" => $widget->getBoxGroup($widget->widget["slug"])
      ])
    @endif
  @endforeach

  @include("partials.join-discussion", [
    "category_id" => $page->discussion_category_id
  ])

@endsection
