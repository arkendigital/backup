@extends('adminlte::page')

@section('content_header')
    <h1>
        {{ $user->name }}
        <div class="pull-right">
            @if ($user->banned == 1)
            <a class="a btn btn-warning" id="unban-user-{{$user->id}}">Unban User</a>
            @else
            <a class="a btn btn-danger" id="ban-user-{{$user->id}}">Ban User</a>
            @endif
        </div>
    </h1>
@endsection

@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">User Information</h3>
            </div>
            <div class="box-body">
                <div class="list-group">
                    <div class="list-group-item">
                        <h4 class="list-group-item-heading">Email Address</h4>
                        <strong class="list-group-item-text">{{ $user->email }}</strong>
                    </div>
                    <div class="list-group-item">
                        <h4 class="list-group-item-heading">Signed Up</h4>
                        <strong class="list-group-item-text">{{ $user->created_at->format('d/m/Y') }} ({{ $user->created_at->diffForHumans() }})</strong>
                    </div>
                    <div class="list-group-item">
                        <h4 class="list-group-item-heading">Last Updated</h4>
                        <strong class="list-group-item-text">{{ $user->updated_at->format('d/m/Y') }} ({{ $user->updated_at->diffForHumans() }})</strong>
                    </div>
                    <div class="list-group-item">
                        <h4 class="list-group-item-heading">Verified Email</h4>
                        <strong class="list-group-item-text">{{ $user->verified ? 'Yes' : 'No' }}</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">User Notes</h3>
            </div>
            <div class="box-body">
                <div class="list-group">
                    <ul class="list-group">
                        <li class="list-group-item">Banned for being special &mdash; Jeff</li>
                        <li class="list-group-item">Bieber Moded For Live &mdash; FileTrekker</li>
                        <li class="list-group-item">Spamming! &mdash; RadioActiveLobster</li>
                    </ul>
                    <form method="POST" class="form" role="form">
                        <div class="form-group">
                            <label class="sr-only" for="">label</label>
                            <textarea class="form-control"></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<form action="{{ route('users.ban', $user) }}" method="POST" id="ban-{{$user->id}}">
    {{csrf_field()}}
</form>
@push('scripts-after')
    <script>
        $('#ban-user-{{$user->id}}').on('click', function(){
            @if (auth()->user()->id == $user->id)
            swal('Trying to ban yourself? Are you crazy?');
            @else
            swal({
                title: "Are you sure?",
                text: "{{ $user->profile->display_name }} will no longer be able to access the site...",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "{{ $user->profile->display_name }} is very naughty!",
                closeOnConfirm: false
            },
            function(){
                document.getElementById('ban-{{$user->id}}').submit();
            });
            @endif
        });
        $('#unban-user-{{$user->id}}').on('click', function(){
            swal({
                title: "Are you sure?",
                text: "{{ $user->profile->display_name }} will now be able to access the site...",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Unban {{ $user->profile->display_name }}",
                closeOnConfirm: false
            },
            function(){
                document.getElementById('ban-{{$user->id}}').submit();
            });
        });
    </script>
@endpush
@endsection
