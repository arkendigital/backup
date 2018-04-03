@extends("layouts.master")

@section("content")

  <div class="website-container">
    <div class="website-container-content view-section">

      <h1>{{ $page->getField("page_title") }}</h1>

      <p>{!! $page->getField("page_content") !!}</p>

    </div>
    <div class="website-container-sidebar">
      @include("partials.sidebar.jobs", [
        "key" => "vacancies"
      ])
    </div>

  </div><!-- /.website-container -->

  <div class="job-list-container">
    <div class="job-list-container-inner">

      <div class="job-list-banner">

        <div class="job-list-banner-location-label">
          Location
        </div>

        <input type="text" name="filter-location" class="job-list-banner-location-search" placeholder="e.g. London">

        <div class="job-list-banner-sort-by">
          Sort by
          <span>Date</span>
        </div>

        <div class="job-list-banner-showing">
          Showing {{ $jobs->firstItem() }}-{{ $jobs->lastItem() }} of {{ $jobs->total() }}
        </div>
      </div><!-- /.job-list-banner -->

      <div class="job-list-sidebar">
        <p class="job-list-sidebar-title">Filter by</p>

        <form action="/jobs/vacancies" method="POST" id="jobFiltering">
          {{ csrf_field() }}
          {{ method_field("POST") }}

          <div class="job-list-sidebar-inner">

            <div>
              <p class="job-list-sidebar-item-title">KEYWORD SEARCH</p>
              <div class="job-list-sidebar-item">
                <input class="job-list-sidebar-item-input" name="keyword" placeholder="Enter keyword..." @if(session()->exists("job-filter-keyword")) value="{{ session()->get("job-filter-keyword") }}" @endif>
              </div>
            </div>

            <div>
              <p class="job-list-sidebar-item-title">JOB STATUS</p>
              <div class="job-list-sidebar-item checkbox-wrapper">
                <input type="checkbox" class="job-list-sidebar-item-checkbox" id="status-permanent" name="status[]" value="1" @if(session()->exists("job-filter-status") && !empty(session()->get("job-filter-status")) && in_array(1, session()->get("job-filter-status"))) checked @endif>
                <label class="job-list-sidebar-item-label" for="status-permanent">Permanent</label>
              </div>
              <div class="job-list-sidebar-item checkbox-wrapper">
                <input type="checkbox" class="job-list-sidebar-item-checkbox" id="status-contract" name="status[]" value="2" @if(session()->exists("job-filter-status") && !empty(session()->get("job-filter-status")) && in_array(2, session()->get("job-filter-status"))) checked @endif>
                <label class="job-list-sidebar-item-label" for="status-contract">Contract</label>
              </div>
              <div class="job-list-sidebar-item checkbox-wrapper">
                <input type="checkbox" class="job-list-sidebar-item-checkbox" id="status-internship" name="status[]" value="3" @if(session()->exists("job-filter-status") && !empty(session()->get("job-filter-status")) && in_array(3, session()->get("job-filter-status"))) checked @endif>
                <label class="job-list-sidebar-item-label" for="status-internship">Internship</label>
              </div>
            </div>

            <div>
              <p class="job-list-sidebar-item-title">EXPERIENCE</p>
              <div class="job-list-sidebar-item checkbox-wrapper">
                <input type="checkbox" class="job-list-sidebar-item-checkbox" id="status-qualified" name="experience[]" value="qualified" @if(session()->exists("job-filter-experience") && !empty(session()->get("job-filter-experience")) && in_array("qualified", session()->get("job-filter-experience"))) checked @endif>
                <label class="job-list-sidebar-item-label" for="status-qualified">Qualified</label>
              </div>
              <div class="job-list-sidebar-item checkbox-wrapper">
                <input type="checkbox" class="job-list-sidebar-item-checkbox" id="status-almost" name="experience[]" value="almost" @if(session()->exists("job-filter-experience") && !empty(session()->get("job-filter-experience")) && in_array("almost", session()->get("job-filter-experience"))) checked @endif>
                <label class="job-list-sidebar-item-label" for="status-almost">Almost qualified +11 Exams</label>
              </div>
              <div class="job-list-sidebar-item checkbox-wrapper">
                <input type="checkbox" class="job-list-sidebar-item-checkbox" id="status-part" name="experience[]" value="part" @if(session()->exists("job-filter-experience") && !empty(session()->get("job-filter-experience")) && in_array("part", session()->get("job-filter-experience"))) checked @endif>
                <label class="job-list-sidebar-item-label" for="status-part">Part qualified 0-10 Exams</label>
              </div>
              <div class="job-list-sidebar-item checkbox-wrapper">
                <input type="checkbox" class="job-list-sidebar-item-checkbox" id="status-gradute" name="experience[]" value="gradute" @if(session()->exists("job-filter-experience") && !empty(session()->get("job-filter-experience")) && in_array("gradute", session()->get("job-filter-experience"))) checked @endif>
                <label class="job-list-sidebar-item-label" for="status-gradute">Graduate</label>
              </div>
            </div>

            <div>
              <p class="job-list-sidebar-item-title">RECRUITMENT TYPE</p>
              <div class="job-list-sidebar-item checkbox-wrapper">
                <input type="checkbox" class="job-list-sidebar-item-checkbox" id="type-agency" name="type[]" value="agency" @if(session()->exists("job-filter-type") && !empty(session()->get("job-filter-type")) && in_array("agency", session()->get("job-filter-type"))) checked @endif>
                <label class="job-list-sidebar-item-label" for="type-agency">Recruitment Agency</label>
              </div>
              <div class="job-list-sidebar-item checkbox-wrapper">
                <input type="checkbox" class="job-list-sidebar-item-checkbox" id="type-employer" name="type[]" value="direct" @if(session()->exists("job-filter-type") && !empty(session()->get("job-filter-type")) && in_array("direct", session()->get("job-filter-type"))) checked @endif>
                <label class="job-list-sidebar-item-label" for="type-employer">Direct Employer</label>
              </div>
            </div>

            <div>
              <p class="job-list-sidebar-item-title">SECTOR</p>
              <div class="job-list-sidebar-item">
                <select class="job-list-sidebar-item-select">
                  <option value="" class="job-list-sidebar-item-select-default">Banking and Finance</option>
                </select>
              </div>
            </div>

            <p><a class="job-list-sidebar-button" onclick="document.getElementById('jobFiltering').submit()">Search</a></p>

          </div><!-- /.job-list-sidebar-inner -->
        </form>
      </div><!-- /.job-list-sidebar -->

      <div class="job-list-vacancies" id="jobs">
        <p class="job-list-sidebar-title">Featured jobs</p>

        @foreach($featured_jobs as $job)
          <div class="job-list-item job-list-item-featured">
            <img src="{{ $job->company->logo }}" class="job-list-item-logo" alt="{{ $job->company->name }}" title="{{ $job->company->name }}">

            <div class="job-list-item-content">

              <p class="job-list-item-title">{{ $job->title }}</p>

              <p class="job-list-item-text">{{ $job->excerpt }}</p>

              <div class="job-list-item-list">
                <span class="job-list-item-list-key">Salary</span>
                <span class="job-list-item-list-value">&pound;{{ number_format($job->salary) }}</span>
              </div>

              <div class="job-list-item-list">
                <span class="job-list-item-list-key">Location</span>
                <span class="job-list-item-list-value">London</span>
              </div>

              <div class="job-list-item-list">
                <span class="job-list-item-list-key">Date Posted</span>
                <span class="job-list-item-list-value">{{ date("d-m-Y", strtotime($job->created_at)) }}</span>
              </div>
            </div><!-- /.job-list-item-content -->

            <a class="job-list-item-button" href="/jobs/vacancies/{{ $job->slug }}">View</a>
          </div><!-- /.job-list-item -->
        @endforeach

        <div style="display: block; padding: 25px 0; display: block; width: 100%; background: #1a304d; text-align: center; color: white; margin-top: 20px; margin-bottom: 30px;">SPONDERED LINK</div>

        @if($jobs->isEmpty())

          <div class="job-list-item job-list-item-featured">
            Sorry, we couldn't find any job vacancies.
          </div>

        @else

          @foreach($jobs as $job)
            <div class="job-list-item">
              <img src="{{ $job->company->logo }}" class="job-list-item-logo" alt="{{ $job->company->name }}">

              <div class="job-list-item-content">

                <p class="job-list-item-title">{{ $job->title }}</p>

                <p class="job-list-item-text">{{ $job->excerpt }}</p>

                <div class="job-list-item-list">
                  <span class="job-list-item-list-key">Salary</span>
                  <span class="job-list-item-list-value">&pound;{{ number_format($job->salary) }}</span>
                </div>

                <div class="job-list-item-list">
                  <span class="job-list-item-list-key">Location</span>
                  <span class="job-list-item-list-value">{{ $job->location->name }}</span>
                </div>

                <div class="job-list-item-list">
                  <span class="job-list-item-list-key">Date Posted</span>
                  <span class="job-list-item-list-value">{{ date("d-m-Y", strtotime($job->created_at)) }}</span>
                </div>
              </div><!-- /.job-list-item-content -->

              <a class="job-list-item-button" href="/jobs/vacancies/{{ $job->slug }}">View</a>
            </div><!-- /.job-list-item -->
          @endforeach

        @endif

      </div><!-- /.job-list-vacancies -->

    </div><!-- /.job-list-container-inner -->
  </div><!-- /.job-list-container -->

  @include("partials.join-discussion", [
    "category_id" => $page->discussion_category_id
  ])

@endsection
