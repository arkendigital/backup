@extends('adminlte::page')

@section('content_header')
    <h1>Create Employer</h1>
@endsection

@section('content')

<div class="box box-primary">
    <form action="{{ route('employers.store') }}" method="POST" role="form" enctype="multipart/form-data">
        <div class="box-body">
            {{ csrf_field() }}
            {{ method_field("POST") }}

            <div class="form-group">
              <label for="name">Name <sup class="text-danger">* (mandatory)</sup></label>
              @if($errors->has("name"))
                <p class="text-danger">{{ $errors->first("name") }}</p>
              @endif
              <input type="text" class="form-control" name="name" id="name" value="{{ old("name") }}" placeholder="Enter name...">
            </div>

            <div class="form-group">
              <label for="name">Link <sup class="text-danger">* (mandatory)</sup></label>
              @if($errors->has("link"))
                <p class="text-danger">{{ $errors->first("link") }}</p>
              @endif
              <input type="text" class="form-control" name="link" id="link" value="{{ old("link") }}" placeholder="Enter link...">
            </div>

            <div class="form-group">
              <label for="name">Icon / Crest <sup class="text-danger">* (mandatory)</sup></label>
              @if($errors->has("icon"))
                <p class="text-danger">{{ $errors->first("icon") }}</p>
              @endif
              <input type="file" class="form-control" name="icon" id="icon">
            </div>

        </div>
        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Create</button>
        </div>
    </form>
</div>

@endsection
