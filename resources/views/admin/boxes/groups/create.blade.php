@extends('adminlte::page')

@section('content_header')
    <h1>Create New Box Group</h1>
@endsection

@section('content')

<form action="{{ route('box-groups.store') }}" method="POST" role="form" enctype="multipart/form-data">
  {{ csrf_field() }}

  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Box Group Information</h3>
    </div>
    <div class="box-body">

      <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" name="name" id="name" placeholder="Enter a name for this box group...">
      </div>

        <div class="form-group">
          <label for="widget_slug">Name</label>
          <select class="form-control" name="widget_slug" id="widget_slug">
            @foreach($widgets as $widget)
              <option value="{{ $widget->slug }}">{{ $widget->name }}</option>
            @endforeach
          </select>
        </div>

    </div>
  </div>

  <div class="box-footer">
      <button type="submit" class="btn btn-primary">Create</button>
  </div>

</form>

@endsection
