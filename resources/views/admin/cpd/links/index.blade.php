@extends('adminlte::page')

@section('content_header')

  <div class="pull-right">
    <a href="{{ route('cpd-links.create') }}" class="btn btn-primary">
      <i class="fa fa-plus"></i> Add Link
    </a>
  </div>

  <h1>All CPD Verifiable Links</h1>

  <br>

@stop

@section('content')

  <div class="box box-primary">
    <div class="box-body">
      <div class="table-responsive">
        @unless ($links->isEmpty())
        <table class="table table-hover">
          <thead>
            <tr>
              <th>Name</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
          @foreach($links as $link)
            <tr>
              <td>{{ $link->name }}</td>
              <td>
                <div class="btn-group">
                  <a class="btn btn-success btn-small" type="button" href="{{ route('cpd-links.edit', $link) }}">
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
            <h3 class="text-center">There are no CPD verifiable links.</h3>
          </div>
        @endunless
      </div>
    </div>
  </div>

@endsection
