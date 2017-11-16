
@extends('adminlte::page')

@section('content_header')
    <h1>Create New User</h1>
@endsection

@section('content')
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Create New User</h3>
    </div>
    <form action="{{ route('users.store') }}" method="POST" role="form">
        <div class="box-body">
            {{ csrf_field() }}

            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="Username">
            </div>

            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="Email Address">
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Password">
            </div>

            <div class="form-group">
                <label for="role">User Role</label>
                <select name="role" id="role" class="form-control" required="required">
                    @foreach ($roles as $role)
                        <option value="{{ $role->name }}" @if($role->name == 'Member') selected @endif>{{ $role->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="checkbox">
                <label>
                    <input type="checkbox" name="verified" id="verified"> Verified
                </label>
            </div>
        </div>
        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>
@endsection
