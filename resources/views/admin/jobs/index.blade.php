@extends('adminlte::page')

@section('content_header')
  <div class="pull-right">
    <a href="{{ route('jobs.create') }}" class="btn btn-primary">
      <i class="fa fa-plus"></i> Create Job
    </a>
  </div>
  <h1>All Jobs</h1>
  <br>
@stop

@section('content')
<div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">All Jobs</h3>
    </div>
    <div class="box-body">
        <div class="table-responsive">
            @unless ($jobs->isEmpty())
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Job Title</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($jobs as $job)
                    <tr>
                        <td>{{ $job->title }}</td>
                        <td>
                          <div class="btn-group">
                            <a class="btn btn-success btn-small" type="button" href="{{ route('jobs.edit', $job) }}">
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
                <h3 class="text-center">You haven't added any jobs.</h3>
                <img src="{{ asset('storage/images/admin/no-pages-error.jpg') }}" class="center-block" alt="">
              </div>
            @endunless
        </div>
    </div>
</div>
@endsection
