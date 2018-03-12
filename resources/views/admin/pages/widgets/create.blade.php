@extends('adminlte::page')

@section('content_header')
    <h1>Create New Page Widget</h1>
@endsection

@section('content')

<form action="{{ route('page-widgets.store') }}" method="POST" role="form" enctype="multipart/form-data">
  {{ csrf_field() }}

  <input type="hidden" name="page_id" value="{{ isset($_GET["page_id"]) ? $_GET["page_id"] : "" }}">

  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Widget Information</h3>
    </div>
    <div class="box-body">

      <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" name="name" id="name" placeholder="Enter name of widget...">
      </div>

      <div class="form-group">
        <label for="slug">Slug</label>
        <input type="text" class="form-control" name="slug" id="slug" placeholder="Enter slug for widget...">
      </div>

    </div>
  </div>

  <div class="box-footer">
      <button type="submit" class="btn btn-primary">Create Widget</button>
  </div>

</form>
@endsection
