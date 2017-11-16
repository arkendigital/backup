@extends('adminlte::page')

@section('content_header')
    <div class="pull-right">
        @if (auth()->user()->can('create user'))
        <a href="{{ route('users.create') }}" class="btn btn-primary">
            <i class="fa fa-plus"></i> Add User
        </a>
        @endif
    </div>
    <h1>All Users</h1>
    <br>
@stop

@section('content')
    <ul class="pager">
        <li><a href="{{route('users.index') }}">ALL</a></li>
        @foreach ($letters as $letter)
            @if (preg_match("/^[a-zA-Z0-9]/", $letter))
                <li>
                    <a href="{{route('users.index') }}?filter={{$letter}}">{{ucfirst($letter)}}</a>
                </li>
            @endif
        @endforeach
    </ul>

<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">All Users</h3>
        <div class="box-tools">
            {{$users->appends(['filter' => request()->filter])->links('vendor.pagination.small-default')}}
        </div>
    </div>
    <div class="box-body">
        @unless ($users->isEmpty())
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Full Name</th>
                        <th>Email Address</th>
                        <th>Role</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @foreach ($user->getRoleNames() as $role)
                                {{ $role }}
                            @endforeach
                        </td>
                        <td>
                            <div class="btn-group">
                                <a class="btn btn-primary btn-small" type="button" href="{{ route('users.show', $user) }}">
                                    <i class="fa fa-eye"></i>
                                </a>
                                @if (auth()->user()->can('edit user'))
                                <a class="btn btn-success btn-small" type="button" href="{{ route('users.edit', $user) }}">
                                    <i class="fa fa-pencil"></i>
                                </a>
                                @endif
                                @if (auth()->user()->can('delete user'))
                                @if ($user->id !== auth()->user()->id)
                                <a class="btn btn-danger btn-small" type="button" id="delete-{{$user->id}}">
                                    <i class="fa fa-trash"></i>
                                </a>
                                @endif
                                @endif
                            </div>
                        </td>
                    </tr>
                    @if (auth()->user()->can('delete user'))
                    <form action="{{ route('users.destroy', $user) }}" method="POST" id="delete-user-{{$user->id}}">
                        {{csrf_field()}}
                        {{method_field('DELETE')}}
                    </form>
                    @push('scripts-after')
                        <script>
                            $('#delete-{{$user->id}}').on('click', function(){
                                swal({
                                    title: "Are you sure?",
                                    text: "This item will be deleted and cannot reverted!",
                                    type: "warning",
                                    showCancelButton: true,
                                    confirmButtonColor: "#DD6B55",
                                    confirmButtonText: "Yes, delete it!",
                                    closeOnConfirm: false
                                },
                                function(){
                                    document.getElementById('delete-user-{{$user->id}}').submit();
                                });
                            });
                        </script>
                    @endpush
                    @endif
                @endforeach
                </tbody>
            </table>
        </div>
        @else
         <div class="box__content">
            <h3 class="text-center">You haven't got any users?! :(</h3>
            <img src="{{ asset('storage/images/admin/no-users-error.jpg') }}" class="center-block" alt="">
            <div style="position:relative;height:0;"><iframe src="https://www.youtube.com/embed/kffacxfA7G4?rel=0&amp;controls=0&amp;showinfo=0?ecver=2&autoplay=true" width="480" height="360" frameborder="0" style="position:absolute;width:100%;height:100%;left:0" allowfullscreen></iframe></div>
            <p class="text-center"><small>Really you should never be able to see this, so we're also going to play a song on this page.</small></p>
        </div>
        @endunless
    </div>
    @unless($users->isEmpty())
    <div class="box-footer">
        {{$users->appends(['filter' => request()->filter])->links('vendor.pagination.small-default')}}
    </div>
    @endunless
</div>
@endsection
