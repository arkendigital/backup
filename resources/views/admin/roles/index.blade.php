@extends('adminlte::page')

@section('content_header')
    <div class="pull-right">
        <a href="{{ route('roles.create') }}" class="btn btn-primary">
            <i class="fa fa-plus"></i> Add Role
        </a>
    </div>
    <h1>All Roles</h1>
    <br>
@stop

@section('content')
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">All Roles</h3>
    </div>
    <div class="box-body">
        @unless ($roles->isEmpty())
        <div class="table-responsive">
            <table class="table table-hover" id="datatable-nopaging">
                <thead>
                    <tr>
                        <th width="40%">ID</th>
                        <th width="40%">Name</th>
                        <th width="20%">Actions</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($roles as $role)
                    <tr>
                        <td width="40%">{{ $role->id }}</td>
                        <td width="40%">{{ $role->name }}</td>
                        <td width="20%">
                            <div class="btn-group">
                                @if(auth()->user()->can('edit role'))
                                <a class="btn btn-warning btn-small" type="button" href="{{ route('roles.edit', $role) }}">
                                    <i class="fa fa-key"></i>
                                </a>
                                @endif
                                @if(auth()->user()->can('delete role'))
                                <a class="btn btn-danger btn-small" type="button" id="delete-{{$role->id}}">
                                    <i class="fa fa-trash"></i>
                                </a>
                                @endif
                            </div>
                        </td>
                    </tr>
                    <form action="{{ route('roles.destroy', $role) }}" method="POST" id="delete-role-{{$role->id}}">
                        {{csrf_field()}}
                        {{method_field('DELETE')}}
                    </form>
                        @push('scripts-after')
                            <script>
                                $('#delete-{{$role->id}}').on('click', function(){
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
                                        document.getElementById('delete-role-{{$role->id}}').submit();
                                    });
                                });
                            </script>
                        @endpush
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="box__content">
            <h3 class="text-center">You haven't published any roles. :(</h3>
            <img src="{{ asset('storage/images/admin/no-roles-error.jpg') }}" class="center-block" alt="">
        </div>
        @endunless
    </div>
</div>
@endsection
