@extends("layouts.master")

@section("content")

  <div class="homepage-hero">
    @foreach($slides as $slide)
    <div class="homepage-hero-slide" style="background-image: url({{ $slide->image }});">
      <div>
        <p class="homepage-hero-slide-title">{{ $slide->title }}</p>
        <div class="clear"></div>
        <p class="homepage-hero-slide-text">{{ $slide->text }}</p>
      </div>
    </div>
    @endforeach
  </div>

  <div class="website-container">
    <div class="carousel">
      <div class="ticker">
      @foreach (json_decode($page->section->getField("exams", "exam_carousel")) as $item)
        <p class="ticker__item">{{ $item }}</p>
      @endforeach
      </div>
    </div>

    <div class="homepage-sections">
      @foreach($sections as $section)
        <a href="/{{ $section->slug }}" class="homepage-sections-box" style="background-image: url({{ $section->image }});">
          <div class="homepage-sections-box-title" style="background-color:{{ $section->color }}">{{ $section->name }}</div>
        </a>
      @endforeach
    </div>
  </div><!-- /.website-container -->

  @include("widgets.loop")

  @push("scripts-after")
    <script>
      $(".homepage-hero").slick({
        autoplay: true,
        arrows: false,
        adaptiveHeight: true
      });
    </script>

    <script>
    $(function() {
      var swiper = new Swiper('.homepage-discussion-slider', {
        slidesPerView: 4,
        spaceBetween: 20,
        breakpoints: {
          550: {
            slidesPerView: 1,
          },
          768: {
            slidesPerView: 2,
          },
          1030: {
            slidesPerView: 3,
          }
        }
      });
    });
    </script>
  @endpush

@endsection
