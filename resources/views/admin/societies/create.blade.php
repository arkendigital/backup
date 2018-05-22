@extends('adminlte::page')

@section('content_header')
    <h1>Create Society</h1>
@endsection

@section('content')

<div class="box box-primary">
    <form action="{{ route('societies.store') }}" method="POST" role="form" enctype="multipart/form-data">
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
              <label for="name">Email</label>
              @if($errors->has("email"))
                <p class="text-danger">{{ $errors->first("email") }}</p>
              @endif
              <input type="text" class="form-control" name="email" id="email" value="{{ old("email") }}" placeholder="Enter email...">
            </div>

            <div class="form-group">
              <label for="name">Apply Link <sup class="text-danger">* (mandatory)</sup></label>
              @if($errors->has("link"))
                <p class="text-danger">{{ $errors->first("link") }}</p>
              @endif
              <input type="text" class="form-control" name="link" id="link" value="{{ old("link") }}" placeholder="Enter apply link...">
            </div>

            <div class="form-group">
              <label for="name">Postcode <sup class="text-danger">* (mandatory)</sup></label>
              @if($errors->has("postcode"))
                <p class="text-danger">{{ $errors->first("postcode") }}</p>
              @endif
              <input type="text" class="form-control" name="postcode" id="postcode" value="{{ old("postcode") }}" placeholder="Enter postcode...">
            </div>

            <div class="form-group">
              <label for="description">Description <sup class="text-danger">* (mandatory)</sup></label>
              @if($errors->has("description"))
                <p class="text-danger">{{ $errors->first("description") }}</p>
              @endif
              <textarea class="form-control editor" name="description" id="description">{{ old("description") }}</textarea>
            </div>

            <div class="form-group">
              <label for="logo">Image <sup class="text-danger">* (mandatory)</sup></label>
              @if($errors->has("image"))
                <p class="text-danger">{{ $errors->first("image") }}</p>
              @endif
              <input type="file" class="form-control" name="image" id="image">
            </div>

            <div class="form-group">
              <label for="logo">Society Logo <sup class="text-danger">* (mandatory)</sup></label>
              @if($errors->has("logo"))
                <p class="text-danger">{{ $errors->first("logo") }}</p>
              @endif
              <input type="file" class="form-control" name="logo" id="logo">
            </div>

        </div>
        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Create</button>
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
