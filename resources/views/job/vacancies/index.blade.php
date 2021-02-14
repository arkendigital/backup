@extends("layouts.master")

@section("head_scripts")
<script id="mcjs">!function(c,h,i,m,p){m=c.createElement(h),p=c.getElementsByTagName(h)[0],m.async=1,m.src=i,p.parentNode.insertBefore(m,p)}(document,"script","https://chimpstatic.com/mcjs-connected/js/users/51760736ffa0ca0ab15a0abbe/bf204fb69eade3dc3e6588cc4.js");</script>
@if($paginator->currentPage()!==1)
<link rel="prev" href="{{ url('actuary-jobs/'.((int)$paginator->currentPage()-1)) }}">
@endif
@if($paginator->hasMorePages())
<link rel="next" href="{{ url('actuary-jobs/'.((int)$paginator->currentPage()+1)) }}">
@endif
<link rel="canonical" href="{{ url('actuary-jobs/'.$paginator->currentPage()) }}">
@endsection

@section("content")

  <div class="section-hero" style="background-image: url({{ $page->section->image }}); border-color: {{ $page->section->color }};"></div>
  <div class="website-container">
    <div class="website-container-content view-section">

      <h1>{{ $page->getField("page_title") }}</h1>

      <p>{!! $page->getField("page_content") !!}</p>

    </div>

    <div class="website-container-sidebar">
      @include("partials.sidebar", [
        "sidebar" => $page->section->sidebar
      ])
    </div>

  </div><!-- /.website-container -->

  <div class="job-list-container">
    <div class="job-list-container-inner">

      <div class="job-list-filter-toggle">Show Filtering</div>

      <div class="job-list-banner">

        <div class="job-list-banner-location-label">
          Sort By
        </div>


        <form action="/actuary-jobs" method="POST" id="jobFiltering">
          {{ csrf_field() }}

          {{-- <input type="hidden" name="type" value="topsearch"> --}}
          {{-- <input type="text" name="location" class="job-list-banner-location-search" placeholder="e.g. London"
            @if (session()->exists('job-filter-location') && !empty(session()->get('job-filter-location')))
              value="{{ session()->get('job-filter-location') }}"
            @endif
          > --}}

          <div class="job-list-banner-sort-by">
            <select name="order">
              <option value="">Select Sort</option>
              <option value="created_at-desc" @if(session()->get('job-filter-order') == 'created_at-desc') selected @endif>Date (Newest First)</option>
              <option value="created_at-asc" @if(session()->get('job-filter-order') == 'created_at-asc') selected @endif>Date (Oldest First)</option>
              <option value="max_salary-asc" @if(session()->get('job-filter-order') == 'max_salary-asc') selected @endif>Salary (Lowest First)</option>
              <option value="max_salary-desc" @if(session()->get('job-filter-order') == 'max_salary-desc') selected @endif>Salary (Hightest First)</option>
            </select>
          </div>

          <button type="submit">Search</button>

          @if(session()->get('job-filter-order'))
            <button type="submit" name="reset_odering" value="1">Reset Sort By</button>
          @endif
          <div class="job-list-banner-sort-by">
            <select name="per_page" id="per_page">
              <option value="">Per page</option>
              <option value="10" @if(session()->get('job-per-page') == 10) selected @endif>10 per page</option>
              <option value="20" @if(session()->get('job-per-page') == 20) selected @endif>20 per page</option>
              <option value="40" @if(session()->get('job-per-page') == 40) selected @endif>40 per page</option>
            </select>
          </div>
        </form>

        <div class="job-list-banner-showing">
          Showing {{ $paginator->firstItem() }}-{{ $paginator->lastItem() }} of {{ $paginator->total() }}
        </div>
        
      </div><!-- /.job-list-banner -->

      <div class="job-list-sidebar">
        <p class="job-list-sidebar-title">Filter by</p>

        <form action="/actuary-jobs" method="POST" id="jobFiltering">
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

              @foreach($job_types as $type)
                <div class="job-list-sidebar-item checkbox-wrapper">
                  <input type="checkbox" class="job-list-sidebar-item-checkbox" id="status-{{ strtolower($type->name) }}" name="status[]" value="{{ $type->id }}" @if(session()->exists("job-filter-status") && !empty(session()->get("job-filter-status")) && in_array($type->id, session()->get("job-filter-status"))) checked @endif>
                  <label class="job-list-sidebar-item-label" for="status-{{ strtolower($type->name) }}">{{ $type->name }}</label>
                </div>
              @endforeach

            </div>

            <div>
              <p class="job-list-sidebar-item-title">EXPERIENCE</p>
              <div class="job-list-sidebar-item checkbox-wrapper">
                <input type="checkbox" class="job-list-sidebar-item-checkbox" id="status-qualified" name="experience[]" value="Qualified" @if(session()->exists("job-filter-experience") && !empty(session()->get("job-filter-experience")) && in_array("Qualified", session()->get("job-filter-experience"))) checked @endif>
                <label class="job-list-sidebar-item-label" for="status-qualified">Qualified</label>
              </div>
              <div class="job-list-sidebar-item checkbox-wrapper">
                <input type="checkbox" class="job-list-sidebar-item-checkbox" id="status-almost" name="experience[]" value="Almost Qualified" @if(session()->exists("job-filter-experience") && !empty(session()->get("job-filter-experience")) && in_array("Almost Qualified", session()->get("job-filter-experience"))) checked @endif>
                <label class="job-list-sidebar-item-label" for="status-almost">Almost Qualified (11+ exams)</label>
              </div>
              <div class="job-list-sidebar-item checkbox-wrapper">
                <input type="checkbox" class="job-list-sidebar-item-checkbox" id="status-part" name="experience[]" value="Part Qualified" @if(session()->exists("job-filter-experience") && !empty(session()->get("job-filter-experience")) && in_array("Part Qualified", session()->get("job-filter-experience"))) checked @endif>
                <label class="job-list-sidebar-item-label" for="status-part">Part Qualified (1-10 exams)</label>
              </div>
              <div class="job-list-sidebar-item checkbox-wrapper">
                <input type="checkbox" class="job-list-sidebar-item-checkbox" id="status-none" name="experience[]" value="No Exams" @if(session()->exists("job-filter-experience") && !empty(session()->get("job-filter-experience")) && in_array("No Exams", session()->get("job-filter-experience"))) checked @endif>
                <label class="job-list-sidebar-item-label" for="status-none">No exams</label>
              </div>
            </div>

            <div>
              <p class="job-list-sidebar-item-title">RECRUITER TYPE</p>
              <div class="job-list-sidebar-item checkbox-wrapper">
                <input type="checkbox" class="job-list-sidebar-item-checkbox" id="type-agency" name="type[]" value="agency" @if(session()->exists("job-filter-type") && !empty(session()->get("job-filter-type")) && session()->get("job-filter-type") != "topsearch" && in_array("agency", session()->get("job-filter-type"))) checked @endif>
                <label class="job-list-sidebar-item-label" for="type-agency">Agency</label>
              </div>
              <div class="job-list-sidebar-item checkbox-wrapper">
                <input type="checkbox" class="job-list-sidebar-item-checkbox" id="type-employer" name="type[]" value="direct" @if(session()->exists("job-filter-type") && !empty(session()->get("job-filter-type")) && session()->get("job-filter-type") != "topsearch" && in_array("direct", session()->get("job-filter-type"))) checked @endif>
                <label class="job-list-sidebar-item-label" for="type-employer">Direct Employer</label>
              </div>
            </div>

            <div>
              <p class="job-list-sidebar-item-title">LOCATION</p>
              <div class="job-list-sidebar-item">
                <select name="location" class="job-list-sidebar-item-select">
                  <option value="" class="job-list-sidebar-item-select-default">All Regions and Locations</option>
                  @foreach($regions as $region)
                      <option value="all-region-{{ $region->id }}"
                          @if(session()->exists("job-filter-region") && session()->get("job-filter-region") == $region->id) selected @endif
                      >{{ $region->name }}</option>
                      @foreach ($locations as $location)
                        @if($location->region_id != $region->id)
                            @continue
                        @endif
                        <option value="{{ $location->id }}" class="job-list-sidebar-item-select-default"
                        @if(session()->exists("job-filter-location") && session()->get("job-filter-location") == $location->id) selected @endif>{{ $location->name }}</option>
                      @endforeach
                  @endforeach
                </select>
              </div>
            </div>

            <div>
              <p class="job-list-sidebar-item-title">SALARY</p>
            </div>

            <div>
              <p class="job-list-sidebar-item-title">PERM (ANNUAL)</p>
              <div class="job-list-sidebar-item">
                <select name="salary" class="job-list-sidebar-item-select">
                  <option value="all" class="job-list-sidebar-item-select-default">All</option>
                  <option value="0-20000" class="job-list-sidebar-item-select-default"
                      @if(session()->exists("job-filter-salary-min") && session()->get("job-filter-salary-min") == "0") selected @endif
                  >0-20k</option>
                  <option value="20000-40000" class="job-list-sidebar-item-select-default"
                      @if(session()->exists("job-filter-salary-min") && session()->get("job-filter-salary-min") == "20000") selected @endif
                  >20-40k</option>
                  <option value="40000-60000" class="job-list-sidebar-item-select-default"
                      @if(session()->exists("job-filter-salary-min") && session()->get("job-filter-salary-min") == "40000") selected @endif
                  >40-60k</option>
                  <option value="60000-80000" class="job-list-sidebar-item-select-default"
                      @if(session()->exists("job-filter-salary-min") && session()->get("job-filter-salary-min") == "60000") selected @endif
                  >60-80k</option>
                  <option value="80000-100000" class="job-list-sidebar-item-select-default"
                      @if(session()->exists("job-filter-salary-min") && session()->get("job-filter-salary-min") == "80000") selected @endif
                  >80-100k</option>
                  <option value="100000-5000000000" class="job-list-sidebar-item-select-default"
                      @if(session()->exists("job-filter-salary-min") && session()->get("job-filter-salary-min") == "100000") selected @endif
                  >100k+</option>
                </select>
              </div>
            </div>

            <div>
              <p class="job-list-sidebar-item-title">CONTRACT (DAILY)</p>
              <div class="job-list-sidebar-item">
                <select name="daily_salary" class="job-list-sidebar-item-select">
                  <option value="0-500" class="job-list-sidebar-item-select-default"
                      @if(session()->exists("job-filter-contract-salary-min") && session()->get("job-filter-contract-salary-min") == "0") selected @endif
                  >0-500</option>
                  <option value="500-750" class="job-list-sidebar-item-select-default"
                      @if(session()->exists("job-filter-contract-salary-min") && session()->get("job-filter-contract-salary-min") == "500") selected @endif
                  >500-750</option>
                  <option value="750-1000" class="job-list-sidebar-item-select-default"
                      @if(session()->exists("job-filter-contract-salary-min") && session()->get("job-filter-contract-salary-min") == "750") selected @endif
                  >750-1000</option>
                  <option value="1000-5000000000" class="job-list-sidebar-item-select-default"
                      @if(session()->exists("job-filter-contract-salary-min") && session()->get("job-filter-contract-salary-min") == "1000") selected @endif
                  >1000+</option>
                </select>
              </div>
            </div>

            <div>
              <p class="job-list-sidebar-item-title">SECTOR</p>
              <div class="job-list-sidebar-item">
                <select name="sector" class="job-list-sidebar-item-select">
                  <option value="" class="job-list-sidebar-item-select-default">All</option>
                  @foreach ($sectors as $sector)
                    <option value="{{ $sector->id }}" class="job-list-sidebar-item-select-default"
                    @if(session()->exists("job-filter-sector") && session()->get("job-filter-sector") == $sector->id) selected @endif>{{ $sector->name }}</option>
                  @endforeach
                </select>
              </div>
            </div>

            <p><button class="btn job-list-sidebar-button" type="submit">Search</button></p>

          </div><!-- /.job-list-sidebar-inner -->
        </form>
      </div><!-- /.job-list-sidebar -->


      <div class="job-list-vacancies" id="jobs">
        @if(!$isSearching)
          <p class="job-list-sidebar-title">Featured jobs</p>
          @foreach($featured_jobs as $job)
            {{ $job->trackImpression() }}
            {{ $job->trackUniqueImpression() }}
            @include("job.vacancies.job", [
              "job" => $job,
              "featured" => true
            ])
          @endforeach
        @else
          <p class="job-list-sidebar-title">
            @if(session()->get("job-filter-keyword"))
              Your Search for "{{ session()->get("job-filter-keyword") }}"
            @elseif(session()->get('job-filter-order'))
              Your Search via sort
            @else
              Your Search via filters
            @endif
          </p>
        @endif

        @if(isset($page_adverts[0]["sponsored-link"]))
          <a href="{{ $page_adverts[0]["sponsored-link"]["url"] }}" target="_blank">
            <img src="{{ $page_adverts[0]["sponsored-link"]["image"] }}" class="sponsored-link">
          </a>
          {{-- <div style="display: block; padding: 25px 0; display: block; width: 100%; background: #1a304d; text-align: center; color: white; margin-top: 20px; margin-bottom: 30px;">SPONSORED LINK</div> --}}
        @endif

        @if(count($paginator->items())===0 && $featured_jobs->isEmpty())

          <div class="job-list-item job-list-item-featured">
            Sorry, we couldn't find any job vacancies.
          </div>

        @elseif(count($paginator->items()) > 0)
          @foreach($paginator->items() as $job)
            {{ $job->trackImpression() }}
            {{ $job->trackUniqueImpression() }}
            @include("job.vacancies.job", [
              "job" => $job,
              "featured" => false
            ])
          @endforeach

        @else

            <div class="job-list-item job-list-item-featured">
              Sorry, we couldn't find any job vacancies matching your search.
            </div>

        @endif

        <div class="jobs-pagination">
            <ul class="pager">
              @if($paginator->currentPage()>1)
                <li><a href="{{ url('actuary-jobs/'.((int)$paginator->currentPage()-1)) }}" rel="prev">&laquo;</a></li>
              @endif

              @for ($i = 1; $i <= $paginator->lastPage(); $i++)
                @if($i === $paginator->currentPage())
                  <li class="active"><span>{{ $i }}</span></li>
                @else
                <li><a href="{{ url('actuary-jobs/'.$i) }}">{{ $i }}</a></li>
                @endif
              @endfor

              @if($paginator->hasMorePages())
                <li><a href="{{ url('actuary-jobs/'.((int)$paginator->currentPage()+1)) }}" rel="next">&raquo;</a></li>
              @endif
          </ul>
        </div><!-- /.jobs-pagination -->
      </div><!-- /.job-list-vacancies -->

    </div><!-- /.job-list-container-inner -->
  </div><!-- /.job-list-container -->

  @include("partials.join-discussion", [
    "advert" => isset($page_adverts[0]["discussion-widget"]) ? $page_adverts[0]["discussion-widget"] : [],
    "category_id" => $page->discussion_category_id
  ])

@endsection

@push("scripts-after")
<script>
    
    $('document').ready(function(){
      $('#per_page').change(function(){
        window.location = '/jobs/vacancies-per-page/'+$(this).val();
      })
    });

</script>
@endpush