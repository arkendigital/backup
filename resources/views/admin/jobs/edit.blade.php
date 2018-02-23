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
              <label for="salary">Yearly Salary</label>
              <input type="text" class="form-control" name="salary" id="salary" value="{{ $job->salary }}" placeholder="Enter salary. E.G. 25000">
            </div>

            <div class="form-group">
              <label for="location_id">Job Location</label>
              <select name="location_id" class="form-control">
                <option value="">Select location of job...</option>
                @foreach($locations as $location)
                  <option value="{{ $location->id }}" @if($location->id == $job->location_id) selected @endif>{{ $location->name }}</option>
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
