@extends('adminlte::page')

@section('content_header')
    <h1>Create New Page</h1>
@endsection

@section('content')

<form action="{{ route('pages.store') }}" method="POST" role="form" enctype="multipart/form-data">
  {{ csrf_field() }}

  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Page Information</h3>
    </div>
    <div class="box-body">

      <div class="form-group">
        <label for="name">Page Name</label>
        <input type="text" class="form-control" name="name" id="name" placeholder="Enter page name...">
      </div>

      <div class="form-group">
        <label for="section_id">Section</label>
        <select class="form-control" name="section_id">
          <option value="">If this page belongs to a section, please select...</option>
          @foreach($sections as $section)
            <option value="{{ $section->id }}">{{ $section->name }}</option>
          @endforeach
        </select>
      </div>

    </div>
  </div>

  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">SEO</h3>
    </div>
    <div class="box-body">

      <div class="form-group">
        <label for="meta_title">Meta / Page Title</label>
        <input type="text" class="form-control" name="meta_title" id="meta_title" placeholder="Enter meta / page title...">
      </div>

      <div class="form-group">
        <label for="meta_description">Meta Description</label>
        <input type="text" class="form-control" name="meta_description" id="meta_description" placeholder="Enter meta description...">
      </div>

    </div>
  </div>

  <div class="box-footer">
      <button type="submit" class="btn btn-primary">Create Page</button>
  </div>

</form>
@endsection
