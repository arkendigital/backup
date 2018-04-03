<div class="box-select box-select-slider" style="background-image:url(/images/temp/homepage-latest-jobs-bg.png);">
  <div class="box-select-container">

    <p class="box-select-title">The latest jobs here</p>
    <p class="box-select-text">Click below to get the latest information on available jobs</p>

    <div class="latest-jobs-slider swiper-container">
      <div class="swiper-wrapper">

        @php
          if (isset($experience)) {
            $jobs = App\Models\Job::where("experience", $experience)
              ->orderBy("created_at", "DESC")
              ->get();
          }

          elseif(isset($status_id)) {
            $jobs = App\Models\Job::where("status_id", $status_id)
              ->orderBy("created_at", "DESC")
              ->get();
          }

         else {
           $jobs = App\Models\Job::take(9)
            ->orderBy("created_at", "DESC")
            ->get();
         }
        @endphp

        @if(isset($jobs))
          @foreach($jobs as $job)
          <div class="swiper-slide">
            <a class="box-select-item" href="/jobs/vacancies/{{ $job->slug }}">{{ $job->title }}</a>
          </div>
          @endforeach
        @endif

      </div>
    </div>

    <div class="clear"></div>

    <a class="box-select-button bg-dark-blue margin-top--medium margin-bottom--medium" href="/discussion/jobs">Join our discussion</a>

    <div class="clear"></div>

    <img src="/images/icons/arrow-down--white.png" alt="Scroll Down" title="Scroll Down">

  </div>
</div><!-- /.box-select -->


@push("scripts-after")
  <script>
  var swiper = new Swiper('.latest-jobs-slider', {
    slidesPerView: 3,
    spaceBetween: 100,
    breakpoints: {
      830: {
        slidesPerView: 2,
      },
      550: {
        slidesPerView: 1,
      }
    }
  });
  </script>
@endpush