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
        "key" => "links"
      ])
    </div>

    <div class="clear"></div>

    <h2>Official external websites</h2>
    <div class="resource-list margin-bottom--medium">
      @foreach($official_links as $link)
        <div class="resource-list-item resource-list-item-with-padding">
          <img class="resource-list-item-icon resource-list-item-icon-small" src="/images/icons/ao.png" alt="Actuaries Online" title="Actuaries Online">
          <a class="resource-list-item-title" href="{{ $link->link }}">{{ $link->name }}</a>
        </div><!-- /.resource-list-item -->
      @endforeach
    </div><!-- /.resource-list -->

    <div class="clear"></div>

    <h2>Non-Official external websites</h2>
    <p><strong>Uteos enisciaspe ma dolorpo rerunti oreseque di ulparum etur seque vellaut int facea am inci uscius. Con comnis alictatus veligni hillessequia core, sin peribea quatem nost.</strong></p>
    <div class="resource-list">
      @foreach($unofficial_links as $link)
        <div class="resource-list-item resource-list-item-with-padding">
          <img class="resource-list-item-icon resource-list-item-icon-small" src="/images/icons/ao.png" alt="Actuaries Online" title="Actuaries Online">
          <a class="resource-list-item-title" href="{{ $link->link }}">{{ $link->name }}</a>
        </div><!-- /.resource-list-item -->
      @endforeach
    </div><!-- /.resource-list -->

    <div class="clear"></div>

    <div class="carousel">{{ $page->section->getField("exams", "exam_carousel") }}</div>

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
