@extends('adminlte::page')

@section('content_header')
    <h1>{{ $society->name }}</h1>
@endsection

@section('content')

<div class="box box-primary">
    <form action="{{ route('societies.update', compact('society')) }}" method="POST" role="form" enctype="multipart/form-data">
        <div class="box-body">
            {{ csrf_field() }}
            {{ method_field("PATCH") }}

            <div class="form-group">
              <label for="name">Name <sup class="text-danger">* (mandatory)</sup></label>
              @if($errors->has("name"))
                <p class="text-danger">{{ $errors->first("name") }}</p>
              @endif
              <input type="text" class="form-control" name="name" id="name" value="{{ $society->name }}" placeholder="Enter name...">
            </div>

            <div class="form-group">
              <label for="name">Postcode <sup class="text-danger">* (mandatory)</sup></label>
              @if($errors->has("postcode"))
                <p class="text-danger">{{ $errors->first("postcode") }}</p>
              @endif
              <input type="text" class="form-control" name="postcode" id="postcode" value="{{ $society->postcode }}" placeholder="Enter postcode...">
            </div>

        </div>
        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>
</div>

@endsection
