@extends('adminlte::page')

@section('content_header')
  <div class="pull-right">
    <a href="{{ route('sidebars.create') }}" class="btn btn-primary">
      <i class="fa fa-plus"></i> Create Sidebar
    </a>
  </div>
  <h1>All Sidebars</h1>
  <br>
@stop

@section('content')


  <div class="box box-primary">
    <div class="box-body">
      <div class="table-responsive">
        @unless ($sidebars->isEmpty())
          <table class="table table-hover">
            <thead>
              <tr>
                <th>Name</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
            @foreach ($sidebars as $sidebar)
              <tr>
                <td>{{ $sidebar->name }}</td>
                <td>
                  <div class="btn-group">
                    <a class="btn btn-success btn-small" type="button" href="{{ route('sidebars.edit', $sidebar) }}">
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
            <h3 class="text-center">There are no sidebars yet, why not create one?</h3>
            <img src="{{ asset('storage/images/admin/no-pages-error.jpg') }}" class="center-block" alt="">
          </div>
        @endunless
      </div>
    </div>
  </div>

@endsection
