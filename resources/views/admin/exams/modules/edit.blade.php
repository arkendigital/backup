@extends('adminlte::page')

@section('content_header')
    <h1>Editing Module {{ $module->name }}</h1>
@endsection

@section('content')

<form action="{{ route('exam-modules.update', compact('module')) }}" method="POST" role="form" enctype="multipart/form-data">
  {{ csrf_field() }}
  {{ method_field("PATCH") }}

  <input type="hidden" name="category_id" value="{{ $category->id }}">

  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Module Information</h3>
    </div>
    <div class="box-body">

      <div class="form-group">
        <label for="name">Module Identifier</label>
        @if($errors->has("name"))
          <p class="text-danger">{{ $errors->first("name") }}</p>
        @endif
        <input type="text" class="form-control" name="name" id="name" placeholder="Enter an identifier for this module..." value="{{ $module->name }}">
      </div>

      <div class="form-group">
        <label for="info_name">Name</label>
        <input type="text" class="form-control" name="info_name" id="info_name" placeholder="Enter a name for this module..." value="{{ $module->info->name }}">
      </div>

      <div class="form-group">
        <label for="excerpt">Excerpt</label>
        @if($errors->has("excerpt"))
          <p class="text-danger">{{ $errors->first("excerpt") }}</p>
        @endif
        <input type="text" class="form-control" name="excerpt" id="excerpt" placeholder="Enter excerpt..." value="{{ $module->excerpt }}">
      </div>

    </div>
  </div>

  @foreach($module_sections as $module_section_key)
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Section {{ ucwords($module_section_key) }}</h3>
      </div>
      <div class="box-body">

          <div class="form-group">
            <label for="section_{{ $module_section_key }}_title">Title</label>
            @if($errors->has("section_".$module_section_key."_title"))
              <p>{{ $errors->first("section_".$module_section_key."_title") }}</p>
            @endif
            <input type="text" class="form-control" name="section_{{ $module_section_key }}_title" id="section_{{ $module_section_key }}_title" placeholder="Enter title..." value="{{ $module->info->{'section_'.$module_section_key.'_title'} }}">
          </div>

          <div class="form-group">
            <label for="section_{{ $module_section_key }}_text">Text <sup>(If you want this text to be a clickable button, enter a link in the link field below)</sup></label>
            <input type="text" class="form-control" name="section_{{ $module_section_key }}_text" id="section_{{ $module_section_key }}_text" placeholder="Enter text..." value="{{ $module->info->{'section_'.$module_section_key.'_text'} }}">
          </div>

          <div class="form-group">
            <label for="section_{{ $module_section_key }}_link">Link</label>
            <input type="text" class="form-control" name="section_{{ $module_section_key }}_link" id="section_{{ $module_section_key }}_link" placeholder="Enter link for button..." value="{{ $module->info->{'section_'.$module_section_key.'_link'} }}">
          </div>

      </div>
    </div>
  @endforeach

  <div class="box-footer">
      <button type="submit" class="btn btn-primary">Update Module</button>
  </div>

</form>

@endsection
