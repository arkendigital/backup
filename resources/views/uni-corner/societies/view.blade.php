@extends("layouts.master")

@section("content")

  <div class="section-hero" style="background-image: url({{ $section->image }}); border-color: {{ $section->color }};"></div>

  <div class="website-container view-section" style="margin-bottom: 0;">
    <div class="website-container-content website-container-content-full">

      <h1>{{ $society->name }}</h1>

      {!! $society->description !!}

    </div>

    <div class="clear"></div>
  </div>

  <div class="website-container">

    <div class="carousel">{{ $page->section->getField("exams", "exam_carousel") }}</div>

    <div class="actuarial-employers">
      @foreach($societies as $loop_society)
        <a href="/uni-corner/actuarial-societies/{{ $loop_society->slug }}" class="actuarial-employers-box @if($society->id == $loop_society->id) actuarial-employers-box-active @endif">
          <div>
            <img class="actuarial-employers-box-logo" alt="{{ $loop_society->name }}" title="{{ $loop_society->name }}" src="{{ asset("images/icons/ao-white.png") }}">
            <p class="actuarial-employers-box-name">{{ $loop_society->name }}</p>
          </div>
        </a>
      @endforeach
    </div>

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