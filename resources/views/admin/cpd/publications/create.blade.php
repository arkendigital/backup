@extends('adminlte::page')

@section('content_header')
    <h1>Create CPD Publication</h1>
@endsection

@section('content')

<div class="box box-primary">
    <form action="{{ route('cpd-publications.store') }}" method="POST" role="form" enctype="multipart/form-data">
        <div class="box-body">
            {{ csrf_field() }}
            {{ method_field("POST") }}

            <div class="form-group">
              <label for="name">Publication Name</label>
              @if($errors->has("name"))
                <p class="text-danger">{{ $errors->first("name") }}</p>
              @endif
              <input type="text" class="form-control" name="name" id="name" value="{{ old("name") }}" placeholder="Enter name of publication...">
            </div>

            <div class="form-group">
              <label for="link">Publication Link</label>
              @if($errors->has("link"))
                <p class="text-danger">{{ $errors->first("link") }}</p>
              @endif
              <input type="text" class="form-control" name="link" id="link" value="{{ old("link") }}" placeholder="Enter link to publication...">
            </div>

        </div>
        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Upload Publication</button>
        </div>
    </form>
</div>

@endsection
