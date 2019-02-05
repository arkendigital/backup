@extends("layouts.master")

@section("content")
  
  <div class="section-hero" style="background-image: url({{ $section->image }}); border-color: {{ $section->color }};"></div>

  <div class="website-container">
    <div class="website-container-content view-section">

      <h1>{{ $section->name }}</h1>

      <h2>{{ $resource->name }}</h2>

      {{-- <p>{!! $resource->content !!}</p> --}}

    </div>
    <div class="website-container-sidebar">
      @include("partials.sidebar", [
        "sidebar" => $section->sidebar
      ])
    </div>

    <div class="clear"></div>

    <div class="resource-list margin-bottom--medium">
      @foreach($resource->links as $link)
        <a class="resource-list-item resource-list-item-with-padding" href="{{ $link->link }}" target="_blank">
          @if($link->text != "")
            <div class="resource-list-item__overlay">
              <div>{{ $link->text }}</div>
            </div>
          @endif
          <div>
            <img class="resource-list-item-icon resource-list-item-icon-small" src="/images/icons/ao.png" alt="Actuaries Online" title="Actuaries Online">
            <span class="resource-list-item-title">{{ $link->title }}</span>
          </div>
        </a><!-- /.resource-list-item -->
      @endforeach
    </div><!-- /.resource-list -->

  </div><!-- /.website-container -->

  @include("widgets.cpd", [
    "group" => App\Models\BoxGroup::where("widget_slug", "cpd")->first()
  ])

  @include("partials.join-discussion", [
    "advert" => $resource->advert,
  ])

  {{-- @include("partials.advert", [
    "advert" => $resource->advert
  ]) --}}

  @push("scripts-after")
    <script>
    $(function() {
      $(".resource-list-item").matchHeight();
    });
    </script>
  @endpush

@endsection
