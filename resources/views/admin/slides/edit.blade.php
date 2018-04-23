@extends('adminlte::page')

@section('content_header')
    <h1>Editing slide in {{ ucwords($slide->slug) }}</h1>
@endsection

@section('content')

<form action="{{ route('slides.update', compact('slide')) }}" method="POST" role="form" enctype="multipart/form-data">
  {{ csrf_field() }}
  {{ method_field("PATCH") }}

  <input type="hidden" name="slug" value="{{ $slide->slug }}">

  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Slide Information</h3>
    </div>
    <div class="box-body">

      <div class="form-group">
        <label for="title">Title</label>
        <input type="text" class="form-control" name="title" id="title" placeholder="Enter a title for the slide..." value="{{ $slide->title }}">
      </div>

      <div class="form-group">
        <label for="text">Text</label>
        <input type="text" class="form-control" name="text" id="text" placeholder="Enter some text..." value="{{ $slide->text }}">
      </div>

      <div class="form-group">
        @if($slide->image_path != "")
          <p><img src="{{ $slide->image }}" alt="" title="" style="max-height: 100px;"></p>
        @endif
        <label for="image">Add an image</label>
        <input type="file" class="form-control" name="image" id="image">
      </div>

      <div class="form-group">
        <label for="link">Link</label>
        <input type="url" class="form-control" name="link" id="link" placeholder="Enter a link for the slide" value="{{ $slide->link }}">
      </div>

    </div>
  </div>

  <div class="box-footer">
      <button type="submit" class="btn btn-primary">Update Slide</button>
  </div>

</form>

<form action="{{ route("slides.destroy", compact("slide")) }}" method="POST">
  {{ csrf_field() }}
  {{ method_field("DELETE") }}

  <button class="btn btn-danger pull-right" style="margin-top:25px;">Delete Slide</button>
</form>

@endsection
