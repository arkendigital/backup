@extends('adminlte::page')

@section('content_header')
  @if(auth()->user()->hasRole("Super Administrator"))
    <div class="pull-right">
      <a href="{{ route('widgets.create') }}" class="btn btn-primary">
        <i class="fa fa-plus"></i> New Widget
      </a>
    </div>
  @endif
  <h1>All Widgets</h1>
  <br>
@stop

@section('content')


  <div class="box box-primary">
    <div class="box-body">
      <div class="table-responsive">
        @unless ($widgets->isEmpty())
          <table class="table table-hover">
            <thead>
              <tr>
                <th>Name</th>
                <th>Slug</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
            @foreach ($widgets as $widget)
              <tr>
                <td>{{ $widget->name }}</td>
                <td>{{ $widget->slug }}</td>
                <td>
                  <div class="btn-group">
                    <a class="btn btn-success btn-small" type="button" href="{{ route('widgets.edit', $widget) }}">
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
            <h3 class="text-center">There are widgets yet.</h3>
          </div>
        @endunless
      </div>
    </div>
  </div>

@endsection
