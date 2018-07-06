@extends('adminlte::page')

@section('content_header')
    <h1>Create CPD Resource</h1>
@endsection

@section('content')

<div class="box box-primary">
    <form action="{{ route('cpd-resources.store') }}" method="POST" role="form" enctype="multipart/form-data">
        <div class="box-body">
            {{ csrf_field() }}
            {{ method_field("POST") }}

            <div class="form-group">
              <label for="name">Resource Name</label>
              @if($errors->has("name"))
                <p class="text-danger">{{ $errors->first("name") }}</p>
              @endif
              <input type="text" class="form-control" name="name" id="name" value="{{ old("name") }}" placeholder="Enter resource name...">
            </div>

            <div class="form-group">
              <label for="excerpt">Resource Link <small class="text-danger">(If you would like this resource to link to a different internal or external page, enter the URL here. Otherwise leave this blank)</small></label>
              @if($errors->has("link"))
                <p class="text-danger">{{ $errors->first("link") }}</p>
              @endif
              <input type="text" class="form-control" name="link" id="link" value="{{ old("link") }}" placeholder="Enter resource link...">
            </div>

            <div class="form-group">
              <label for="excerpt">Resource Excerpt</label>
              @if($errors->has("excerpt"))
                <p class="text-danger">{{ $errors->first("excerpt") }}</p>
              @endif
              <input type="text" class="form-control" name="excerpt" id="excerpt" value="{{ old("excerpt") }}" placeholder="Enter resource excerpt...">
            </div>

            <div class="form-group">
              <label for="excerpt">Resource Icon</label>
              @if($errors->has("excerpt"))
                <p class="text-danger">{{ $errors->first("excerpt") }}</p>
              @endif
              <input type="file" class="form-control" name="icon" id="icon">
            </div>

            <div class="form-group">
              <label for="content">Resource Content</label>
              @if($errors->has("content"))
                <p class="text-danger">{{ $errors->first("content") }}</p>
              @endif
              <textarea class="form-control editor" name="content" id="content">{{ old("content") }}</textarea>
            </div>

        </div>
        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Create Resource</button>
        </div>
    </form>
</div>

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
