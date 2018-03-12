@extends('adminlte::page')

@section('content_header')
    <h1>Create New Box Item in {{ $group->name }}</h1>
@endsection

@section('content')

<form action="{{ route('box-items.store') }}" method="POST" role="form">
  {{ csrf_field() }}

  <input type="hidden" name="group_id" value="{{ $group->id }}">

  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Box Information</h3>
    </div>
    <div class="box-body">

      <div class="form-group">
        <label for="title">Title</label>
        <input type="text" class="form-control" name="title" id="title" placeholder="Enter a title for this box...">
      </div>

      <div class="form-group">
        <label for="link">Link (URL)</label>
        <input type="text" class="form-control" name="link" id="link" placeholder="Enter a link for this box...">
      </div>

    </div>
  </div>

  <div class="box-footer">
      <button type="submit" class="btn btn-primary">Add to Group</button>
  </div>

</form>

@endsection
