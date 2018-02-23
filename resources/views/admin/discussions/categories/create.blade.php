@extends('adminlte::page')

@section('content_header')
    <h1>Create New Discussion Category</h1>
@endsection

@section('content')

<form action="{{ route('discussion-categories.store') }}" method="POST" role="form" enctype="multipart/form-data">
  {{ csrf_field() }}

  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Category Information</h3>
    </div>
    <div class="box-body">

      <div class="form-group">
        <label for="name">Category Name</label>
        <input type="text" class="form-control" name="name" id="name" placeholder="Enter category name...">
      </div>

      <div class="form-group">
        <label for="parent_id">Parent</label>
        <select class="form-control" name="parent_id">
          <option value="">If you want this category to be a subcategory please select it's parent</option>
          @foreach($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
          @endforeach
        </select>
      </div>

    </div>
  </div>

  <div class="box-footer">
      <button type="submit" class="btn btn-primary">Create Category</button>
  </div>

</form>
@endsection
