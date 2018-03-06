@extends("layouts.master")

@section("content")

  <div class="website-container view-section">
    <div class="website-container-content">

      <h1>{{ $page->getField("page_title") }}</h1>

      {!! $page->getField("page_content") !!}

    </div>
  </div>

  <div class="clear"></div>

@endsection
