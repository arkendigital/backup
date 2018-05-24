@extends('adminlte::page')

@section('content_header')
    <h1>Job Location - {{ $location->name }}</h1>
@endsection

@section('content')
<div class="box box-primary">
    <form action="{{ route('jobs.locations.update', $location) }}" method="POST" role="form">
        <div class="box-body">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}

            <div class="form-group">
              <label for="name">Location Name</label>
              @if($errors->has("name"))
                <p class="text-danger">{{ $errors->first("name") }}</p>
              @endif
              <input type="text" class="form-control" name="name" id="name" value="{{ $location->name }}" placeholder="Enter location name">
            </div>

            <div class="form-group">
              <label for="name">Region</label>
              <p>{{ $location->region->name }}</p>
            </div>
        </div>

        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>
</div>
@endsection
