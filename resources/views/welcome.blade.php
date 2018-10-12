@extends("layouts.master")

@section("content")

  <div class="homepage-hero">
    @foreach($slides as $key => $slide)
    <div class="homepage-hero-slide" style="background-image: url({{ $slide->image }})">

      <div>
        @if ($slide->link)
          <a href="{{ $slide->link }}">
        @endif

        @if($key == 0)
            <h1 class="homepage-hero-slide-title">{{ $slide->title }}</h1>
        @else
            <p class="homepage-hero-slide-title">{{ $slide->title }}</p>
        @endif

        <div class="clear"></div>

        <p class="homepage-hero-slide-text">{{ $slide->text }}</p>

        @if ($slide->link)
          </a>
        @endif
      </div>

      <span class="overlay"></span>

    </div>
    @endforeach
  </div>

  <div class="website-container">
    @include('partials.carousel-ticker', [
      'page' => $exams
    ])

    <div class="homepage-sections">
      @foreach($sections as $section)
        <a href="/{{ $section->slug }}" class="homepage-sections-box lazy" data-src="{{ $section->thumbnail }}">
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
        arrows: true,
        dots: true,
        adaptiveHeight: false,
        speed: 600,
        autoplaySpeed: 6000
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

      var stHeight = ($('.slick-track').height() - 100);
      $('.slick-slide').css('height',stHeight + 'px' );
    });
    </script>
  @endpush

@endsection
