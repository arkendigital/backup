@extends('adminlte::page')

@section('content_header')
  <div class="pull-right">
    <a href="{{ route('adverts.create') }}" class="btn btn-primary">
      <i class="fa fa-plus"></i> Create Advert
    </a>
  </div>
  <h1>All Adverts</h1>
  <br>
@stop

@section('content')
<div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">All Adverts</h3>
    </div>
    <div class="box-body">
        <div class="table-responsive">
            @unless ($adverts->isEmpty())
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Job Title</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($adverts as $advert)
                    <tr>
                        <td>{{ $advert->name }}</td>
                        <td>
                          <div class="btn-group">
                            <a class="btn btn-primary btn-small" type="button" href="{{ route('adverts.show', $advert) }}">
                              <i class="fa fa-eye"></i>
                            </a>
                            <a class="btn btn-success btn-small" type="button" href="{{ route('adverts.edit', $advert) }}">
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
                <h3 class="text-center">You haven't added any adverts.</h3>
                <img src="{{ asset('storage/images/admin/no-pages-error.jpg') }}" class="center-block" alt="">
              </div>
            @endunless
        </div>
    </div>
</div>
@endsection
