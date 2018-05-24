@extends("layouts.master")

@section("content")

  <div class="section-hero" style="background-image: url({{ $page->section->image }}); border-color: {{ $page->section->color }};"></div>

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
  </div>

  <div class="website-container">

    <div class="actuarial-employers">
      @foreach($employers as $employer)
        @if($employer->link != "")
            <a href="{{ $employer->link }}" class="actuarial-employers-box" target="_blank">
        @else
            <a href="/uni-corner/actuarial-employers/{{ $employer->slug }}" class="actuarial-employers-box">
        @endif
          <div>
            <img class="actuarial-employers-box-logo" alt="{{ $employer->name }}" title="{{ $employer->name }}" src="{{ $employer->logo }}">
            <p class="actuarial-employers-box-name">{{ $employer->name }}</p>
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
