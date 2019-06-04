@extends('adminlte::page')

@section('content_header')
  <h1>All Replies</h1>
  <br>
@stop

@section('content')
<div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">All Replies</h3>
    </div>
    <div class="box-body">
        <div class="table-responsive">
            @unless ($replies->isEmpty())
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Discussion</th>
                        <th>Username</th>
                        <th>Reply</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($replies as $reply)
                    <tr>
                        <td>{{ $reply->id }}</td>
                        <td>{{ $reply->discussion->name }}</td>
                        <td>{{ $reply->user->username }}</td>
                        <td style="width: 50%;">{{ $reply->content }}</td>
                        <td>
                          <div class="btn-group">
                            <a class="btn btn-success btn-small" type="button" href="{{ route('discussion-replies-edit', [$discussion->id,$reply->id]) }}">
                              <i class="fa fa-pencil"></i>
                            </a>

                            <a class="btn btn-danger btn-small" type="button" onclick="document.getElementById('remove-reply-{{ $reply->id }}').submit()">
                              <i class="fa fa-trash"></i>
                            </a>

                            <form action="{{ route("discussion-replies-delete", [$discussion->id,$reply->id]) }}" method="POST" id="remove-reply-{{ $reply->id }}">
                                {{ csrf_field() }}
                                {{ method_field("DELETE") }}
                            </form>
                          </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
              <div class="box__content">
                <h3 class="text-center">You haven't added any replies.</h3>
                <img src="{{ asset('storage/images/admin/no-pages-error.jpg') }}" class="center-block" alt="">
              </div>
            @endunless
        </div>
    </div>
</div>
@endsection
