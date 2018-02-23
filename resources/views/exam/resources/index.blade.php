@extends("layouts.master")

@section("content")

  <div class="section-hero" style="background-image: url({{ $page->section->image }}); border-color: {{ $page->section->color }};"></div>

  <div class="website-container view-section">
    <div class="website-container-content">

      <h1>{{ $page->section->name }}</h1>

      <h2>{{ $page->getField("page_title") }}</h2>

      <p>{!! $page->getField("page_content") !!}</p>

    </div>
    <div class="website-container-sidebar">
      @include("partials.sidebar.exams", [
        "key" => "resources"
      ])
    </div>

    <div class="clear"></div>

    <div class="resource-list">
      @foreach($resources as $resource)
        <div class="resource-list-item">
          <img class="resource-list-item-icon" src="{{ $resource->icon }}" alt="{{ $resource->name }}" title="{{ $resource->name }}">
          <a class="resource-list-item-title" href="/exams/resources/{{ $resource->slug }}">{{ $resource->name }}</a>
          <p class="resource-list-item-text">{{ $resource->excerpt }}</p>
        </div><!-- /.resource-list-item -->
      @endforeach
    </div><!-- /.resource-list -->

    <div class="clear"></div>

    <div class="carousel">{{ $page->section->getField("exam_carousel") }}</div>

  </div><!-- /.website-container -->

  @include("partials.exams-select")
  @include("partials.join-discussion", [
    "with" => "banner",
    "category_id" => $page->discussion_category_id
  ])

  @push("scripts-after")
    <script>
    $(function() {
      $(".resource-list-item").matchHeight();
    });
    </script>
  @endpush

@endsection
