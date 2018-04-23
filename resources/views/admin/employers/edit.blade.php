@extends('adminlte::page')

@section('content_header')
    <h1>{{ $employer->name }}</h1>
@endsection

@section('content')

<div class="box box-primary">
    <form action="{{ route('employers.update', compact('employer')) }}" method="POST" role="form" enctype="multipart/form-data">
        <div class="box-body">
            {{ csrf_field() }}
            {{ method_field("PATCH") }}

            <div class="form-group">
              <label for="name">Name <sup class="text-danger">* (mandatory)</sup></label>
              @if($errors->has("name"))
                <p class="text-danger">{{ $errors->first("name") }}</p>
              @endif
              <input type="text" class="form-control" name="name" id="name" value="{{ $employer->name }}" placeholder="Enter name...">
            </div>

            <div class="form-group">
              <label for="description">Description</label>
              @if($errors->has("description"))
                <p class="text-danger">{{ $errors->first("description") }}</p>
              @endif
              <textarea class="form-control editor" name="description" id="description">{{ $employer->description }}</textarea>
            </div>

            <div class="form-group">
              <label for="link">Link <sup class="text-danger">* (mandatory)</sup></label>
              @if($errors->has("link"))
                <p class="text-danger">{{ $errors->first("link") }}</p>
              @endif
              <input type="text" class="form-control" name="link" id="link" value="{{ $employer->link }}" placeholder="Enter link...">
            </div>

            <div class="form-group">
              <label for="email">Email</label>
              @if($errors->has("email"))
                <p class="text-danger">{{ $errors->first("email") }}</p>
              @endif
              <input type="text" class="form-control" name="email" id="email" value="{{ $employer->email }}" placeholder="Enter email...">
            </div>

            <div class="form-group">
              <label for="name">Icon / Crest</label>
              @if($employer->logo_path != "")
                <p><img src="{{ $employer->logo }}" alt="" title="" style="max-height: 100px;"></p>
              @endif
              @if($errors->has("icon"))
                <p class="text-danger">{{ $errors->first("icon") }}</p>
              @endif
              <input type="file" class="form-control" name="icon" id="icon">
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
