@extends('adminlte::page')

@section('content_header')
    <h1>Edit Role &mdash; {{ $role->name }}</h1>
@endsection

@section('content')
@if (($role->name != 'Member') && ($role->name != 'Guest'))
<form action="{{ route('roles.update', $role) }}" method="POST" role="form" enctype="multipart/form-data">
    <div class="box box-primary">
        <div class="box-body">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name" id="name" value="{{ $role->name }}" placeholder="Title">
            </div>
        </div>
    </div>

    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Elevated Permissions</h3>
        </div>
        <div class="box-body">
            <p>Please note that these are <strong>Elevated</strong> Permissions - A user will always be able to edit and (soft) delete thier own content; for example Forum Posts, Forum Threads and Files.</p>
            <div class="col-md-3">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" id="select_all">
                        <strong>Select All</strong>
                    </label>
                </div>
            </div>
            @foreach ($permissions as $permission)
            <div class="col-md-3">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" id="permissions[]" name="permissions[]" value="{{$permission->name}}"
                        @if ($role->hasPermissionTo($permission->name)) checked @endif
                        >
                         {{ucwords($permission->name)}}
                    </label>
                </div>
            </div>
            @endforeach
        </div>
        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
</form>
@push('scripts-after')
<script>
$('#select_all').change(function() {
    var checkboxes = $(this).closest('form').find(':checkbox');
    checkboxes.prop('checked', $(this).is(':checked'));
});
</script>
@endpush
@else
<div class="alert alert-warning">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <p><strong>I'm sorry, I can't let you do that, Jeff.</strong></p>
    <p>{{ $role->name }} is a <strong>base</strong> permission level and as such cannot be updated.</p>
    <p>Plus, imagine the carnage you could cause if you <em><strong>accidentally</strong></em> set all members permissions to elevated!</p>
</div>
@endif
@endsection
