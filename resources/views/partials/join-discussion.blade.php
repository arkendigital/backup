@if(isset($category_id))
  @php
    $discussions = App\Models\Discussion::where("category_id", $category_id)
      ->take(8)
      ->get();
  @endphp
@else
  @php
    $discussions = App\Models\Discussion::take(8)
      ->get();
  @endphp
@endif

<div class="homepage-information">
  <div class="website-container">

    @if(isset($with) && $with == "banner")
      <img src="/images/temp/jobs-advertise-banner.png" alt="" title="" class="margin-top--medium">
    @endif

    @if(isset($advert) && !empty($advert))
      <a href="{{ $advert["url"] }}" target="_blank">
        <img src="{{ $advert["image"] }}" alt="" title="" class="margin-top--medium">
      </a>
    @endif

    <p class="homepage-information-title margin-top--large">Join our discussions</p>
    <p class="homepage-information-text">Ut eos enisciaspe ma dolorpo rerunti oreseque di ulparum etur seque vellaut int facea am inciuscius.</p>

    <div class="homepage-discussion-slider swiper-container margin-bottom--medium">
      <div class="swiper-wrapper">

        @foreach($discussions as $discussion)
          <div class="homepage-discussion-slider-box swiper-slide">
            <div class="homepage-discussion-slider-box-hover">
              <a href="/discussion/{{ $discussion->category->slug }}/{{ $discussion->slug }}">
                <p class="homepage-discussion-slider-box-title">{{ $discussion->name }}</p>
                <p class="homepage-discussion-slider-box-text">Ut eos enisciaspe ma dolorpo rerunti oreseque di ulparum.</p>
              </a>
            </div>
          </div>
        @endforeach
        {{--
        <div class="homepage-discussion-slider-box swiper-slide">
          <div class="homepage-discussion-slider-box-hover">
            <div>
              <p class="homepage-discussion-slider-box-title">Name of discussion</p>
              <p class="homepage-discussion-slider-box-text">Ut eos enisciaspe ma dolorpo rerunti oreseque di ulparum.</p>
            </div>
          </div>
        </div>
        <div class="homepage-discussion-slider-box swiper-slide">
          <div class="homepage-discussion-slider-box-hover">
            <div>
              <p class="homepage-discussion-slider-box-title">Name of discussion</p>
              <p class="homepage-discussion-slider-box-text">Ut eos enisciaspe ma dolorpo rerunti oreseque di ulparum.</p>
            </div>
          </div>
        </div>
        <div class="homepage-discussion-slider-box swiper-slide">
          <div class="homepage-discussion-slider-box-hover">
            <div>
              <p class="homepage-discussion-slider-box-title">Name of discussion</p>
              <p class="homepage-discussion-slider-box-text">Ut eos enisciaspe ma dolorpo rerunti oreseque di ulparum.</p>
            </div>
          </div>
        </div>
        <div class="homepage-discussion-slider-box swiper-slide">
          <div class="homepage-discussion-slider-box-hover">
            <div>
              <p class="homepage-discussion-slider-box-title">Name of discussion</p>
              <p class="homepage-discussion-slider-box-text">Ut eos enisciaspe ma dolorpo rerunti oreseque di ulparum.</p>
            </div>
          </div>
        </div>
        <div class="homepage-discussion-slider-box swiper-slide">
          <div class="homepage-discussion-slider-box-hover">
            <div>
              <p class="homepage-discussion-slider-box-title">Name of discussion</p>
              <p class="homepage-discussion-slider-box-text">Ut eos enisciaspe ma dolorpo rerunti oreseque di ulparum.</p>
            </div>
          </div>
        </div>
        --}}

      </div>
    </div>

  </div><!-- /.website-container -->
</div><!-- /.homepage-information -->


@push("scripts-after")
  <script>
  var swiper = new Swiper('.homepage-discussion-slider', {
    slidesPerView: 4,
    spaceBetween: 20,
  });
  </script>
@endpush
