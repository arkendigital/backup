@extends("layouts.master")

@section("content")

  <div class="website-container">

      <div class="job-view-header">
        <div class="job-view-header-left">
          <h1 class="job-view-header-title">Jobs</h1>
          <h2 class="job-view-header-job-title">{{ $job->title }}</h2>
        </div>

        <div class="job-view-header-right">

          @if($job->status_id == 1)
              <div class="job-view-header-right-item">
                <p class="job-view-header-right-item-left">Salary</p>
                <p class="job-view-header-right-item-right">
                    @if($job->min_salary == $job->max_salary)
                        &pound;{{ number_format($job->max_salary) }}
                    @else
                        &pound;{{ number_format($job->min_salary) }} - &pound;{{ number_format($job->max_salary) }}
                    @endif
                </p>
              </div>
          @elseif($job->status_id == 2)
              <div class="job-view-header-right-item">
                <p class="job-view-header-right-item-left">Daily Salary</p>
                <p class="job-view-header-right-item-right">
                    @if($job->min_daily_salary == $job->max_daily_salary)
						&pound;{{ number_format($job->max_daily_salary) }}
					@else
						&pound;{{ number_format($job->min_daily_salary) }} - &pound;{{ number_format($job->max_daily_salary) }}
					@endif
                </p>
              </div>
          @endif

          @isset($job->location)
          <div class="job-view-header-right-item">
            <p class="job-view-header-right-item-left">Location</p>
            <p class="job-view-header-right-item-right">{{ str_replace("--", "", $job->location->name) }}</p>
          </div>
          @endisset

          <div class="job-view-header-right-item">
            <p class="job-view-header-right-item-left">Date Posted</p>
            <p class="job-view-header-right-item-right">{{ $job->created_at->diffForHumans() }}</p>
          </div>
        </div>
      </div>

      <div class="job-view-company">
        <img class="job-view-company-logo" src="{{ $job->company->logo }}" alt="" title="">
        <div class="job-view-company-info">{!! $job->company->description !!}</div>
      </div>

      <div class="clear"></div>

      <div class="job-view-content">
        <p class="job-view-content-title">Job description</p>

        <div class="job-view-content-description">{!! $job->content !!}</div>

        <p><a class="job-view-content-button job-view-content-button-apply" target="_blank" href="{{ $job->apply_link }}">Apply</a></p>
        <p><a class="job-view-content-button job-view-content-button-back" onclick="window.history.back()">Back</a></p>
      </div>

  </div><!-- /.website-container -->

  @include("partials.latest-jobs")
  @include("partials.join-discussion", [
    "category_id" => $page->discussion_category_id
  ])

@endsection
