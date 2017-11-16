@extends('adminlte::page')

@section('content_header')
    <h1>Edit Page &mdash; {{ $page->title }}</h1>
@endsection

@section('content')

<div class="box" style="text-align: center; background-size: cover; background-position: center; background-image: url({{asset($page->image)}});min-height: 300px;">

</div>

<div class="box box-primary">
    <form action="{{ route('pages.update', $page) }}" method="POST" role="form" enctype="multipart/form-data">
        <div class="box-body">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}

            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" name="title" id="title" value="{{ $page->title }}" placeholder="Title">
            </div>

            <div class="form-group">
                <label for="body">Description</label>
                <textarea class="form-control" name="body" id="body" placeholder="Page Description" rows="5">{{ $page->body }}</textarea>
            </div>

            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" name="image" id="image" class="form-control" value="{{ $page->image }}">
            </div>

            <div class="checkbox">
                <label>
                    <input type="checkbox" name="live" id="live" @if ($page->live) checked @endif"> Live?
                </label>
            </div>

        </div>
        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>
@endsection
