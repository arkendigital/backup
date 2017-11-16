@extends('adminlte::page')

@section('content_header')
    <div class="pull-right">
        @if (auth()->user()->can('create forum category'))
        <a type="button" class="btn btn-primary" href="{{ route('categories.create') }}"><i class="fa fa-plus-circle"></i> Create Category</a>
        @endif
        @if (auth()->user()->can('create forum'))
        <a type="button" class="btn btn-primary" href="{{ route('forums.create') }}"><i class="fa fa-plus-circle"></i> Create Forum</a>
        @endif
    </div>
    <h1>
        <small>Forum Manager</small>
    </h1>
@endsection


@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box box-solid">
            <div class="box-header">
                <h3 class="box-title">All Forums</h3>
                <i class="fa fa-comments-o pull-right"></i>
            </div><!-- /.box-header -->
            <div class="box-body no-padding">
            @unless ( $categories->isEmpty() )
                <table class="table table-striped" id="">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Description</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($categories as $category)
                        <tr class="info">
                            <td><strong>{{$category->name}}</strong></td>
                            <td></td>
                            <td>
                                <div class="btn-group">
                                    @if (auth()->user()->can('edit forum category'))
                                    <a class="btn btn-success btn-small" type="button" href="{{ route('categories.edit', $category) }}">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    @endif
                                    @if (auth()->user()->can('delete forum category'))
                                    <a class="btn btn-danger btn-small" type="button" id="delete-cat-{{$category->id}}">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @if (auth()->user()->can('delete forum category'))
                        <form action="{{ route('categories.destroy', $category) }}" method="POST" id="delete-category-{{$category->id}}">
                            {{csrf_field()}}
                            {{method_field('DELETE')}}
                        </form>
                        @push('scripts-after')
                            <script>
                                $('#delete-cat-{{$category->id}}').on('click', function(){
                                    swal({
                                        title: "Deleting a Category WILL Delete all child forums",
                                        text: "This action CANNOT be reverted.",
                                        type: "warning",
                                        showCancelButton: true,
                                        confirmButtonColor: "#DD6B55",
                                        confirmButtonText: "I am absolutely sure I want to delete this category",
                                        closeOnConfirm: false
                                    },
                                    function(){
                                        axios.delete('{{ route('categories.destroy', $category) }}')
                                            .then(({data}) => {
                                                location.reload();
                                            }).catch(error => {
                                                location.reload();
                                            });
                                        // document.getElementById('delete-category-{{$category->id}}').submit();
                                    });
                                });
                            </script>
                        @endpush
                        @endif
                        @foreach ($category->forums as $forum)
                        @if ($forum->parent == 0)
                        <tr>
                            <td>&emsp;<a href="{{ route('forumDisplay', $forum) }}" title="View {{ $forum->name }}"><strong>{!!$forum->name!!}</strong></a></td>
                            <td>{{str_limit($forum->description,60)}}</td>
                            <td>
                                <div class="btn-group">
                                    <a class="btn btn-primary btn-small" type="button" href="{{ route('forums.resync', $forum) }}" data-toggle="tooltip" title="Resync Last Post Info">
                                        <i class="fa fa-refresh"></i>
                                    </a>
                                    @if (auth()->user()->can('edit forum'))
                                    <a class="btn btn-success btn-small" type="button" href="{{ route('forums.edit', $forum) }}">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    @endif
                                    @if (auth()->user()->can('delete forum'))
                                    <a class="btn btn-danger btn-small" type="button" id="delete-{{$forum->id}}">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @if (auth()->user()->can('delete forum'))
                        <form action="{{ route('forums.destroy', $forum) }}" method="POST" id="delete-forum-{{$forum->id}}">
                            {{csrf_field()}}
                            {{method_field('DELETE')}}
                        </form>
                        @push('scripts-after')
                            <script>
                                $('#delete-{{$forum->id}}').on('click', function(){
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
                                      axios.delete('{{ route('forums.destroy', $forum) }}')
                                                .then(({data}) => {
                                                    location.reload();
                                                }).catch(error => {
                                                    location.reload();
                                                });
                                        // document.getElementById('delete-forum-{{$forum->id}}').submit();
                                    });
                                });
                            </script>
                        @endpush
                        @endif
                        @endif
                        @endforeach
                    @endforeach
                    </tbody>
                </table>
            @else
                <div class="box__content">
                    <h3 class="text-center">You haven't added any forums. :(</h3>
                    <img src="{{ asset('storage/images/admin/no-forums-error.jpg') }}" class="center-block" alt="">
                </div>
            @endunless
            </div>
            @unless($categories->isEmpty())
            <div class="box-footer clearfix">
                {{ $categories->links('vendor.pagination.small-default') }}
            </div>
            @endunless
        </div>
    </div>
</div>
@endsection
