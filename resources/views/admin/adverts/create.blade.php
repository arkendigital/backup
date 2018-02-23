@extends('adminlte::page')

@section('content_header')
    <h1>Create Advert</h1>
@endsection

@section('content')

<div class="box box-primary">
    <form action="{{ route('adverts.store') }}" method="POST" role="form" enctype="multipart/form-data">
        <div class="box-body">
            {{ csrf_field() }}
            {{ method_field("POST") }}

            <div class="form-group">
              <label for="name">Advert Name</label>
              @if($errors->has("name"))
                <p class="text-danger">{{ $errors->first("name") }}</p>
              @endif
              <input type="text" class="form-control" name="name" id="name" value="{{ old("name") }}" placeholder="Enter name of advert...">
            </div>

            <div class="form-group">
              <label for="url">Advert Link (URL)</label>
              @if($errors->has("url"))
                <p class="text-danger">{{ $errors->first("url") }}</p>
              @endif
              <input type="text" class="form-control" name="url" id="url" value="{{ old("url") }}" placeholder="Enter link (URL) for advert...">
            </div>

            <div class="form-group">
              <label for="image">Advert Image</label>
              @if($errors->has("image"))
                <p class="text-danger">{{ $errors->first("image") }}</p>
              @endif
              <input type="file" class="form-control" name="image" id="image">
            </div>

        </div>
        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Create Advert</button>
        </div>
    </form>
</div>

@endsection
