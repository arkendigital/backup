@extends('adminlte::page')

@section('content_header')
    <h1>New Job Location</h1>
@endsection

@section('content')
<div class="box box-primary">
    <form action="{{ route('jobs.locations.store') }}" method="POST" role="form">
        <div class="box-body">
            {{ csrf_field() }}
            {{ method_field('PUT') }}

            <div class="form-group">
              <label for="name">Location Name</label>
              @if($errors->has("name"))
                <p class="text-danger">{{ $errors->first("name") }}</p>
              @endif
              <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}" placeholder="Enter location name">
            </div>

            <div class="form-group">
              <label for="region_id">Region</label>
              @if($errors->has("region_id"))
                <p class="text-danger">{{ $errors->first("region_id") }}</p>
              @endif
              <select name="region_id" class="form-control">
                  <option value="">Please select...</option>
                  @foreach($regions as $region)
                      <option value="{{ $region->id }}">{{ $region->name }}</option>
                  @endforeach
              </select>
            </div>
        </div>

        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
</div>
@endsection
