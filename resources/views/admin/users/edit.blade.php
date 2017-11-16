@extends('adminlte::page')

@section('content_header')
    <h1>{{ $user->name }} <small>Edit User</small></h1>
@endsection

@section('content')
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Edit User</h3>
    </div>
    <form action="{{ route('users.update', $user) }}" method="POST" role="form" autocomplete="off">
        <div class="box-body">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}

            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="Username" value="{{ $user->name }}">
            </div>

            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="Email Address" value="{{ $user->email }}">
            </div>

            <div class="form-group">
                <label for="role">User Role</label>
                <select name="role" id="role" class="form-control" required="required">
                    @foreach ($roles as $role)
                        <option value="{{ $role->name }}" @if ($user->getRoleNames()[0] == $role->name) selected @endif>{{ $role->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="checkbox">
                <label>
                    <input type="hidden" name="verified" id="verified" value="0">
                    <input type="checkbox" name="verified" id="verified" @if ($user->verified == 1) checked="checked" value="1"@endif> Verified
                </label>
            </div>
        </div>
        <div class="box-footer">
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
</div>
@endsection
