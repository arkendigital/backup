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

    <div class="resource-list margin-bottom--large">
      @foreach($publications as $publication)
        <div class="resource-list-item">
          <div>
            <img class="resource-list-item-icon" src="{{ asset("/images/cpd/publication.png") }}" alt="{{ $publication->name }}" title="{{ $publication->name }}">
            <a class="resource-list-item-title" href="{{ $publication->link }}" target="_blank">{{ $publication->name }}</a>
          </div>
        </div><!-- /.resource-list-item -->
      @endforeach
    </div><!-- /.resource-list -->

    <div class="clear"></div>

  </div><!-- /.website-container -->

  @include("widgets.cpd", [
    "group" => App\Models\BoxGroup::where("widget_slug", "cpd")->first()
  ])

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
