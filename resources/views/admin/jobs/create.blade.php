@extends('adminlte::page')

@section('content_header')
    <h1>Create Job</h1>
@endsection

@section('content')

<div class="box box-primary">
    <form action="{{ route('jobs.store') }}" method="POST" role="form">
        <div class="box-body">
            {{ csrf_field() }}
            {{ method_field("POST") }}

            <div class="form-group">
              <label for="title">Job Title</label>
              @if($errors->has("title"))
                <p class="text-danger">{{ $errors->first("title") }}</p>
              @endif
              <input type="text" class="form-control" name="title" id="title" value="{{ old("title") }}" placeholder="Job title...">
            </div>

            <div class="form-group">
              <label for="excerpt">Job Excerpt</label>
              @if($errors->has("excerpt"))
                <p class="text-danger">{{ $errors->first("excerpt") }}</p>
              @endif
              <input type="text" class="form-control" name="excerpt" id="excerpt" value="{{ old("excerpt") }}" placeholder="Enter job excerpt...">
            </div>

            <div class="form-group">
              <label for="content">Job Description / Information</label>
              @if($errors->has("content"))
                <p class="text-danger">{{ $errors->first("content") }}</p>
              @endif
              <textarea class="form-control editor" name="content" id="content">{{ old("content") }}</textarea>
            </div>

            <div class="form-group">
              <label for="salary_type">Job Type</label>
              <select name="salary_type" class="form-control">
                <option value="">Select job type...</option>
                  <option value="permanent" @if(old("salary_type") == "permanent") selected @endif>Permanent</option>
                  <option value="contract" @if(old("salary_type") == "contract") selected @endif>Contract</option>
              </select>
            </div>

            <div class="form-group">
              <label for="sector_id">Job Sector</label>
              <select name="sector_id" class="form-control">
                <option value="">Select job sector...</option>
                @foreach($sectors as $sector)
                  <option value="{{ $sector->id }}">{{ $sector->name }}</option>
                @endforeach
              </select>
            </div>

            <div class="form-group">
              <label for="experience">Experience</label>
              <select name="experience" class="form-control">
                  <option value="">Select experience...</option>
                  <option value="qualified">Qualified</option>
                  <option value="almost">Almost Qualified</option>
                  <option value="part">Part Qualified</option>
                  <option value="none">No exams</option>
              </select>
            </div>

            <div class="form-group">
              <label for="salary">Yearly Salary <span class="text-danger">(only applicable if a permanent job)</span></label>
              <input type="text" class="form-control" name="salary" id="salary" value="{{ old("salary") }}" placeholder="Enter salary. E.G. 25000">
            </div>

            <div class="form-group">
              <label for="daily_salary">Daily Salary <span class="text-danger">(only applicable if a contractor job)</span></label>
              <input type="text" class="form-control" name="daily_salary" id="daily_salary" value="{{ old("daily_salary") }}" placeholder="Enter daily salary. E.G. 500">
            </div>

            <div class="form-group">
              <label for="location_id">Job Location</label>
              @if($errors->has("location_id"))
                <p class="text-danger">{{ $errors->first("location_id") }}</p>
              @endif
              <select name="location_id" class="form-control">
                <option value="">Select location of job...</option>
                @foreach($locations as $location)
                  <option value="{{ $location->id }}" @if($location->id == old("location_id")) selected @endif>{{ $location->name }} - {{ $location->region->name }}</option>
                @endforeach
              </select>
            </div>

            <div class="form-group">
              <label for="company_id">Company / Recruiter</label>
              @if($errors->has("company_id"))
                <p class="text-danger">{{ $errors->first("company_id") }}</p>
              @endif
              <select name="company_id" class="form-control">
                <option value="">Select company or recruiter</option>
                @foreach($companies as $company)
                  <option value="{{ $company->id }}" @if($company->id == old("company_id")) selected @endif>{{ $company->name }}</option>
                @endforeach
              </select>
            </div>

            <div class="form-group">
              <label for="apply_link">Apply Link</label>
              @if($errors->has("apply_link"))
                <p class="text-danger">{{ $errors->first("apply_link") }}</p>
              @endif
              <input type="text" class="form-control" name="apply_link" id="apply_link" value="{{ old("apply_link") }}" placeholder="Enter apply link...">
            </div>

            <div class="form-group">
              <label for="featured">Featured job?</label>
              <select name="featured" id="featured" class="form-control">
                <option value="">Is this a featured job?</option>
                <option value="1" @if(old("featured")) selected @endif>Yes</option>
                <option value="0" @if(!old("featured")) selected @endif>No</option>
              </select>
            </div>

        </div>
        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Create Job</button>
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
