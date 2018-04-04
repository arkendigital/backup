@extends('adminlte::page')

@section('content_header')
    <h1>New Job Sector</h1>
@endsection

@section('content')
<div class="box box-primary">
    <form action="{{ route('jobs.sectors.store') }}" method="POST" role="form">
        <div class="box-body">
            {{ csrf_field() }}
            {{ method_field('PUT') }}

            <div class="form-group">
              <label for="name">Sector Name</label>
              @if($errors->has("name"))
                <p class="text-danger">{{ $errors->first("name") }}</p>
              @endif
              <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}" placeholder="Enter sector name">
            </div>
        </div>

        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
</div>
@endsection
