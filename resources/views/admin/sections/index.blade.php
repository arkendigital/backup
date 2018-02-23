@extends('adminlte::page')

@section('content_header')
  <h1>All Sections</h1>
  <br>
@stop

@section('content')
<div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">All Sections</h3>
    </div>
    <div class="box-body">
        <div class="table-responsive">
            @unless ($sections->isEmpty())
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($sections as $section)
                    <tr>
                        <td>{{ $section->id }}</td>
                        <td>{{ $section->name }}</td>
                        <td>
                          <div class="btn-group">
                            <a class="btn btn-success btn-small" type="button" href="{{ route('sections.edit', $section) }}">
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
                <h3 class="text-center">You haven't added any sections.</h3>
                <img src="{{ asset('storage/images/admin/no-pages-error.jpg') }}" class="center-block" alt="">
              </div>
            @endunless
        </div>
    </div>
</div>
@endsection
