@extends('adminlte::page')

@section('content_header')
  <h1>All Discussions</h1>
  <br>
@stop

@section('content')
<div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">All Discussions</h3>
    </div>
    <div class="box-body">
        <div class="table-responsive">
            @unless ($discussions->isEmpty())
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($discussions as $discussion)
                    <tr>
                        <td>{{ $discussion->id }}</td>
                        <td>{{ $discussion->name }}</td>
                        <td>{{ $discussion->slug }}</td>
                        <td>
                          <div class="btn-group">
                            {{-- <a class="btn btn-success btn-small" type="button" href="{{ route('discussion.edit', $discussion) }}">
                              <i class="fa fa-pencil"></i>
                            </a> --}}
                            <a class="btn btn-success btn-small" type="button" href="{{ route('discussion.edit', $discussion) }}">
                              Comments
                            </a>

                            {{-- <a class="btn btn-danger btn-small" type="button" onclick="document.getElementById('remove-discussion-{{ $discussion->id }}').submit()">
                              <i class="fa fa-trash"></i>
                            </a>

                            <form action="{{ route("discussion.destroy", $discussion) }}" method="POST" id="remove-discussion-{{ $discussion->id }}">
                                {{ csrf_field() }}
                                {{ method_field("DELETE") }}
                            </form> --}}
                          </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
              <div class="box__content">
                <h3 class="text-center">You haven't added any discussions.</h3>
                <img src="{{ asset('storage/images/admin/no-pages-error.jpg') }}" class="center-block" alt="">
              </div>
            @endunless
        </div>
    </div>
</div>
@endsection
