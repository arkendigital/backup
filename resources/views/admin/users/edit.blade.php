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
                <label for="phone_number">Phone Number</label>
                <input type="text" class="form-control" name="phone_number" id="phone_number" placeholder="Phone Number" value="{{ $user->phone_number }}">
            </div>

            <div class="form-group">
                <label for="arn">Actuarial Reference Number</label>
                <input type="text" class="form-control" name="arn" id="arn" placeholder="Actuarial Reference Number" value="{{ $user->arn }}">
            </div>

            <div class="form-group">
                <label for="current_role">Current Role</label>
                <input type="text" class="form-control" name="current_role" id="current_role" placeholder="Current Role" value="{{ $user->current_role }}">
            </div>

            <div class="form-group">
                <label for="company_name">Company</label>
                <input type="text" class="form-control" name="company_name" id="company_name" placeholder="Company Name" value="{{ $user->company_name }}">
            </div>

            <div class="form-group">
                <label for="location">Location</label>
                <input type="text" class="form-control" name="location" id="location" placeholder="Location" value="{{ $user->location }}">
            </div>

            <div class="form-group">
                <label for="experience">Years of Experience</label>
                <input type="text" class="form-control" name="experience" id="experience" placeholder="experience" value="{{ $user->experience }}">
            </div>

            <div class="checkbox">
                <label>
                    <input type="hidden" name="internal_marketing" id="internal_marketing" value="0">
                    <input type="checkbox" name="internal_marketing" id="internal_marketing" @if ($user->internal_marketing == 1) checked="checked" value="1"@endif> Internal Marketing
                </label>
            </div>

            <div class="checkbox">
                <label>
                    <input type="hidden" name="external_marketing" id="external_marketing" value="0">
                    <input type="checkbox" name="external_marketing" id="external_marketing" @if ($user->external_marketing == 1) checked="checked" value="1"@endif> External Marketing
                </label>
            </div>

            <div class="form-group">
                <label for="role">User Role</label>
                <select name="role" id="role" class="form-control" required="required">
                    @foreach ($roles as $role)
                        <option value="{{ $role->name }}" @if (optional($user->getRoleNames())[0] == $role->name) selected @endif>{{ $role->name }}</option>
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
