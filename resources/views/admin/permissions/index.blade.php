@extends('adminlte::page')

@section('content_header')
    <div class="pull-right">
        <a href="{{ route('permissions.create') }}" class="btn btn-primary">
            <i class="fa fa-plus"></i> Add Permission
        </a>
    </div>
    <h1>All Permissions</h1>
    <br>
@stop

@section('content')
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">All Permissions</h3>
    </div>
    <div class="box-body">
        @unless ($permissions->isEmpty())
        <div class="table-responsive">
            <table class="table table-hover" id="datatable-nopaging">
                <thead>
                    <tr>
                        <th width="10%">ID</th>
                        <th width="70%">Name</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($permissions as $permission)
                    <tr>
                        <td width="10%">{{ $permission->id }}</td>
                        <td width="70%">{{ $permission->name }}</td>
                    </tr>
                    <form action="{{ route('permissions.destroy', $permission) }}" method="POST" id="delete-permission-{{$permission->id}}">
                        {{csrf_field()}}
                        {{method_field('DELETE')}}
                    </form>
                        @push('scripts-after')
                            <script>
                                $('#delete-{{$permission->id}}').on('click', function(){
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
                                        document.getElementById('delete-permission-{{$permission->id}}').submit();
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
            <h3 class="text-center">You haven't published any permissions. :(</h3>
            <img src="{{ asset('storage/images/admin/no-roles-error.jpg') }}" class="center-block" alt="">
        </div>
        @endunless
    </div>
</div>
@endsection
