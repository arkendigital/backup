@extends("layouts.master")

@section("content")

  <div class="section-hero" style="background-image: url({{ $page->section->image }}); border-color: {{ $page->section->color }};"></div>

  <div class="website-container" style="margin-bottom: 0;">
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
  </div>

  <div class="website-container">

    <div class="actuarial-employers">
      @foreach($societies as $society)
        <a href="{{ $society->link }}" class="actuarial-employers-box" target="_blank">
          <div>
            <img class="actuarial-employers-box-logo" alt="{{ $society->name }}" title="{{ $society->name }}" src="{{ $society->logo }}">
            <p class="actuarial-employers-box-name">{{ $society->name }}</p>
          </div>
        </a>
      @endforeach
    </div>

    @include('partials.carousel-ticker')


    <div class="clear margin-bottom--medium"></div>

  </div><!-- /.website-container -->


  @include("widgets.loop")

  @include("partials.join-discussion", [
    "advert" => isset($page_adverts[0]["discussion-widget"]) ? $page_adverts[0]["discussion-widget"] : [],
    "category_id" => $page->discussion_category_id
  ])

@endsection
