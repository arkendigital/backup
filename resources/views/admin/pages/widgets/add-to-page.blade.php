@extends('adminlte::page')

@section('content_header')
    <h1>Add Widget to {{ $page->name }}</h1>
@endsection

@section('content')

<form action="{{ route('pages.add.widget', $page->id) }}" method="POST" role="form" enctype="multipart/form-data">
  {{ csrf_field() }}
  {{ method_field("POST") }}

  <input type="hidden" name="page_id" value="{{ $page->id }}">

  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Add widget</h3>
    </div>
    <div class="box-body">

      <div class="form-group">
        <label for="slug">Slug</label>
        <select class="form-control" name="widget_id">
          <option value="">Select a widget...</option>
          @foreach($widgets as $widget)
            <option value="{{ $widget->id }}">{{ $widget->name }}</option>
          @endforeach
        </select>
      </div>

    </div>
  </div>

  <div class="box-footer">
      <button type="submit" class="btn btn-primary">Add Widget</button>
      <a class="btn btn-primary" href="{{ route("pages.edit", $page->id) }}">Back</a>
  </div>

</form>
@endsection
