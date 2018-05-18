@extends("layouts.master")

@section("content")

  <div class="section-hero" style="background-image: url({{ $section->image }}); border-color: {{ $section->color }};"></div>

  <div class="website-container">
    <div class="website-container-content view-section">

      <h1>{{ $section->name }}</h1>

      <h2>{{ $resource->name }}</h2>

      <p>{!! $resource->content !!}</p>

    </div>

    <div class="website-container-sidebar">
      @include("partials.sidebar", [
        "sidebar" => $section->sidebar
      ])
    </div>

    <div class="clear"></div>

  </div><!-- /.website-container -->

@endsection
