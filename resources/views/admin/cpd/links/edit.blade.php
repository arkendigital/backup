@extends('adminlte::page')

@section('content_header')
    <h1>Edit CPD Verifiable Link - {{ $link->name }}</h1>
@endsection

@section('content')

<div class="box box-primary">
    <form action="{{ route('cpd-links.update', compact("link")) }}" method="POST" role="form">
        <div class="box-body">
            {{ csrf_field() }}
            {{ method_field("PATCH") }}

            <div class="form-group">
              <label for="name">Link Name</label>
              @if($errors->has("name"))
                <p class="text-danger">{{ $errors->first("name") }}</p>
              @endif
              <input type="text" class="form-control" name="name" id="name" value="{{ $link->name }}" placeholder="Enter link name...">
            </div>

            <div class="form-group">
              <label for="excerpt">Link URL</label>
              @if($errors->has("link"))
                <p class="text-danger">{{ $errors->first("link") }}</p>
              @endif
              <input type="text" class="form-control" name="link" id="link" value="{{ $link->link }}" placeholder="Enter URL...">
            </div>

        </div>
        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Update Link</button>
        </div>
    </form>
</div>

@endsection
