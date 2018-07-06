@extends('adminlte::page')

@section('content_header')
    <h1>Edit Resource - {{ $resource->name }}</h1>
@endsection

@section('content')

<div class="box box-primary">
    <form action="{{ route('cpd-resources.update', compact("resource")) }}" method="POST" role="form" enctype="multipart/form-data">
        <div class="box-body">
            {{ csrf_field() }}
            {{ method_field("PATCH") }}

            <div class="form-group">
              <label for="name">Resource Name</label>
              @if($errors->has("name"))
                <p class="text-danger">{{ $errors->first("name") }}</p>
              @endif
              <input type="text" class="form-control" name="name" id="name" value="{{ $resource->name }}" placeholder="Enter resource name...">
            </div>

            <div class="form-group">
              <label for="slug">Resource Slug</label>
              @if($errors->has("slug"))
                <p class="text-danger">{{ $errors->first("slug") }}</p>
              @endif
              <input type="text" class="form-control" name="slug" id="slug" value="{{ $resource->slug }}" placeholder="Enter resource slug...">
            </div>

            <div class="form-group">
              <label for="excerpt">Resource Link <small class="text-danger">(If you would like this resource to link to a different internal or external page, enter the URL here. Otherwise leave this blank)</small></label>
              @if($errors->has("link"))
                <p class="text-danger">{{ $errors->first("link") }}</p>
              @endif
              <input type="text" class="form-control" name="link" id="link" value="{{ $resource->link }}" placeholder="Enter resource link...">
            </div>

            <div class="form-group">
              <label for="advert">Advert</label>
              @if($errors->has("advert"))
                <p class="text-danger">{{ $errors->first("advert") }}</p>
              @endif
              <select name="advert_id" class="form-control">
                <option value="">None</option>
                @foreach($adverts as $advert)
                  <option value="{{ $advert->id }}" @if($advert->id == $resource->advert_id) selected @endif>{{ $advert->name }}</option>
                @endforeach
              </select>
            </div>

            <div class="form-group">
              <label for="excerpt">Resource Excerpt</label>
              @if($errors->has("excerpt"))
                <p class="text-danger">{{ $errors->first("excerpt") }}</p>
              @endif
              <input type="text" class="form-control" name="excerpt" id="excerpt" value="{{ $resource->excerpt }}" placeholder="Enter resource excerpt...">
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
              <textarea class="form-control editor" name="content" id="content">{{ $resource->content }}</textarea>
            </div>

        </div>
        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Update Resource</button>
        </div>
    </form>
</div>

<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">Resource Links <small>(links are only applicable to resources that do not have an external link)</small></h3>
    <a class="btn btn-primary btn-small pull-right" type="button" href="{{ route("ops.cpd.resources.links.create", $resource) }}">Create Link</a>
  </div>
  <div class="box-body">
    @if($resource->links->isEmpty())
      This resource has no links yet.
    @else

      <div class="table-responsive">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>Title</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach($resource->links as $link)
              <tr>
                <td>{{ $link->title }}</td>
                <td>
                  <div class="btn-group">
                    <a class="btn btn-success btn-small" type="button" href="{{ route("ops.cpd.resources.links.edit", [$resource, $link]) }}">
                      <i class="fa fa-pencil"></i>
                    </a>
                  </div>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>

    @endif
  </div>
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
