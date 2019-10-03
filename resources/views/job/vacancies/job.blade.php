<div class="job-list-item @if(isset($featured) && $featured) job-list-item-featured @endif">

	@if($job->company->logo_path != "")
		<img src="{{ $job->company->logo }}" class="job-list-item-logo" alt="{{ $job->company->name }}">
	@endif

	<div class="job-list-item-content">

		<a href="{{ $job->tracking_url }}"><p class="job-list-item-title">
			{{ $job->title }}
		</p></a>

		<p class="job-list-item-text">{{ $job->excerpt }}</p>

		<div class="job-list-item-list">
			<span class="job-list-item-list-key">Job Type</span>
			<span class="job-list-item-list-value">{{ ucwords($job->status->name) }}</span>
		</div>

		@if($job->status_id == 1 && $job->min_salary>0 && $job->max_salary>0)
			<div class="job-list-item-list">
				<span class="job-list-item-list-key">Annual Salary</span>
				<span class="job-list-item-list-value">
					@if($job->min_salary == $job->max_salary)
						&pound;{{ number_format($job->max_salary) }}
					@else
						&pound;{{ number_format($job->min_salary) }} - &pound;{{ number_format($job->max_salary) }}
					@endif
				</span>
			</div>
		@elseif($job->status_id == 2)
			<div class="job-list-item-list">
				<span class="job-list-item-list-key">Daily Salary</span>
				<span class="job-list-item-list-value">
					@if($job->min_daily_salary == $job->max_daily_salary)
						&pound;{{ number_format($job->max_daily_salary) }}
					@else
						&pound;{{ number_format($job->min_daily_salary) }} - &pound;{{ number_format($job->max_daily_salary) }}
					@endif
				</span>
			</div>
		@endif

		@isset($job->location)
			<div class="job-list-item-list">
				<span class="job-list-item-list-key">Location</span>
				<span class="job-list-item-list-value">{{ str_replace("--", "", $job->location->name) }}</span>
			</div>
		@endisset

		@if($job->readable_sectors != "")
			<div class="job-list-item-list">
				<span class="job-list-item-list-key">Sector</span>
				<span class="job-list-item-list-value">{{ $job->readable_sectors }}</span>
			</div>
		@endif

		<div class="job-list-item-list">
			<span class="job-list-item-list-key">Posted</span>
			<span class="job-list-item-list-value">{{ $job->created_at->diffForHumans() }}</span>
		</div>
	</div><!-- /.job-list-item-content -->

	<a class="job-list-item-button" href="{{ $job->tracking_url }}">View</a>
</div><!-- /.job-list-item -->
