@extends('adminlte::page')

@section('content_header')
    <h1>Edit Job &mdash; {{ $job->title }}</h1>
@endsection

@section('content')

<div class="box box-primary">
    <form action="{{ route('jobs.update', $job) }}" method="POST" role="form" enctype="multipart/form-data">
        <div class="box-body">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}

            <div class="form-group">
              <label for="title">Job Title</label>
              <input type="text" class="form-control" name="title" id="title" value="{{ $job->title }}" placeholder="Job title...">
            </div>

            <div class="form-group">
              <label for="excerpt">Job Excerpt</label>
              <input type="text" class="form-control" name="excerpt" id="excerpt" value="{{ $job->excerpt }}" placeholder="Enter job excerpt...">
            </div>

            <div class="form-group">
              <label for="content">Job Description / Information</label>
              <textarea class="form-control editor" name="content" id="content">{{ $job->content }}</textarea>
            </div>

            <div class="form-group">
              <label for="status_id">Job Type</label>
              <select name="status_id" class="form-control">
                <option value="">Select job type...</option>
                @foreach($types as $type)
                  <option value="{{ $type->id }}" @if($job->status_id == $type->id) selected @endif>{{ $type->name }}</option>
                @endforeach
              </select>
            </div>

            <div class="form-group">
              <label for="sector_id">Job Sector</label>
              <select name="sector_id" class="form-control">
                <option value="">Select job sector...</option>
                @foreach($sectors as $sector)
                  <option value="{{ $sector->id }}" @if($job->sector_id == $sector->id) selected @endif>{{ $sector->name }}</option>
                @endforeach
              </select>
            </div>

            <div class="form-group">
              <label for="experience">Experience</label>
              <select name="experience" class="form-control">
                  <option value="">Select experience...</option>
                  <option value="qualified" @if($job->experience == "qualified") selected @endif>Qualified</option>
                  <option value="almost" @if($job->experience == "almost") selected @endif>Almost Qualified</option>
                  <option value="part" @if($job->experience == "part") selected @endif>Part Qualified</option>
                  <option value="none" @if($job->experience == "none") selected @endif>No exams</option>
              </select>
            </div>

            <div class="form-group">
              <label for="salary">Yearly Salary <span class="text-danger">(only applicable if a permanent job)</span></label>
              <input type="text" class="form-control" name="salary" id="salary" value="{{ $job->salary }}" placeholder="Enter salary. E.G. 25000">
            </div>

            <div class="form-group">
              <label for="daily_salary">Daily Salary <span class="text-danger">(only applicable if a contractor job)</span></label>
              <input type="text" class="form-control" name="daily_salary" id="daily_salary" value="{{ $job->daily_salary }}" placeholder="Enter daily salary. E.G. 500">
            </div>

            <div class="form-group">
              <label for="location_id">Job Location</label>
              <select name="location_id" class="form-control">
                <option value="">Select location of job...</option>
                @foreach($locations as $location)
                  <option value="{{ $location->id }}" @if($location->id == $job->location_id) selected @endif>{{ $location->name }} - {{ $location->region->name }}</option>
                @endforeach
              </select>
            </div>

            <div class="form-group">
              <label for="company_id">Company / Recruiter</label>
              <select name="company_id" class="form-control">
                <option value="">Select company or recruiter</option>
                @foreach($companies as $company)
                  <option value="{{ $company->id }}" @if($company->id == $job->company_id) selected @endif>{{ $company->name }}</option>
                @endforeach
              </select>
            </div>

            <div class="form-group">
              <label for="apply_link">Apply Link</label>
              <input type="text" class="form-control" name="apply_link" id="apply_link" value="{{ $job->apply_link }}" placeholder="Enter apply link...">
            </div>

            <div class="form-group">
              <label for="featured">Featured job?</label>
              <select name="featured" id="featured" class="form-control">
                <option value="">Is this a featured job?</option>
                <option value="1" @if($job->featured) selected @endif>Yes</option>
                <option value="0" @if(!$job->featured) selected @endif>No</option>
              </select>
            </div>

        </div>
        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Update Job</button>
        </div>
    </form>
</div>

@push("scripts-after")
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.9.4/trumbowyg.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.9.4/ui/trumbowyg.min.css">
  <script>
    $('.editor').trumbowyg({
      svgPath: '/images/icons.svg',
    });
  </script>
@endpush

@endsection
