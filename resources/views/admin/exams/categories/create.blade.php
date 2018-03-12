@extends('adminlte::page')

@section('content_header')
    <h1>Create New Exam Category</h1>
@endsection

@section('content')

<form action="{{ route('exam-categories.store') }}" method="POST" role="form" enctype="multipart/form-data">
  {{ csrf_field() }}

  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Category Information</h3>
    </div>
    <div class="box-body">

      <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" name="name" id="name" placeholder="Enter a name for this category...">
      </div>

    </div>
  </div>

  <div class="box-footer">
      <button type="submit" class="btn btn-primary">Create Category</button>
  </div>

</form>

@endsection
