@extends('adminlte::page')

@section('content_header')
    <h1>Updating {{ $link->title }} on {{ $resource->name }}</h1>
@endsection

@section('content')

<div class="box box-primary">
    <form action="{{ route("ops.cpd.resources.links.update", [$resource, $link]) }}" method="POST" role="form">
        <div class="box-body">
            {{ csrf_field() }}
            {{ method_field("PATCH") }}

            <div class="form-group">
              <label for="name">Title</label>
              @if($errors->has("title"))
                <p class="text-danger">{{ $errors->first("title") }}</p>
              @endif
              <input type="text" class="form-control" name="title" id="title" value="{{ session()->exists("errors") ? old("title") : $link->title }}" placeholder="Enter link title...">
            </div>

						<div class="form-group">
              <label for="subtitle">Subtitle <small class="text-info">(optional)</small></label>
              @if($errors->has("subtitle"))
                <p class="text-danger">{{ $errors->first("subtitle") }}</p>
              @endif
              <input type="text" class="form-control" name="subtitle" id="subtitle" value="{{ session()->exists("errors") ? old("subtitle") : $link->subtitle }}" placeholder="Enter link subtitle...">
            </div>

						<div class="form-group">
              <label for="text">Text</label>
              @if($errors->has("text"))
                <p class="text-danger">{{ $errors->first("text") }}</p>
              @endif
              <input type="text" class="form-control" name="text" id="text" value="{{ session()->exists("errors") ? old("text") : $link->text }}" placeholder="Enter link text...">
            </div>

            <div class="form-group">
              <label for="excerpt">Link URL</label>
              @if($errors->has("link"))
                <p class="text-danger">{{ $errors->first("link") }}</p>
              @endif
              <input type="text" class="form-control" name="link" id="link" value="{{ session()->exists("errors") ? old("link") : $link->link }}" placeholder="Enter URL...">
            </div>

        </div>
        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>
</div>

@endsection
