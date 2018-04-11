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
        <a href="/uni-corner/actuarial-societies/{{ $society->slug }}" class="actuarial-employers-box">
          <div>
            <img class="actuarial-employers-box-logo" alt="{{ $society->name }}" title="{{ $society->name }}" src="{{ asset("images/icons/ao-white.png") }}">
            <p class="actuarial-employers-box-name">{{ $society->name }}</p>
          </div>
        </a>
      @endforeach
    </div>

    @include('partials.carousel-ticker')


    <div class="clear margin-bottom--medium"></div>

    @if(isset($page_adverts[0]["main-content"]))
      <a href="{{ $page_adverts[0]["main-content"]["url"] }}" target="_blank">
        <img src="{{ $page_adverts[0]["main-content"]["image"] }}" alt="" title="">
      </a>
    @endif

  </div><!-- /.website-container -->


  @include("widgets.loop")

  @include("partials.join-discussion", [
    "category_id" => $page->discussion_category_id
  ])

@endsection
