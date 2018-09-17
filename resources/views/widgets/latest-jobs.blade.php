<div class="box-select lazy {{-- box-select-slider --}}" data-src="/images/temp/homepage-latest-jobs-bg.png">
  <div class="box-select-container">

    <p class="box-select-title">Featured Jobs</p>
    <p class="box-select-text"></p>

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
       $jobs = App\Models\Job::take(6)
        ->where("featured", 1)
        ->orderBy("created_at", "DESC")
        ->get();
     }
    @endphp

    @if(isset($jobs))
      @foreach($jobs as $job)
          <a class="box-select-item" href="{{ route("job.show", $job) }}">{{ $job->title }}</a>
      @endforeach
    @endif

    <div class="clear"></div>

    <a class="box-select-button box-select-button--white margin-top--medium margin-bottom--medium" href="/discussion/jobs">Join our discussion</a>

    <div class="clear"></div>

    {{-- <img src="/images/icons/arrow-down--white.png" alt="Scroll Down" title="Scroll Down"> --}}

  </div>
</div><!-- /.box-select -->


{{--
@push("scripts-after")
  <script>
  var swiper = new Swiper('.latest-jobs-slider', {
    slidesPerView: 3,
    spaceBetween: 100,
    breakpoints: {
      550: {
        slidesPerView: 1,
      },
      830: {
        slidesPerView: 2,
      }
    }
  });
  </script>
@endpush
--}}
