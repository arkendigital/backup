@extends("layouts.master")

@section("content")

  <div class="section-hero" style="background-image: url({{ $section->image }}); border-color: {{ $section->color }};"></div>

  <div class="website-container view-section" style="margin-bottom: 0;">
    <div class="website-container-content website-container-content-full">

      <h1>{{ $employer->name }}</h1>

      {!! $employer->description !!}

    </div>

    <div class="clear"></div>
  </div>

  <div class="website-container">

    <div class="actuarial-employers-view-info">
      <img class="actuarial-employers-view-info-logo" src="{{ $employer->logo }}" alt="{{ $employer->name }}" title="{{ $employer->name }}">

      <div class="actuarial-employers-view-info-name">
        <p>{{ $employer->name }}</p>
        @if($employer->email != "")
          <p>{{ $employer->email }}</p>
        @endif
      </div>

      <a class="actuarial-employers-view-info-button" href="{{ $employer->link }}" target="_blank">Join</a>
    </div>

    <div class="carousel">{{ $page->section->getField("exams", "exam_carousel") }}</div>

    <div class="actuarial-employers">
      @foreach($employers as $loop_employer)
        <a href="/uni-corner/actuarial-employers/{{ $loop_employer->slug }}" class="actuarial-employers-box @if($loop_employer->id == $employer->id) actuarial-employers-box-active @endif">
          <div>
            <img class="actuarial-employers-box-logo" alt="{{ $loop_employer->name }}" title="{{ $loop_employer->name }}" src="{{ $loop_employer->logo }}">
            <p class="actuarial-employers-box-name">{{ $loop_employer->name }}</p>
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
