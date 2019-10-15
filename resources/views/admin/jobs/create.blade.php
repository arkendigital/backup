@extends('adminlte::page')

@section('content_header')

    <h1>Create Job</h1>

    @if($errors->any())
        <p class="has-error">
            <br><label class="control-label" for="title"><i class="fa fa-times-circle-o"></i> There are some issues with this Job listing, please see fields marked in red</label>
        </p>
    @endif

@endsection

@section('content')

<form action="{{ route('jobs.store') }}" method="POST" role="form" enctype="multipart/form-data">

    {{ csrf_field() }}
    {{ method_field("POST") }}

    <div class="row">
        <div class="col-md-12">

            <div class="box box-primary">

                <div class="box-header with-border">
                    <h3 class="box-title">Main Job Information</h3>
                </div>

                <div class="box-body">

                    <div class="form-group @if($errors->has("title")) has-error @endif">
                      @if($errors->has("title"))
                          <label class="control-label" for="title"><i class="fa fa-times-circle-o"></i> {{ $errors->first("title") }}</label>
                      @else
                          <label for="title">Job Title</label>
                      @endif

                      <input type="text" class="form-control" name="title" id="title" value="{{ old("title") }}" placeholder="Job title...">
                    </div>

                    <div class="form-group @if($errors->has("excerpt")) has-error @endif">
                        @if($errors->has("excerpt"))
                            <label class="control-label" for="excerpt"><i class="fa fa-times-circle-o"></i> {{ $errors->first("excerpt") }}</label>
                        @else
                            <label for="excerpt">Short description about this job</label>
                        @endif
                      <input type="text" class="form-control" name="excerpt" id="excerpt" value="{{ old("excerpt") }}" placeholder="Enter a short description...">
                    </div>

                    <div class="form-group @if($errors->has("contact_email")) has-error @endif">
                        @if($errors->has("contact_email"))
                            <label class="control-label" for="contact_email"><i class="fa fa-times-circle-o"></i> {{ $errors->first("contact_email") }}</label>
                        @else
                            <label for="contact_email">Contact Email</label>
                        @endif
                        <input type="text" class="form-control" name="contact_email" id="contact_email" value="{{ old("contact_email") }}" placeholder="Enter a contact email">
                    </div>

                    <div class="form-group @if($errors->has("content")) has-error @endif">
                        @if($errors->has("content"))
                            <label class="control-label" for="content"><i class="fa fa-times-circle-o"></i> {{ $errors->first("content") }}</label>
                        @else
                            <label for="content">Description / Information</label>
                        @endif
                      <textarea class="form-control editor" name="content" id="content">{{ old("content") }}</textarea>
                    </div>

                </div>

            </div>

        </div>
    </div>

    <div class="row">
        <div class="col-md-6">

            <div class="box box-primary">

                <div class="box-header with-border">
                    <h3 class="box-title">Other Information</h3>
                </div>

                <div class="box-body">

                    <div class="form-group @if($errors->has("status_id")) has-error @endif">
                        @if($errors->has("status_id"))
                            <label class="control-label" for="status_id"><i class="fa fa-times-circle-o"></i> {{ $errors->first("status_id") }}</label>
                        @else
                            <label for="status_id">Job Type</label>
                        @endif
                      <select name="status_id" class="form-control">
                        <option value="">Select job type...</option>
                        @foreach($types as $type)
                          <option value="{{ $type->id }}" @if(old("status_id") == $type->id) selected @endif>{{ $type->name }}</option>
                        @endforeach
                      </select>
                    </div>

                    <div class="form-group @if($errors->has("sectors")) has-error @endif">
                        @if($errors->has("sectors"))
                            <label class="control-label" for="sector_id"><i class="fa fa-times-circle-o"></i> {{ $errors->first("sectors") }}</label>
                        @else
                            <label for="sector_id">Job Sector</label>
                        @endif

                        @foreach($sectors as $sector)
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" value="{{ $sector->id }}" name="sectors[]"
                                        @if(in_array($sector->id, (array) old("sectors")))
                                            checked="checked"
                                        @endif
                                    > {{ $sector->name }}
                                </label>
                            </div>
                        @endforeach

                    </div>

                    <div class="form-group @if($errors->has("experience")) has-error @endif">
                        @if($errors->has("experience"))
                            <label class="control-label" for="experience"><i class="fa fa-times-circle-o"></i> {{ $errors->first("experience") }}</label>
                        @else
                            <label for="experience">Experience needed</label>
                        @endif
                        <br>
                        @foreach ($experienceNeeded as $experienceNeeded)
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" value="{{ $experienceNeeded }}" name="experience[]"> {{ $experienceNeeded }}
                                </label>
                            </div>
                        @endforeach
                    </div>

                    <div class="form-group @if($errors->has("location_id")) has-error @endif">
                        @if($errors->has("location_id"))
                            <label class="control-label" for="location_id"><i class="fa fa-times-circle-o"></i> {{ $errors->first("location_id") }}</label>
                        @else
                            <label for="location_id">Job Location</label>
                        @endif
                      <select name="location_id" class="form-control">
                        <option value="">Select location of job...</option>
                        @foreach($locations as $location)
                          <option value="{{ $location->id }}" @if($location->id == old("location_id")) selected @endif>{{ $location->name }} - {{ $location->region->name }}</option>
                        @endforeach
                      </select>
                    </div>

                    <div class="form-group @if($errors->has("town")) has-error @endif">
                        @if($errors->has("town"))
                            <label class="control-label" for="town">{{ $errors->first("town") }}</label>
                        @else
                            <label for="town">Job Town</label>
                        @endif

                        <div class="input-group">
                            <input type="text" class="form-control" name="town" id="town" value="{{ old("town") }}"  placeholder="job town">
                        </div>
                    </div>

                </div>

            </div>

        </div>

        <div class="col-md-6">

            <div class="box box-primary">

                <div class="box-header with-border">
                    <h3 class="box-title">Salary Information</h3>
                </div>

                <div class="box-body">

                    <p class="text-info">If you don't want your job to have a salary bracket, simply enter the min and max salary as the same value.</p>

                    <div class="form-group @if($errors->has("min_salary")) has-error @endif">
                        @if($errors->has("min_salary"))
                            <label class="control-label" for="min_salary"><i class="fa fa-times-circle-o"></i> {{ $errors->first("min_salary") }}</label>
                        @else
                            <label for="min_salary">Minimum Yearly Salary</label>
                        @endif

                        <div class="input-group">
                            <span class="input-group-addon">&pound;</span>
                            <input type="text" class="form-control" name="min_salary" id="min_salary" value="{{ old("min_salary") }}" placeholder="25000">
                        </div>
                    </div>

                    <div class="form-group @if($errors->has("max_salary")) has-error @endif">
                        @if($errors->has("max_salary"))
                            <label class="control-label" for="max_salary"><i class="fa fa-times-circle-o"></i> {{ $errors->first("max_salary") }}</label>
                        @else
                            <label for="max_salary">Maximum Yearly Salary</label>
                        @endif

                        <div class="input-group">
                            <span class="input-group-addon">&pound;</span>
                            <input type="text" class="form-control" name="max_salary" id="max_salary" value="{{ old("max_salary") }}" placeholder="75000">
                        </div>
                    </div>

                    <hr>

                    <div class="form-group @if($errors->has("min_daily_salary")) has-error @endif">
                    	@if($errors->has("min_daily_salary"))
                    		<label class="control-label" for="min_daily_salary"><i class="fa fa-times-circle-o"></i> {{ $errors->first("min_daily_salary") }}</label>
                    	@else
                    		<label for="min_daily_salary">Minimum Daily Salary</label>
                    	@endif

                    	<div class="input-group">
                    		<span class="input-group-addon">&pound;</span>
                    		<input type="text" class="form-control" name="min_daily_salary" id="min_daily_salary" value="{{ old("min_daily_salary") }}" placeholder="75">
                    	</div>
                    </div>

                    <div class="form-group @if($errors->has("max_daily_salary")) has-error @endif">
                    	@if($errors->has("max_daily_salary"))
                    		<label class="control-label" for="max_daily_salary"><i class="fa fa-times-circle-o"></i> {{ $errors->first("max_daily_salary") }}</label>
                    	@else
                    		<label for="max_daily_salary">Maximum Daily Salary</label>
                    	@endif

                    	<div class="input-group">
                    		<span class="input-group-addon">&pound;</span>
                    		<input type="text" class="form-control" name="max_daily_salary" id="max_daily_salary" value="{{ old("max_daily_salary") }}" placeholder="900">
                    	</div>
                    </div>

                </div>

            </div>

            <div class="box box-primary">

                <div class="box-header with-border">
                    <h3 class="box-title">Application Link</h3>
                </div>

                <div class="box-body">

                    <div class="form-group @if($errors->has("apply_link")) has-error @endif">
                        @if($errors->has("apply_link"))
                            <label class="control-label" for="apply_link"><i class="fa fa-times-circle-o"></i> {{ $errors->first("apply_link") }}</label>
                        @else
                            <label for="apply_link">Apply Link</label>
                        @endif
                      <input type="text" class="form-control" name="apply_link" id="apply_link" value="{{ old("apply_link") }}" placeholder="Enter apply link...">
                    </div>

                </div>

            </div>

        </div>
    </div>

    <div class="row">
        <div class="col-md-6">

            <div class="box box-primary">

                <div class="box-header with-border">
                    <h3 class="box-title">Recruiter / Company</h3>
                </div>

                <div class="box-body">

                    <div class="form-group @if($errors->has("company_id")) has-error @endif">
                        @if($errors->has("company_id"))
                            <label class="control-label" for="company_id"><i class="fa fa-times-circle-o"></i> {{ $errors->first("company_id") }}</label>
                        @else
                            <label for="company_id">Company / Recruiter</label>
                        @endif
                      <select name="company_id" class="form-control">
                        <option value="">Select company or recruiter</option>
                        @foreach($companies as $company)
                          <option value="{{ $company->id }}" @if($company->id == old("company_id")) selected @endif>{{ $company->name }}</option>
                        @endforeach
                      </select>
                    </div>

                </div>

            </div>

        </div>

        <div class="col-md-6">

            <div class="box box-primary">

                <div class="box-header with-border">
                    <h3 class="box-title">Featured Job</h3>
                </div>

                <div class="box-body">

                    <div class="form-group">
                      <label for="featured">Featured job?</label>
                      <select name="featured" id="featured" class="form-control">
                        <option value="">Is this a featured job?</option>
                        <option value="1" @if(old("featured")) selected @endif>Yes</option>
                        <option value="0" @if(!old("featured")) selected @endif>No</option>
                      </select>
                    </div>

                </div>

            </div>

        </div>
    </div>

    <div class="row">
        <div class="col-md-6">

            <div class="box box-primary">

                <div class="box-header with-border">
                    <h3 class="box-title">Price and Timescale</h3>
                </div>

                <div class="box-body">

                    <div class="form-group">
                        <label for="start_date">Start date</label>
                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" class="form-control pull-right datepicker" name="start_date" autocomplete="off" placeholder="Click to select date" value="{{ old("start_date") }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="end_date">End date</label>
                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" class="form-control pull-right datepicker" name="end_date" autocomplete="off" placeholder="Click to select date" value="{{ old("end_date") }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="end_date">Price</label>
                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-gbp"></i>
                            </div>
                            <input type="text" class="form-control pull-right" name="price" autocomplete="off" placeholder="250" value="{{ old("price") }}">
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </div>

    <div class="box-footer">
        {{-- <a href="/ops/jobs" class="btn btn-primary pull-left">All Jobs</a> --}}
        <button type="submit" class="btn btn-success pull-left">Create Job</button>
    </div>

</form>

@push("scripts-after")

  <script src="https://cdnjs.cloudflare.com/ajax/libs/datepicker/0.6.5/datepicker.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datepicker/0.6.5/datepicker.min.css">
  <script>
  $(function() {
    $(".datepicker").datepicker({
      format: "dd-mm-yyyy",
      startDate: "{{ date("d-m-Y") }}"
    });
  });
  </script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.9.4/trumbowyg.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.9.4/ui/trumbowyg.min.css">
  <script>
    $('.editor').trumbowyg({
      svgPath: '/images/icons.svg',
    });
  </script>
@endpush

@endsection
