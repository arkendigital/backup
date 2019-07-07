@extends('adminlte::page')

@section('content_header')
    <h1>Create New Support Block</h1>
@endsection

@section('content')

<form action="{{ route('support-blocks.store') }}" method="POST" role="form" enctype="multipart/form-data">
  {{ csrf_field() }}

  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Support Block Information</h3>
    </div>
    <div class="box-body">

      <div class="form-group">
        <label for="title">Title</label>
        <input type="text" class="form-control" name="title" id="title" placeholder="Enter a title for this support block...">
      </div>

      <div class="form-group">
        <label for="subtitle">Subtitle</label>
        <input type="text" class="form-control" name="subtitle" id="subtitle" placeholder="Enter a subtitle for this support block...">
      </div>

      <div class="form-group">
        <label for="image">Image</label>
        <input type="file" class="form-control" name="image" id="image">
      </div>

    </div>
  </div>

  <div class="box-footer">
      <button type="submit" class="btn btn-primary">Create</button>
  </div>

</form>

@endsection
