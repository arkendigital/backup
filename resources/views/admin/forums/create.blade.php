@extends('adminlte::page')

@section('content_header')
@endsection


@section('content')
<form action="{{ route('forums.store') }}" method="POST" role="form">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-solid">
                <div class="box-header with-border">
                    <i class="fa fa-file pull-right"></i>
                    <h3 class="box-title">Create Forum</h3>
                </div>

                <div class="box-body">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="icon">Forum Icon</label>
                        <input type="text" class="form-control" id="icon" name="icon" placeholder="Font Awesome Icon (without fa)">
                    </div>

                    <div class="form-group">
                        <label for="name">Forum Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Forum Name">
                    </div>

                    <div class="form-group">
                        <label for="description">Forum Description</label>
                        <textarea name="description" id="description" class="form-control" rows="3" required="required"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="name">Category</label>
                        <select name="category_id" id="category_id" class="form-control">
                            @foreach ($categories as $id => $name)
                                <option value="{{$id}}">{{$name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="name">Parent Forum</label>
                        <select name="parent" id="parent" class="form-control">
                            <option value="0" selected>No Parent</option>
                            @foreach ($forums as $id => $name)
                                <option value="{{$id}}">{{$name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="name">Forum Position</label>
                        <input type="number" class="form-control" id="position" name="position" placeholder="Forum Position">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="box box-solid">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Roles</h3>
                    </div>
                    <div class="box-body">
                        <p>Select all roles who can view this forum.</p>
                        <div class="col-md-3">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" id="select_all">
                                    <strong>Select All</strong>
                                </label>
                            </div>
                        </div>
                        @foreach ($roles as $role)
                        <div class="col-md-3">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" id="roles[]" name="roles[]" value="{{$role->name}}">
                                     {{$role->name}}
                                </label>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-footer">
                    <button type="submit" class="btn btn-block btn-primary">Save Forum</button>
                </div>
            </div>
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

@endsection
