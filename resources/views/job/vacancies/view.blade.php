@extends("layouts.master")

@section("head_scripts")
<!-- Event snippet for Apply Clicks conversion page In your html page, add the snippet and call gtag_report_conversion when someone clicks on the chosen link or button. --> 
<script> function gtag_report_conversion(url) { var callback = function () { if (typeof(url) != 'undefined') { window.location = url; } }; gtag('event', 'conversion', { 'send_to': 'AW-719018787/Z5WwCNbxi9IBEKO27dYC', 'event_callback': callback }); return false; } 
</script>
<script id="mcjs">!function(c,h,i,m,p){m=c.createElement(h),p=c.getElementsByTagName(h)[0],m.async=1,m.src=i,p.parentNode.insertBefore(m,p)}(document,"script","https://chimpstatic.com/mcjs-connected/js/users/51760736ffa0ca0ab15a0abbe/bf204fb69eade3dc3e6588cc4.js");</script>
<script type="application/ld+json">
    {
      "@context" : "https://schema.org/",
      "@type" : "JobPosting",
      "title" : "{{ $job->title }}",
      "description" : "{!! $job->company->description !!}",
      "datePosted" : "{{ $job->start_date }}",
      "validThrough" : "{{ $job->end_date }}",
      "employmentType" : "FULL_TIME",
      "hiringOrganization" : {
        "@type" : "Organization",
        "name" : "{{ $job->company->name }}",
        "logo" : "{{ url('/').$job->company->logo }}"
      },
      "jobLocation": {
      "@type": "Place",
        "address": {
        "@type": "PostalAddress",
        "addressRegion": "{{ str_replace("--", "", $job->location->name) }}",
        "addressCountry": "GB"
        }
      },
     "baseSalary": {
        "@type": "MonetaryAmount",
        "currency": "GBP",
        "value": {
          "@type": "QuantitativeValue",
          "value": {{ ($job->status_id == 1 || $job->status_id == 4) ? number_format($job->max_salary) : number_format($job->max_daily_salary) }},
          "unitText": "{{ ($job->status_id == 1 || $job->status_id == 4) ? 'YEAR' : 'DAY' }}"
        }
      }
    }
    </script>
@endsection

@section("content")
    @if ($job->image)
      <div class="box profile__header"
          style='background-image: url("{{asset('storage/' . $job->image)}}"); min-height: 300px; background-size: cover;'>
      </div>
    @endif
  <div class="website-container">
    

      <div class="job-view-header">
        <div class="job-view-header-left">
          <h1 class="job-view-header-title">Jobs</h1>
          <h2 class="job-view-header-job-title">{{ $job->title }}</h2>
        </div>

        <div class="job-view-header-right">

          @if($job->status_id == 1 || $job->status_id == 4)
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
        <p><a class="job-view-content-button job-view-content-button-apply track-btn" data-type="contact" href="mailto:{{ $job->contact_email }}">Contact</a></p>
        @endif
        @if($job->apply_link)
        <p><a class="job-view-content-button job-view-content-button-apply track-btn" data-type="apply" target="_blank" rel="nofollow" href="{{ $job->apply_link }}" style="margin-top: 10px;">Apply</a></p>
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

@push("scripts-after")
<script>
    function detec() {
        if (navigator.userAgent.match(/Android/i) 
            || navigator.userAgent.match(/webOS/i) 
            || navigator.userAgent.match(/iPhone/i)  
            || navigator.userAgent.match(/iPad/i)  
            || navigator.userAgent.match(/iPod/i) 
            || navigator.userAgent.match(/BlackBerry/i) 
            || navigator.userAgent.match(/Windows Phone/i)) { 
            return true; 
        } else { 
            return false; 
        }
    } 
    $('document').ready(function(){
      var jobID = "<?php echo $job->id ?>";
      $('.track-btn').click(function(e){
        e.preventDefault();
        var trackType = $(this).data('type');
        var redirectLink = $(this).attr("href");
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
        $.ajax('/actuary-jobs/'+jobID+'/track', {
            type: 'POST',
            data: { "trackType": trackType },
            success: function (data, status, xhr) {
                if(trackType=='apply'){
                  //trigger conversion
                  gtag_report_conversion(window.location.href);
                  if(detec()){
                    var win = window.open(redirectLink, '_self');
                  }else{
                    var win = window.open(redirectLink, '_blank');
                  }
                  win.focus();
                }else{
                  window.location.href = redirectLink;
                }
            },
            error: function (jqXhr, textStatus, errorMessage) {
              console.error(jqXhr, textStatus, errorMessage);
            }
        });
      })
    });

</script>
@endpush
