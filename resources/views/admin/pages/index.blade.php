@extends('adminlte::page')

@section('content_header')
  <div class="pull-right">
    <a href="{{ route('pages.create') }}" class="btn btn-primary">
      <i class="fa fa-plus"></i> Create Page
    </a>
  </div>
  <h1>All Pages</h1>
  <br>
@stop

@section('content')


  @foreach($sections as $section)
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">{{ $section->name }}</h3>
      </div>
      <div class="box-body">
        <div class="table-responsive">
          @unless ($section->pages->isEmpty())
          <table class="table table-hover">
            <thead>
              <tr>
                <th>Name</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
            @foreach ($section->pages as $page)
              <tr>
                <td>{{ $page->name }}</td>
                <td>
                  <div class="btn-group">
                    <a class="btn btn-success btn-small" type="button" href="{{ route('pages.edit', $page->id) }}">
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
              <h3 class="text-center">There are no pages in the {{ $section->name }} section.</h3>
              <img src="{{ asset('storage/images/admin/no-pages-error.jpg') }}" class="center-block" alt="">
            </div>
          @endunless
        </div>
      </div>
    </div>
  @endforeach

  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Misc Pages</h3>
    </div>
    <div class="box-body">
      <div class="table-responsive">
        @unless ($misc_pages->isEmpty())
        <table class="table table-hover">
          <thead>
            <tr>
              <th>Name</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
          @foreach ($misc_pages as $page)
            <tr>
              <td>{{ $page->name }}</td>
              <td>
                <div class="btn-group">
                  <a class="btn btn-success btn-small" type="button" href="{{ route('pages.edit', $page->id) }}">
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
            <h3 class="text-center">There are no pages here.</h3>
            <img src="{{ asset('storage/images/admin/no-pages-error.jpg') }}" class="center-block" alt="">
          </div>
        @endunless
      </div>
    </div>
  </div>

@endsection
