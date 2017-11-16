@extends('adminlte::page')

@section('content_header')
    <div class="pull-right">
        @if (auth()->user()->can('create page'))
        <a href="{{ route('pages.create') }}" class="btn btn-primary">
            <i class="fa fa-plus"></i> Add Page
        </a>
        @endif
    </div>
    <h1>All Pages</h1>
    <br>
@stop

@section('content')
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">All Pages</h3>
        <div class="box-tools">
            {{ $pages->links('vendor.pagination.small-default') }}
        </div>
    </div>
    <div class="box-body">
        <div class="table-responsive">
            @unless ($pages->isEmpty())
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Body</th>
                        <th>Banner Image</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($pages as $page)
                    <tr>
                        <td>{{ $page->id }}</td>
                        <td>{{ $page->title }}</td>
                        <td>{{ str_limit($page->body, 100) }}</td>
                        @if ($page->image)
                        <td><a href="{{ asset($page->image) }}" class="btn btn-primary" target="_blank">View</a></td>
                        @else
                        <td><a href="{{ route('pages.edit', $page) }}" class="btn btn-info">Upload Page Image</a></td>
                        @endif
                        <td>
                            <div class="btn-group">
                                <a class="btn btn-primary btn-small" type="button" href="{{ route('showPage', $page) }}">
                                    <i class="fa fa-eye"></i>
                                </a>
                                @if (auth()->user()->can('edit page'))
                                <a class="btn btn-success btn-small" type="button" href="{{ route('pages.edit', $page) }}">
                                    <i class="fa fa-pencil"></i>
                                </a>
                                @endif
                                @if (auth()->user()->can('delete page'))
                                <a class="btn btn-danger btn-small" type="button" id="delete-{{$page->id}}">
                                    <i class="fa fa-trash"></i>
                                </a>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @if (auth()->user()->can('delete page'))
                    <form action="{{ route('pages.destroy', $page) }}" method="POST" id="delete-page-{{$page->id}}">
                        {{csrf_field()}}
                        {{method_field('DELETE')}}
                    </form>
                        @push('scripts-after')
                            <script>
                                $('#delete-{{$page->id}}').on('click', function(){
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
                                        document.getElementById('delete-page-{{$page->id}}').submit();
                                    });
                                });
                            </script>
                        @endpush
                    @endif
                    @endforeach
                </tbody>
            </table>
            @else
                <div class="box__content">
                    <h3 class="text-center">You haven't added any pages. :(</h3>
                    <img src="{{ asset('storage/images/admin/no-pages-error.jpg') }}" class="center-block" alt="">
                </div>
            @endunless
        </div>
    </div>
    @unless($pages->isEmpty())
    <div class="box-footer">
        {{ $pages->links('vendor.pagination.small-default') }}
    </div>
    @endunless
</div>
@endsection


