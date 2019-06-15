@extends('adminlte::page')

@section('content_header')
    <h1>Widget - {{ $widget->name }}</h1>
@endsection

@section('content')

  <form action="{{ route('widgets.update', compact("widget")) }}" method="POST" role="form" id="widgetForm" enctype="multipart/form-data">
    {{ csrf_field() }}
    {{ method_field("PATCH") }}

    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Widget Information</h3>
      </div>
      <div class="box-body">

        <div class="form-group">
          <label for="name">Name</label>
          <input type="text" class="form-control" name="name" id="name" placeholder="Enter a name for this widget" value="{{ $widget->name }}">
        </div>

        <div class="form-group">
          <label for="slug">Slug</label>
          <input type="text" class="form-control" name="slug" id="slug" placeholder="Enter a slug for this widget" value="{{ $widget->slug }}">
        </div>

      </div>
    </div>
  </form>


  <div class="box-footer">
      <button type="button" class="btn btn-primary" onclick="document.getElementById('widgetForm').submit(); return false;">Update</button>
  </div>



@endsection
