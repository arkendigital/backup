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
                <p class="job-view-header-right-item-right job-view-header-right-item-right-salary">
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
                <p class="job-view-header-right-item-right job-view-header-right-item-right-daily-salary">
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
            <p class="job-view-header-right-item-right job-view-header-right-item-right-location">{{ str_replace("--", "", $job->location->name) }}</p>
          </div>
          @endisset

          <div class="job-view-header-right-item">
            <p class="job-view-header-right-item-left">Date Posted</p>
            <p class="job-view-header-right-item-right job-view-header-right-item-right-date-posted">{{ $job->created_at->diffForHumans() }}</p>
          </div>
        </div>
      </div>

      <div class="job-view-company">
        <img class="job-view-company-logo" src="{{ $job->company->logo }}" alt="" title="">
        <div class="job-view-company-info">{!! $job->company->description !!}</div>
      </div>

      <div class="clear"></div>

      <div class="job-view-content support-lists">
        <p class="job-view-content-title">Job description</p>

        <strong>Experience needed</strong>
        <br/><br/>
        <ul>
          @foreach (json_decode($job->experience, true) as $experience)
            <li>{{ $experience }}</li>
          @endforeach
        </ul>
        <br/><br/>

        <div class="job-view-content-description">{!! $job->content !!}</div>

        @if($job->contact_email)
        <p><a class="job-view-content-button job-view-content-button-apply" href="mailto:{{ $job->contact_email }}">Contact</a></p>
        @endif
        @if($job->apply_link)
        <p><a class="job-view-content-button job-view-content-button-apply" target="_blank" href="{{ $job->apply_link }}" style="margin-top: 10px;">Apply</a></p>
        @endif
        <p><a class="job-view-content-button job-view-content-button-back" onclick="window.history.back()">Back</a></p>
      </div>

      <div class="job-view-salary-date-posted display-none">{{ date("Y-m-d", strtotime($job->created_at)) }}</div>
      <div class="job-view-salary-closing-date display-none">@if($job->end_date != "") {{ date("Y-m-d", strtotime($job->end_date)) }} @else n/a @endif</div>

  </div><!-- /.website-container -->

  @include("partials.latest-jobs")
  @include("partials.join-discussion", [
    "category_id" => $page->discussion_category_id
  ])

@endsection
