@extends('adminlte::page')

@section('content_header')
    <h1>Creating a new slide in "{{ isset($_GET["slug"]) ? $_GET["slug"] : "new" }}"</h1>
@endsection

@section('content')

<form action="{{ route('slides.store') }}" method="POST" role="form" enctype="multipart/form-data">
  {{ csrf_field() }}

  <input type="hidden" name="slug" value="{{ isset($_GET["slug"]) ? $_GET["slug"] : "" }}">

  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Slide Information</h3>
    </div>
    <div class="box-body">

      <div class="form-group">
        <label for="title">Title</label>
        <input type="text" class="form-control" name="title" id="title" placeholder="Enter a title for the slide...">
      </div>

      <div class="form-group">
        <label for="text">Text</label>
        <input type="text" class="form-control" name="text" id="text" placeholder="Enter some text...">
      </div>

      <div class="form-group">
        <label for="image">Add an image</label>
        <input type="file" class="form-control" name="image" id="image">
      </div>

    </div>
  </div>

  <div class="box-footer">
      <button type="submit" class="btn btn-primary">Create Slide</button>
  </div>

</form>

@endsection
