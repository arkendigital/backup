@extends('adminlte::page')

@section('content_header')
    <h1>Edit Article &mdash; {{ $article->title }}</h1>
@endsection

@section('content')

@if($article->image)
<div class="box" style="text-align: center; background-size: cover; background-position: center; background-image: url({{asset($article->image)}});min-height: 400px;"></div>
@endif

<div class="box box-primary">
    <form action="{{ route('support-articles.update', $article->id) }}" method="POST" role="form" enctype="multipart/form-data">
        <div class="box-body">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}

            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" name="title" id="title" value="{{ $article->title }}" placeholder="Title">
            </div>
            
            <div class="form-group">
                <label for="author">Author</label>
                <input type="text" class="form-control" name="author" id="author" value="{{ $article->author }}" placeholder="Author">
            </div>

            <div class="form-group">
                <label for="body">Body</label>
                <textarea class="form-control editor" name="body" id="body" placeholder="Article Body" rows="5">{{ $article->body }}</textarea>
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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.9.4/plugins/upload/trumbowyg.upload.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.9.4/plugins/colors/trumbowyg.colors.min.js"></script>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.9.4/ui/trumbowyg.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.9.4/plugins/colors/ui/trumbowyg.colors.min.css">
  <script>
    $('.editor').trumbowyg({
      svgPath: '/images/icons.svg',
      btnsDef: {
        image: {
            dropdown: ['insertImage', 'upload'],
            ico: 'insertImage'
        },
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
        ['image'],
        ['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'],
        ['unorderedList', 'orderedList'],
        ['horizontalRule'],
        ['removeformat'],
        ['fullscreen'],
        ['buttonShortcode']
      ],
      plugins: {
        // Add imagur parameters to upload plugin for demo purposes
        upload: {
              serverPath: "{{ url('ops/support-articles/'.$article->id.'/image-upload') }}",
              fileFieldName: 'image',
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              urlPropertyName: 'url'
          }
      }
    });
  </script>
@endpush
@endsection
