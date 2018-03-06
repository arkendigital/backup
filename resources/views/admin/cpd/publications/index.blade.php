@extends('adminlte::page')

@section('content_header')

  <div class="pull-right">
    <a href="{{ route('cpd-publications.create') }}" class="btn btn-primary">
      <i class="fa fa-plus"></i> Add Publication
    </a>
  </div>

  <h1>All CPD Publications</h1>

  <br>

@stop

@section('content')

  <div class="box box-primary">
    <div class="box-body">
      <div class="table-responsive">
        @unless ($publications->isEmpty())
        <table class="table table-hover">
          <thead>
            <tr>
              <th>Name</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
          @foreach($publications as $publication)
            <tr>
              <td>{{ $publication->name }}</td>
              <td>
                <div class="btn-group">
                  <a class="btn btn-success btn-small" type="button" href="{{ route('cpd-publications.edit', $publication) }}">
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
            <h3 class="text-center">There are no CPD publications.</h3>
          </div>
        @endunless
      </div>
    </div>
  </div>

@endsection
