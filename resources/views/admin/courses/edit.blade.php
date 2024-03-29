@extends('adminlte::page')

@section('content_header')
    <h1>{{ $course->name }}</h1>
@endsection

@section('content')

<div class="box box-primary">
    <form action="{{ route('courses.update', compact('course')) }}" method="POST" role="form" enctype="multipart/form-data">
        <div class="box-body">
            {{ csrf_field() }}
            {{ method_field("PATCH") }}

            <div class="form-group">
              <label for="name">Name <sup class="text-danger">* (mandatory)</sup></label>
              @if($errors->has("name"))
                <p class="text-danger">{{ $errors->first("name") }}</p>
              @endif
              <input type="text" class="form-control" name="name" id="name" value="{{ $course->name }}" placeholder="Enter name...">
            </div>

            <div class="form-group">
                <label for="link">Link</label>
                @if($errors->has("link"))
                  <p class="text-danger">{{ $errors->first("link") }}</p>
                @endif
                <input type="text" class="form-control" name="link" id="link" value="{{ $course->link }}" placeholder="Enter link...">
              </div>

            <div class="form-group">
              <label for="description">Description <sup class="text-danger">* (mandatory)</sup></label>
              @if($errors->has("description"))
                <p class="text-danger">{{ $errors->first("description") }}</p>
              @endif
              <textarea class="form-control editor" name="description" id="description">{{ $course->description }}</textarea>
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
