@extends('adminlte::page')

@section('content_header')
    <h1>Edit Page - {{ $page->name }}</h1>
@endsection

@section('content')

@if(auth()->user()->hasRole("Super Administrator"))
  <a class="btn btn-primary" style="margin-bottom:15px;" href="{{ route("pages.add.widget", $page->id) }}">Add a Widget</a>
@endif

<form action="" method="POST" role="form" enctype="multipart/form-data">
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

      @if(auth()->user()->hasRole("Super Administrator"))
        <div class="form-group">
          <label for="slug">Page URL / Slug</label>
          <input type="text" class="form-control" name="slug" id="slug" placeholder="Enter page url..." value="{{ $page->slug }}">
        </div>
      @endif

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

      <div class="form-group">
        <label for="show_on_sitemap">Show on Sitemaps?</label>
        <div class="checkbox">
            <label>
                <input type="checkbox" name="show_on_sitemap" id="show_on_sitemap" 
                @if ($page->show_on_sitemap)
                checked
                @endif> Show on Sitemaps?
            </label>
        </div>
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



  @if(!$page->fields->isEmpty())
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
  @endif




  @if(!$page->adverts->isEmpty())
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Adverts</h3>
      </div>
      <div class="box-body">

        @foreach($page->adverts as $page_advert)
          <div class="form-group">
            <label for="meta_title">{{ ucwords(str_replace("-", " ", $page_advert->slug)) }} Advert</label>
            <select name="adverts[{{ $page_advert->id }}]" class="form-control">
              <option value="">None</option>
              @foreach(\App\Models\Advert::all() as $advert)
                <option value="{{ $advert->id }}" @if($page_advert->advert_id == $advert->id) selected @endif>{{ $advert->name }}</option>
              @endforeach
            </select>
          </div>
        @endforeach

      </div>
    </div>
  @endif









  @if(!$page->getWidgets()->isEmpty())
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Widgets</h3>
        @if(auth()->user()->hasRole("Super Administrator"))
          <a class="btn btn-primary pull-right" href="{{ route("page-widgets.create") }}?page_id={{ $page->id }}" style="margin-left: 10px;">Create Widget</a>
        @endif
        <a class="btn btn-primary pull-right" href="{{ route("page-widgets.order", $page->id) }}">Update Widget Order</a>
      </div>
      <div class="box-body">

        @foreach($page->getWidgets() as $page_widget)
          <div class="form-group">
            <label for="meta_title">Show the widget "{{ $page_widget->widget->name }}"?</label>
            <p><input type="checkbox" name="widgets[{{ $page_widget->id }}]" id="widget-{{ $page_widget->id }}" @if($page_widget->is_visible) checked @endif value="{{ $page_widget->id }}"> <label for="widget-{{ $page_widget->id }}" style="margin-left: 5px;">Yes</label></p>
          </div>
        @endforeach

      </div>
    </div>
  @endif









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
      btnsDef: {
        buttonShortcode: {
          fn: 'insertText',
          ico: 'horizontal-rule',
          title: 'Insert Button Shortcode',
          text: 'Button Shortcode',
          param: '[button text="Insert Button Text" link="Insert Button Link" new_tab="Yes"]',
          forceCss: true,
          hasIcon: false
        }
      },
      btns: [
        ['viewHTML'],
        ['undo', 'redo'], // Only supported in Blink browsers
        ['formatting'],
        ['strong', 'em', 'del'],
        ['superscript', 'subscript'],
        ['link'],
        ['insertImage'],
        ['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'],
        ['unorderedList', 'orderedList'],
        ['horizontalRule'],
        ['removeformat'],
        ['fullscreen'],
        ['buttonShortcode']
      ]
    });
  </script>
@endpush

@endsection
