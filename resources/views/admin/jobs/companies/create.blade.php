@extends('adminlte::page')

@section('content_header')
    <h1>Create Company / Recruiter</h1>
@endsection

@section('content')

<div class="box box-primary">
    <form action="{{ route('job-companies.store') }}" method="POST" role="form" enctype="multipart/form-data">
        <div class="box-body">
            {{ csrf_field() }}
            {{ method_field("POST") }}

            <div class="form-group">
              <label for="name">Business Name</label>
              @if($errors->has("name"))
                <p class="text-danger">{{ $errors->first("name") }}</p>
              @endif
              <input type="text" class="form-control" name="name" id="name" value="{{ old("name") }}" placeholder="Enter company / recruiters name...">
            </div>

            <div class="form-group">
              <label for="name">Company Type</label>
              @if($errors->has("type"))
                <p class="text-danger">{{ $errors->first("type") }}</p>
              @endif
              <select name="type" class="form-control">
                  <option value="">Please select...</option>
                  <option value="agency">Agency</option>
                  <option value="direct">Direct Employer</option>
              </select>
            </div>

            <div class="form-group">
              <label for="name">Company Information / Description</label>
              @if($errors->has("description"))
                <p class="text-danger">{{ $errors->first("description") }}</p>
              @endif
              <textarea class="form-control editor" name="description" id="description">{{ old("description") }}</textarea>
            </div>

            <div class="form-group">
              <label for="logo_path">Company Logo</label>
              @if($errors->has("logo_path"))
                <p class="text-danger">{{ $errors->first("logo_path") }}</p>
              @endif
              <input type="file" class="form-control" name="logo_path" id="logo_path">
            </div>

        </div>
        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Create</button>
        </div>
    </form>
</div>

@endsection
