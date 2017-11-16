@extends('adminlte::page')

@section('content_header')
          <h1>
            <small>Forum Manager</small>
            <small>&gt; Edit Forum</small>
            <small>&gt; {{ $forum->name }}</small>
          </h1>
@endsection

@section('content')

@unless ( $forum->children->isEmpty() )
<div class="row">
    <div class="col-md-12">
        <div class="box box-solid">
            <div class="box-header">
                <h3 class="box-title">Child Forums of {{$forum->name}}</h3>
                <i class="fa fa-comments-o pull-right"></i>
            </div><!-- /.box-header -->
            <div class="box-body no-padding">
                <table class="table table-striped" id="">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Description</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($forum->children as $child)
                        <tr>
                            <td>&emsp;<a href="{{ route('forumDisplay', $child) }}" title="View {{ $child->name }}"><strong>{!!$child->name!!}</strong></a></td>
                            <td>{{str_limit($child->description,60)}}</td>
                            <td>
                                <div class="btn-group">
                                    <a class="btn btn-primary btn-small" type="button" href="{{ route('forums.resync', $forum) }}" data-toggle="tooltip" title="Resync Last Post Info">
                                        <i class="fa fa-refresh"></i>
                                    </a>
                                    @if (auth()->user()->can('edit forum'))
                                    <a class="btn btn-success btn-small" type="button" href="{{ route('forums.edit', $child) }}">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    @endif
                                    @if (auth()->user()->can('delete forum'))
                                    <a class="btn btn-danger btn-small" type="button" id="delete-{{$child->id}}">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @if (auth()->user()->can('delete forum'))
                        <form action="{{ route('forums.destroy', $child) }}" method="POST" id="delete-forum-{{$child->id}}">
                            {{csrf_field()}}
                            {{method_field('DELETE')}}
                        </form>
                        @push('scripts-after')
                            <script>
                                $('#delete-{{$child->id}}').on('click', function(){
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
                                        document.getElementById('delete-forum-{{$child->id}}').submit();
                                    });
                                });
                            </script>
                        @endpush
                        @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endunless

<form action="{{ route('forums.update', $forum) }}" method="POST" role="form">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-solid">
                <div class="box-header with-border">
                    <i class="fa fa-th pull-right"></i>
                    <h3 class="box-title">Forum Manager</h3>
                </div>

                <div class="box-body">
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}
                    <div class="form-group">
                        <label for="icon">Forum Icon</label>
                        <input type="text" class="form-control" id="icon" name="icon" placeholder="Font Awesome Icon (without fa)" value="{{ $forum->icon }}">
                    </div>

                    <div class="form-group">
                        <label for="name" class="control-label">Name</label>
                        <input type="text" class="form-control input-lg" id="name" name="name" placeholder="Forum Name" value="{{ $forum->name }}">
                    </div>

                    <div class="form-group">
                        <label for="description" class="control-label">Description</label>
                        <input type="text" class="form-control input-lg" id="description" name="description" placeholder="Forum Description" value="{{ $forum->description }}">
                    </div>

                    <div class="form-group">
                        <label for="name">Category</label>
                        <select name="category_id" id="category_id" class="form-control">
                            @foreach ($categories as $id => $name)

                                <option value="{{$id}}" @if ($forum->category_id == $id) selected @endif>{{$name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="name">Parent Forum</label>
                        <select name="parent" id="parent" class="form-control">
                            <option value="0">No Parent</option>
                            @foreach ($forums as $id => $name)
                                <option value="{{$id}}" @if ($forum->parent == $id) selected @endif>{{$name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="position" class="control-label">Position</label>
                        <input type="number" class="form-control input-lg" id="position" name="position" placeholder="Forum Position" value="{{ $forum->position }}">
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
                                    <input type="checkbox" id="roles[]" name="roles[]" value="{{$role->name}}"
                                    @if (in_array($role->name, $forum->roles)) checked @endif>
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
