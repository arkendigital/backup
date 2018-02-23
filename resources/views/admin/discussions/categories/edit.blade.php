@extends('adminlte::page')

@section('content_header')
    <h1>Edit Discussion Category - {{ $category->name }}</h1>
@endsection

@section('content')

<form action="{{ route('discussion-categories.update', compact("category")) }}" method="POST" role="form" enctype="multipart/form-data">
  {{ csrf_field() }}
  {{ method_field("PATCH") }}

  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Category Information</h3>
    </div>
    <div class="box-body">

      <div class="form-group">
        <label for="name">Category Name</label>
        <input type="text" class="form-control" name="name" id="name" placeholder="Enter category name..." value="{{ $category->name }}">
      </div>

      <div class="form-group">
        <label for="parent_id">Parent</label>
        <select class="form-control" name="parent_id">
          <option value="">If you want this category to be a subcategory please select it's parent</option>
          @foreach($categories as $cat)
            <option value="{{ $cat->id }}" @if($cat->id = $category->parent_id) selected @endif>{{ $cat->name }}</option>
          @endforeach
        </select>
      </div>

      <div class="form-group">
        <label for="name">Icon</label>
        <select name="icon_id" class="form-control">
          @foreach($icons as $icon)
            <option value="{{ $icon->id }}" @if($icon->id == $category->icon_id) selected @endif>{{ $icon->name }}</option>
          @endforeach
        </select>
      </div>

    </div>
  </div>

  <div class="box-footer">
      <button type="submit" class="btn btn-primary">Update Category</button>
  </div>

</form>
@endsection
