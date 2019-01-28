@extends('adminlte::page')

@section('content_header')
    <div class="pull-right">
        @if (auth()->user()->can('create article'))
            <a href="{{ route('articles.categories.create') }}" class="btn btn-primary">
                <i class="fa fa-plus"></i> Add Article Category
            </a>
        @endif
    </div>
    <h1>All Article Categories</h1>
    <br>
@stop

@section('content')
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">All Article Categoriess</h3>
        <div class="box-tools">
            {{ $categories->links('vendor.pagination.small-default') }}
        </div>
    </div>
    <div class="box-body">
        @unless ($categories->isEmpty())
        <div class="table-responsive">
            <table class="table table-hover" id="datatable-nopaging">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                        <td>
                            <div class="btn-group">
                                @if (auth()->user()->can('edit article'))
                                <a class="btn btn-success btn-small" type="button" href="{{ route('articles.categories.edit', $category) }}">
                                    <i class="fa fa-pencil"></i>
                                </a>
                                @endif
                                @if (auth()->user()->can('delete article'))
                                    <form action="{{ route('articles.categories.destroy', $category) }}" method="POST" id="delete-article-{{$category->id}}" style="float:left;">
                                        {{csrf_field()}}
                                        {{method_field('DELETE')}}
                                        <button class="btn btn-danger btn-small" type="submit">  <i class="fa fa-trash"></i> </button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="box-content">
            <p>You have not created any article categories.</p>
            @if (auth()->user()->can('create article'))
                <a href="{{ route('articles.categories.create') }}" class="btn btn-primary">
                    <i class="fa fa-plus"></i> Add Article Category
                </a>
            @endif
        </div>
        @endunless
    </div>
    @unless ($categories->isEmpty())
    <div class="box-footer">
        {{ $categories->links('vendor.pagination.small-default') }}
    </div>
    @endunless
</div>
@endsection
