@extends('adminlte::page')

@section('content_header')
    <div class="pull-right">
        @if (auth()->user()->can('create article'))
            <a href="{{ route('support-articles.create') }}" class="btn btn-primary">
                <i class="fa fa-plus"></i> Add Support Article
            </a>
        @endif
    </div>
    <h1>All Support Articles</h1>
    <br>
@stop

@section('content')
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">All Support Articles</h3>
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

                        @if ($article->image)
                            <td><a href="{{ asset($article->image) }}" class="btn btn-primary">View Image</a></td>
                        @else
                            <td><a href="{{ route('support-articles.edit', $article) }}" class="btn btn-info">Upload Image</a></td>
                        @endif
                        <td>
                            <div class="btn-group">
                                <a class="btn btn-primary btn-small" type="button" target="_blank" href="{{route('show-support-article', $article)}}">
                                    <i class="fa fa-eye"></i>
                                </a>

                                @if (auth()->user()->can('edit article'))
                                <a class="btn btn-success btn-small" type="button" href="{{ route('support-articles.edit', $article->id) }}">
                                    <i class="fa fa-pencil"></i>
                                </a>
                                @endif
                                @if (auth()->user()->can('delete article'))
                                    <form action="{{ route('support-articles.destroy', $article->id) }}" method="POST" id="delete-article-{{$article->id}}" style="float:left;">
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
            <h3 class="text-center">You haven't published any support articles. :(</h3>
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
