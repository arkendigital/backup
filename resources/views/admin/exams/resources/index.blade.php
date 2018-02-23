@extends('adminlte::page')

@section('content_header')
  <div class="pull-right">
    <a href="{{ route('exam-resources.create') }}" class="btn btn-primary">
      <i class="fa fa-plus"></i> Add Resource
    </a>
  </div>
  <h1>All Exam Resources</h1>
  <br>
@stop

@section('content')


    <div class="box box-primary">
      <div class="box-body">
        <div class="table-responsive">
          @unless ($resources->isEmpty())
          <table class="table table-hover">
            <thead>
              <tr>
                <th>Name</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
            @foreach($resources as $resource)
              <tr>
                <td>{{ $resource->name }}</td>
                <td>
                  <div class="btn-group">
                    <a class="btn btn-success btn-small" type="button" href="{{ route('exam-resources.edit', $resource) }}">
                      <i class="fa fa-pencil"></i>
                    </a>
                  </div>
                </td>
              </tr>
            @endforeach
            </tbody>
          </table>
          @else
            <div class="box__content">
              <h3 class="text-center">There are no exam resources.</h3>
              <img src="{{ asset('storage/images/admin/no-pages-error.jpg') }}" class="center-block" alt="">
            </div>
          @endunless
        </div>
      </div>
    </div>

@endsection
