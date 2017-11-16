@extends('adminlte::page')

@section('content_header')
    <h1>Change Password</h1>
@endsection

@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Reset Your Password</h3>
    </div>
    <form action="{{ route('adminResetPassword') }}" method="POST" role="form">
        <div class="box-body">
            {{ csrf_field() }}

            <div class="form-group">
                <label for="password">Old Password</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Password">
            </div>

            <div class="form-group">
                <label for="new_password">New Password</label>
                <input type="password" class="form-control" name="new_password" id="new_password" placeholder="Password">
            </div>

            <div class="form-group">
                <label for="new_password_confirmation">New Password (Confirm)</label>
                <input type="password" class="form-control" name="new_password_confirmation" id="new_password_confirmation" placeholder="Password">
            </div>

        </div>
        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>
@endsection
