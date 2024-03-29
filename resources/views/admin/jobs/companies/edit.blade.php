@extends('adminlte::page')

@section('content_header')
    <h1>Company / Recruiter - {{ $company->name }}</h1>
@endsection

@section('content')

<div class="box box-primary">
    <form action="{{ route('job-companies.update', compact("company")) }}" method="POST" role="form" enctype="multipart/form-data">
        <div class="box-body">
            {{ csrf_field() }}
            {{ method_field("PATCH") }}

            <div class="form-group">
              <label for="name">Business Name</label>
              @if($errors->has("name"))
                <p class="text-danger">{{ $errors->first("name") }}</p>
              @endif
              <input type="text" class="form-control" name="name" id="name" value="{{ $company->name }}" placeholder="Enter company / recruiters name...">
            </div>

            <div class="form-group">
              <label for="name">Company Type</label>
              @if($errors->has("type"))
                <p class="text-danger">{{ $errors->first("type") }}</p>
              @endif
              <select name="type" class="form-control">
                  <option value="">Please select...</option>
                  <option value="agency" @if($company->type == "agency") selected @endif>Agency</option>
                  <option value="direct" @if($company->type == "direct") selected @endif>Direct Employer</option>
              </select>
            </div>

            <div class="form-group">
              <label for="name">Company Information / Description</label>
              @if($errors->has("description"))
                <p class="text-danger">{{ $errors->first("description") }}</p>
              @endif
              <textarea class="form-control editor" name="description" id="description">{{ $company->description }}</textarea>
            </div>

            <div class="form-group">
              <label for="logo_path">Company Logo</label>
              @if($errors->has("logo_path"))
                <p class="text-danger">{{ $errors->first("logo_path") }}</p>
              @endif
              @if($company->logo_path != "")
                <p><img src="{{ $company->logo }}" height="125"></p>
              @endif
              <input type="file" class="form-control" name="logo_path" id="logo_path">
            </div>

        </div>
        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Update</button>
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
