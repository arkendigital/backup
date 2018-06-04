<div class="job-list-item @if(isset($featured) && $featured) job-list-item-featured @endif">

	@if($job->company->logo_path != "")
		<img src="{{ $job->company->logo }}" class="job-list-item-logo" alt="{{ $job->company->name }}">
	@endif

	<div class="job-list-item-content">

		<a href="/jobs/vacancies/{{ $job->slug }}"><p class="job-list-item-title">
			{{ $job->title }}
		</p></a>

		<p class="job-list-item-text">{{ $job->excerpt }}</p>

		<div class="job-list-item-list">
			<span class="job-list-item-list-key">Job Type</span>
			<span class="job-list-item-list-value">{{ ucwords($job->salary_type) }}</span>
		</div>

		@if($job->salary_type == "permanent")
			<div class="job-list-item-list">
				<span class="job-list-item-list-key">Annual Salary</span>
				<span class="job-list-item-list-value">&pound;{{ number_format($job->salary) }}</span>
			</div>
		@else
			<div class="job-list-item-list">
				<span class="job-list-item-list-key">Daily Salary</span>
				<span class="job-list-item-list-value">&pound;{{ number_format($job->daily_salary) }}</span>
			</div>
		@endif

		@isset($job->location)
			<div class="job-list-item-list">
				<span class="job-list-item-list-key">Location</span>
				<span class="job-list-item-list-value">{{ $job->location->name }}</span>
			</div>
		@endisset

		@isset($job->sector)
			<div class="job-list-item-list">
				<span class="job-list-item-list-key">Sector</span>
				<span class="job-list-item-list-value">{{ $job->sector->name }}</span>
			</div>
		@endisset

		<div class="job-list-item-list">
			<span class="job-list-item-list-key">Date Posted</span>
			<span class="job-list-item-list-value">{{ date("d-m-Y", strtotime($job->created_at)) }}</span>
		</div>
	</div><!-- /.job-list-item-content -->

	<a class="job-list-item-button" href="/jobs/vacancies/{{ $job->slug }}">View</a>
</div><!-- /.job-list-item -->
