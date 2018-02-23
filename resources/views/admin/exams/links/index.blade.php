@extends('adminlte::page')

@section('content_header')
  <div class="pull-right">
    <a href="{{ route('exam-links.create') }}" class="btn btn-primary">
      <i class="fa fa-plus"></i> Add Useful Link
    </a>
  </div>
  <h1>Useful Exam Links</h1>
  <br>
@stop

@section('content')

  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Official Useful Links</h3>
    </div>
    <div class="box-body">
      <div class="table-responsive">
        @unless ($official_links->isEmpty())
        <table class="table table-hover">
          <thead>
            <tr>
              <th>Name</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
          @foreach ($official_links as $link)
            <tr>
              <td>{{ $link->name }}</td>
              <td>
                <div class="btn-group">
                  <a class="btn btn-success btn-small" type="button" href="{{ route('exam-links.edit', $link) }}">
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
            <h3 class="text-center">There are no links..</h3>
            <img src="{{ asset('storage/images/admin/no-pages-error.jpg') }}" class="center-block" alt="">
          </div>
        @endunless
      </div>
    </div>
  </div>

  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Unofficial Useful Links</h3>
    </div>
    <div class="box-body">
      <div class="table-responsive">
        @unless ($unofficial_links->isEmpty())
        <table class="table table-hover">
          <thead>
            <tr>
              <th>Name</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
          @foreach ($unofficial_links as $link)
            <tr>
              <td>{{ $link->name }}</td>
              <td>
                <div class="btn-group">
                  <a class="btn btn-success btn-small" type="button" href="{{ route('exam-links.edit', $link) }}">
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
            <h3 class="text-center">There are no links..</h3>
            <img src="{{ asset('storage/images/admin/no-pages-error.jpg') }}" class="center-block" alt="">
          </div>
        @endunless
      </div>
    </div>
  </div>

@endsection
