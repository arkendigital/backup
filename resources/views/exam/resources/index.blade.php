@extends("layouts.master")

@section("content")

  <div class="section-hero" style="background-image: url({{ $page->section->image }}); border-color: {{ $page->section->color }};"></div>

  <div class="website-container">
    <div class="website-container-content view-section">

      <h1>{{ $page->section->name }}</h1>

      <h2>{{ $page->getField("page_title") }}</h2>

      <p>{!! $page->getField("page_content") !!}</p>

    </div>

    <div class="website-container-sidebar">
      @include("partials.sidebar", [
        "sidebar" => $page->section->sidebar
      ])
    </div>

    <div class="clear"></div>

    <div class="resource-list">
      @foreach($resources as $resource)
        <div class="resource-list-item">
          <div>
            <a class="resource-list-item-title" @if($resource->link != "") href="{{ $resource->link }}" target="_blank" @else href="/exams/resources/{{ $resource->slug }}" @endif>
              <img class="resource-list-item-icon" src="{{ $resource->icon }}" alt="{{ $resource->name }}" title="{{ $resource->name }}"><br>
              {{ $resource->name }}
            </a>
            <p class="resource-list-item-text">{{ $resource->excerpt }}</p>
          </div>
        </div><!-- /.resource-list-item -->
      @endforeach
    </div><!-- /.resource-list -->

    <div class="clear"></div>

    @include('partials.carousel-ticker')


  </div><!-- /.website-container -->


  @include("widgets.loop")

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
