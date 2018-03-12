@extends('adminlte::page')

@section('content_header')
  <h1>All Slides</h1>
  <br>
@stop

@section('content')


  @foreach($groups as $group)
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">{{ ucwords($group->slug) }}</h3>
        <a href="{{ route('slides.create') }}?slug={{ $group->slug }}" class="btn btn-primary pull-right">
          <i class="fa fa-plus"></i> Add Slide
        </a>
      </div>
      <div class="box-body">
        <div class="table-responsive">
          @unless ($group->getSlides($group->slug)->isEmpty())
          <table class="table table-hover">
            <thead>
              <tr>
                <th>Name</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
            @foreach ($group->getSlides($group->slug) as $slide)
              <tr>
                <td>{{ $slide->title }}</td>
                <td>
                  <div class="btn-group">
                    <a class="btn btn-success btn-small" type="button" href="{{ route('slides.edit', $slide) }}">
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
              <h3 class="text-center">There are no slides yet, why not create one?</h3>
              <img src="{{ asset('storage/images/admin/no-pages-error.jpg') }}" class="center-block" alt="">
            </div>
          @endunless
        </div>
      </div>
    </div>
  @endforeach

@endsection
