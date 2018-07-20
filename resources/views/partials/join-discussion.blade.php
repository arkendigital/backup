@if(isset($category_id))
  @php
    $discussions = App\Models\Discussion::where("category_id", $category_id)
      ->take(8)
      ->orderBy("created_at", "DESC")
      ->get();
  @endphp
@else
  @php
    $discussions = App\Models\Discussion::take(8)
      ->orderBy("created_at", "DESC")
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

    <a class="homepage-information-title margin-top--large margin-bottom--large" href="{{ route("front.discussion.index") }}">Join our discussions</a>
    <p class="homepage-information-text"></p>

    @if(!$discussions->isEmpty())

      <div class="homepage-discussion-slider swiper-container margin-bottom--medium">
        <div class="swiper-wrapper">

          @foreach($discussions as $discussion)
            <div class="homepage-discussion-slider-box swiper-slide @if($discussion->image_path == "") homepage-discussion-slider-box--no-image @endif" @if($discussion->image_path != "") style="background-image:url({{ $discussion->image }});" @endif>
              <div class="homepage-discussion-slider-box-hover">
                <a href="/discussion/{{ $discussion->category->slug }}/{{ $discussion->slug }}">
                  <p class="homepage-discussion-slider-box-title">{{ $discussion->name }}</p>
                  <p class="homepage-discussion-slider-box-text">{{ $discussion->excerpt }}</p>
                </a>
              </div>
            </div>
          @endforeach

        </div>
      </div>

    @endif

  </div><!-- /.website-container -->
</div><!-- /.homepage-information -->


@push("scripts-after")
  <script>
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
  </script>
@endpush
