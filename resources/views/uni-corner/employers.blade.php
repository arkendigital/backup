@extends("layouts.master")

@section("content")

  <div class="section-hero" style="background-image: url({{ $page->section->image }}); border-color: {{ $page->section->color }};"></div>

  <div class="website-container view-section">
    <div class="website-container-content">

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
      @foreach($employers as $employer)
        <a href="/uni-corner/actuarial-employers/{{ $employer->slug }}" class="actuarial-employers-box">
          <div>
            <img class="actuarial-employers-box-logo" alt="{{ $employer->name }}" title="{{ $employer->name }}" src="{{ $employer->logo }}">
            <p class="actuarial-employers-box-name">{{ $employer->name }}</p>
          </div>
        </a>
      @endforeach
    </div>

    <div class="carousel">{{ $page->section->getField("exams", "exam_carousel") }}</div>

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
