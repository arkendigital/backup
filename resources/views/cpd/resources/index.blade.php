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
      @include("cpd.sidebar", [
        "key" => "resources"
      ])
    </div>

    <div class="clear"></div>

    <div class="resource-list">
      @foreach($resources as $resource)
        <div class="resource-list-item">
          <img class="resource-list-item-icon" src="{{ $resource->icon }}" alt="{{ $resource->name }}" title="{{ $resource->name }}">
          <a class="resource-list-item-title" href="/cpd/resources/{{ $resource->slug }}">{{ $resource->name }}</a>
          <p class="resource-list-item-text">{{ $resource->excerpt }}</p>
        </div><!-- /.resource-list-item -->
      @endforeach
    </div><!-- /.resource-list -->

    <div class="clear"></div>

  </div><!-- /.website-container -->

  @include("partials.cpd-select")
  @include("partials.join-discussion", [
    "advert" => isset($page_adverts[0]["discussion-widget"]) ? $page_adverts[0]["discussion-widget"] : [],
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
