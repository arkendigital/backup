@extends('adminlte::page')

@section('content_header')
    <h1>Edit Section &mdash; {{ $section->name }}</h1>
@endsection

@section('content')

<form action="{{ route('sections.update', $section) }}" method="POST" role="form" enctype="multipart/form-data">
  {{ csrf_field() }}
  {{ method_field('PATCH') }}

  <div class="box box-primary">
    <div class="box-body">
      <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" name="name" id="name" value="{{ $section->name }}" placeholder="Section name...">
      </div>

      <div class="form-group">
        <label for="color">Colour</label>
        <input type="color" class="form-control" name="color" id="color" value="{{ $section->color }}">
      </div>

      <div class="form-group">
        <label for="image">Banner Image</label>
        <p> <img src="{{ $section->image }}" height="75"> </p>
        <input type="file" class="form-control" name="image" id="image">
      </div>

      <div class="form-group">
        <label for="thumbnail">Thumbnail Image <i>(thumbnail images should be 275 pixels by 275 pixels to display accurately)</i></label>
        <p> <img src="{{ $section->thumbnail }}" height="75"> </p>
        <input type="file" class="form-control" name="thumbnail" id="thumbnail">
      </div>

      <div class="form-group">
        <label for="slug">Slug</label>
        <input type="text" class="form-control" name="slug" id="slug" value="{{ $section->slug }}">
      </div>

      <div class="form-group">
        <label for="color">Sidebar</label>
        <select class="form-control" name="sidebar_id">
          <option value="">Select a sidebar for pages in this section</option>
          @foreach($sidebars as $sidebar)
            <option value="{{ $sidebar->id }}" @if($sidebar->id == $section->sidebar_id) selected @endif>{{ $sidebar->name }}</option>
          @endforeach
        </select>
      </div>
    </div>
  </div>

  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Section Fields</h3>
    </div>
    <div class="box-body">

      @foreach($section->fields as $field)
        <div class="form-group">
          <label for="{{ $field->key }}">{{ $field->name }}</label>
          @if($field->type == "string")

            @if ($field->key == 'exam_carousel')
              @foreach (json_decode($field->value) as $key => $value)
              <input type="text" class="form-control" name="field[{{ $field->key }}][]" id="{{ $field->key }}_{{ $key }}" value="{{ $value }}">
              @endforeach
            @else
              <input type="text" class="form-control" name="field[{{ $field->key }}]" id="{{ $field->key }}" value="{{ $field->value }}">
            @endif
          @elseif($field->type == "text")
            <textarea class="form-control editor" name="field[{{ $field->key }}]" id="{{ $field->key }}">{{ $field->value }}</textarea>
          @endif
        </div>
      @endforeach

    </div>
  </div>

  <div class="box-footer">
    <button type="submit" class="btn btn-primary">Update</button>
  </div>

</form>

@endsection
