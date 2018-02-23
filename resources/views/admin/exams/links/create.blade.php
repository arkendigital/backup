@extends('adminlte::page')

@section('content_header')
    <h1>Create New Useful Exam Link</h1>
@endsection

@section('content')

<div class="box box-primary">
    <form action="{{ route('exam-links.store') }}" method="POST" role="form">
        <div class="box-body">
            {{ csrf_field() }}
            {{ method_field("POST") }}

            <div class="form-group">
              <label for="name">Link Name</label>
              @if($errors->has("name"))
                <p class="text-danger">{{ $errors->first("name") }}</p>
              @endif
              <input type="text" class="form-control" name="name" id="name" value="{{ old("name") }}" placeholder="Enter link name...">
            </div>

            <div class="form-group">
              <label for="excerpt">Link URL</label>
              @if($errors->has("link"))
                <p class="text-danger">{{ $errors->first("link") }}</p>
              @endif
              <input type="text" class="form-control" name="link" id="link" value="{{ old("link") }}" placeholder="Enter URL...">
            </div>

            <div class="form-group">
              <label for="excerpt">Is this an official or unofficial link</label>
              @if($errors->has("official"))
                <p class="text-danger">{{ $errors->first("official") }}</p>
              @endif
              <select name="official" class="form-control">
                <option value="">Please select...</option>
                <option value="1">Official</option>
                <option value="0">Unofficial</option>
              </select>
            </div>

        </div>
        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Create Link</button>
        </div>
    </form>
</div>

@endsection
