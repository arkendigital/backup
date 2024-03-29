@extends('adminlte::page')

@section('content_header')
    <div class="pull-right">
        @if (auth()->user()->can('create article'))
            <a href="{{ route('articles.create') }}" class="btn btn-primary">
                <i class="fa fa-plus"></i> Add Article
            </a>
        @endif
    </div>
    <h1>All Articles</h1>
    <br>
@stop

@section('content')
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">All Articles</h3>
        <div class="box-tools">
            {{ $articles->links('vendor.pagination.small-default') }}
        </div>
    </div>
    <div class="box-body">
        @unless ($articles->isEmpty())
        <div class="table-responsive">
            <table class="table table-hover" id="datatable-nopaging">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Body</th>
                        <th>Current</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($articles as $article)
                    <tr>
                        <td>{{ $article->id }}</td>
                        <td>{{ $article->title }}</td>
                        <td>{!! str_limit(strip_tags($article->body), 100) !!}</td>
                        <td>
                            <form action="{{ route('article.setCurrentDiscussion', $article) }}" method="POST" style="float:left;">
                                {{csrf_field()}}
                                <button class="btn btn-warning btn-small" type="submit">Set Current</button>
                            </form>
                        </td>
                        @if ($article->image)
                            <td><a href="{{ asset($article->image) }}" class="btn btn-primary">View Image</a></td>
                        @else
                            <td><a href="{{ route('articles.edit', $article) }}" class="btn btn-info">Upload Image</a></td>
                        @endif
                        <td>
                            <div class="btn-group">
                                <a class="btn btn-primary btn-small" type="button" target="_blank" href="{{route('showArticle', $article)}}">
                                    <i class="fa fa-eye"></i>
                                </a>
                                @if (auth()->user()->can('edit article'))
                                <a class="btn btn-success btn-small" type="button" href="{{ route('articles.edit', $article) }}">
                                    <i class="fa fa-pencil"></i>
                                </a>
                                @endif
                                @if (auth()->user()->can('delete article'))
                                    <form action="{{ route('articles.destroy', $article) }}" method="POST" id="delete-article-{{$article->id}}" style="float:left;">
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
        <div class="box__content">
            <h3 class="text-center">You haven't published any articles. :(</h3>
            <img src="{{ asset('storage/images/admin/no-articles-error.jpg') }}" class="center-block" alt="">
        </div>
        @endunless
    </div>
    @unless ($articles->isEmpty())
    <div class="box-footer">
        {{ $articles->links('vendor.pagination.small-default') }}
    </div>
    @endunless
</div>
@endsection
