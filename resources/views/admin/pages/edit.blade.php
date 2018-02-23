@extends('adminlte::page')

@section('content_header')
    <h1>Edit Page - {{ $page->name }}</h1>
@endsection

@section('content')

<form action="{{ route('pages.update', compact("page")) }}" method="POST" role="form" enctype="multipart/form-data">
  {{ csrf_field() }}
  {{ method_field("PATCH") }}

  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Page Information</h3>
    </div>
    <div class="box-body">

      <div class="form-group">
        <label for="name">Page Name</label>
        <input type="text" class="form-control" name="name" id="name" placeholder="Enter page name..." value="{{ $page->name }}">
      </div>

      <div class="form-group">
        <label for="section_id">Section</label>
        <select class="form-control" name="section_id">
          <option value="">If this page belongs to a section, please select...</option>
          @foreach($sections as $section)
            <option value="{{ $section->id }}" @if($section->id == $page->section_id) selected @endif>{{ $section->name }}</option>
          @endforeach
        </select>
      </div>

      <div class="form-group">
        <label for="discussion_category_id">Discussion Category</label>
        <select class="form-control" name="discussion_category_id">
          <option value="">Select the category you want to show discussions from...</option>
          @foreach($categories as $category)
            <option value="{{ $category->id }}" @if($category->id == $page->discussion_category_id) selected @endif>{{ $category->name }}</option>
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
        <input type="text" class="form-control" name="meta_title" id="meta_title" placeholder="Enter meta / page title..." value="{{ $page->meta_title }}">
      </div>

      <div class="form-group">
        <label for="meta_description">Meta Description</label>
        <input type="text" class="form-control" name="meta_description" id="meta_description" placeholder="Enter meta description..." value="{{ $page->meta_description }}">
      </div>

    </div>
  </div>



  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Page Fields</h3>
    </div>
    <div class="box-body">

      @foreach($page->fields as $field)
        <div class="form-group">
          <label for="{{ $field->key }}">{{ $field->name }}</label>
          @if($field->type == "string")
            <input type="text" class="form-control" name="field[{{ $field->key }}]" id="{{ $field->key }}" value="{{ $field->value }}">
          @elseif($field->type == "text")
            <textarea class="form-control editor" name="field[{{ $field->key }}]" id="{{ $field->key }}">{{ $field->value }}</textarea>
          @endif
        </div>
      @endforeach

    </div>
  </div>

  <div class="box-footer">
      <button type="submit" class="btn btn-primary">Update Page</button>
  </div>

</form>

@push("scripts-after")
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.9.4/trumbowyg.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.9.4/ui/trumbowyg.min.css">
  <script>
    $('.editor').trumbowyg({
      svgPath: '/images/icons.svg',
    });
  </script>
@endpush

@endsection
