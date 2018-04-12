@extends("layouts.master")

@section("content")

  <div class="section-hero" style="background-image: url({{ $section->image }}); border-color: {{ $section->color }};"></div>

  <div class="website-container view-section" style="margin-bottom: 0;">
    <div class="website-container-content view-section">

      <h1>{{ $society->name }}</h1>

      {!! $society->description !!}

    </div>
    <div class="website-container-sidebar">

      @if($society->image_path != "")
        <img src="{{ $society->image }}" alt="{{ $society->name }}" title="{{ $society->name }}">
      @endif

      <div class="society-view-sidebar-info">
        @if($society->logo_path != "")
          <img src="{{ $society->logo }}" alt="{{ $society->name }}" title="{{ $society->name }}">
        @endif

        <p>{{ $society->name }}</p>
        <p>{{ $society->email }}</p>
        <a href="{{ $society->link }}">Join</a>
      </div>

    </div>

    <div class="clear"></div>
  </div>

  <div class="website-container">

    <div class="actuarial-employers">
      @foreach($societies as $loop_society)
        <a href="/regional-societies/{{ $loop_society->slug }}" class="actuarial-employers-box @if($society->id == $loop_society->id) actuarial-employers-box-active @endif">
          <div>
            <img class="actuarial-employers-box-logo" alt="{{ $loop_society->name }}" title="{{ $loop_society->name }}" src="{{ asset("images/icons/ao-white.png") }}">
            <p class="actuarial-employers-box-name">{{ $loop_society->name }}</p>
          </div>
        </a>
      @endforeach
    </div>

    @include('partials.carousel-ticker')

    <div class="clear margin-bottom--medium"></div>

    @if(isset($page_adverts[0]["main-content"]))
      <a href="{{ $page_adverts[0]["main-content"]["url"] }}" target="_blank" class="advert-box">
        <img src="{{ $page_adverts[0]["main-content"]["image"] }}" alt="" title="">
      </a>
    @endif

  </div><!-- /.website-container -->


  @include("widgets.loop")

  @include("partials.join-discussion", [
    "category_id" => $page->discussion_category_id
  ])

@endsection
