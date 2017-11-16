@extends('adminlte::page')

@section('content_header')
    <h1>Edit Article &mdash; {{ $article->title }}</h1>
@endsection

@section('content')

<div class="box" style="text-align: center; background-size: cover; background-position: center; background-image: url({{asset($article->image)}});min-height: 400px;">

</div>

<div class="box box-primary">
    <form action="{{ route('articles.update', $article) }}" method="POST" role="form" enctype="multipart/form-data">
        <div class="box-body">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}

            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" name="title" id="title" value="{{ $article->title }}" placeholder="Title">
            </div>

            <div class="form-group">
                <label for="body">Body</label>
                <textarea class="form-control" name="body" id="body" placeholder="Article Body" rows="5">{{ $article->body }}</textarea>
            </div>

            <div class="form-group">
                <label for="category_id">Category</label>
                <select name="category_id" id="category_id" class="form-control" required="required">
                    <option value="1">Uncategorized</option>
                </select>
            </div>

            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" name="image" id="image" class="form-control">
            </div>

        </div>
        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>
@endsection
