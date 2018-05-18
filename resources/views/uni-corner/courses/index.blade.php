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
      @foreach($courses as $course)
        <a href="{{ $course->link }}" class="actuarial-employers-box" target="_blank">
          <div>
            <img class="actuarial-employers-box-logo" alt="{{ $course->name }}" title="{{ $course->name }}" src="{{ asset("images/icons/ao-white.png") }}">
            <p class="actuarial-employers-box-name">{{ $course->name }}</p>
          </div>
        </a>
      @endforeach
    </div>

    @include('partials.carousel-ticker')

    <div class="clear margin-bottom--medium"></div>

    @if(isset($page_adverts[0]["main-content"]))
      @include('partials.advert', [
        'advert' => $page_adverts[0]["main-content"]
      ])
    @endif

  </div><!-- /.website-container -->


  @include("widgets.loop")

  @include("partials.join-discussion", [
    "category_id" => $page->discussion_category_id
  ])

@endsection
