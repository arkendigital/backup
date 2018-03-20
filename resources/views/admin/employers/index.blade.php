@extends('adminlte::page')

@section('content_header')
  <div class="pull-right">
    <a href="{{ route('employers.create') }}" class="btn btn-primary">
      <i class="fa fa-plus"></i> Create Employer
    </a>
  </div>
  <h1>All Employers</h1>
  <br>
@stop

@section('content')


  <div class="box box-primary">
    <div class="box-body">
      <div class="table-responsive">
        @unless ($employers->isEmpty())
          <table class="table table-hover">
            <thead>
              <tr>
                <th>Name</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
            @foreach ($employers as $employer)
              <tr>
                <td>{{ $employer->name }}</td>
                <td>
                  <div class="btn-group">
                    <a class="btn btn-success btn-small" type="button" href="{{ route('employers.edit', $employer) }}">
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
            <h3 class="text-center">There are no employers or societies yet, why not create one?</h3>
          </div>
        @endunless
      </div>
    </div>
  </div>

@endsection
