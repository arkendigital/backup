@extends('adminlte::page')

@section('content_header')
    <h1>Create New Article</h1>
@endsection

@section('content')
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Create New Article</h3>
    </div>
    <form action="{{ route('articles.store') }}" method="POST" role="form" enctype="multipart/form-data">
        <div class="box-body">
            {{ csrf_field() }}

            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" name="title" id="title" placeholder="Title">
            </div>

            <div class="form-group">
                <label for="body">Body</label>
                <textarea class="form-control editor" name="body" id="body" placeholder="Article Body" rows="5"></textarea>
            </div>

            <div class="form-group">
                <label for="category_id">Category</label>
                <select name="category_id" id="category_id" class="form-control" required="required">
                    <option value="1">Uncategorized</option>
                </select>
            </div>

            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" name="image" id="image" class="form-control">
            </div>

        </div>
        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
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
