@extends('adminlte::page')

@section('content_header')
  <div class="pull-right">
    <a href="{{ route('job-companies.create') }}" class="btn btn-primary">
      <i class="fa fa-plus"></i> Create Company / Recruiter
    </a>
  </div>
  <h1>All Companies / Recruiters</h1>
  <br>
@stop

@section('content')
<div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">All Companies / Recruiters</h3>
    </div>
    <div class="box-body">
        <div class="table-responsive">
            @unless ($companies->isEmpty())
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Company / Recruiter Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($companies as $company)
                    <tr>
                        <td>{{ $company->name }}</td>
                        <td>
                          <div class="btn-group">
                            <a class="btn btn-success btn-small" type="button" href="{{ route('job-companies.edit', $company) }}">
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
                <h3 class="text-center">You haven't added any companies / recruiters.</h3>
                <img src="{{ asset('storage/images/admin/no-pages-error.jpg') }}" class="center-block" alt="">
              </div>
            @endunless
        </div>
    </div>
</div>
@endsection
