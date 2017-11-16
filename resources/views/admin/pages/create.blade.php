@extends('adminlte::page')

@section('content_header')
    <h1>Create New Page</h1>
@endsection

@section('content')
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Create New Page</h3>
    </div>
    <form action="{{ route('pages.store') }}" method="POST" role="form" enctype="multipart/form-data">
        <div class="box-body">
            {{ csrf_field() }}

            <div class="form-group">
                <label for="title">Page Name</label>
                <input type="text" class="form-control" name="title" id="title" placeholder="Page Name">
            </div>

            <div class="form-group">
                <label for="body">Page Body</label>
                <textarea name="body" id="body" rows="5" class="form-control js-editor"></textarea>
            </div>

            <div class="form-group">
                <label for="image">Banner Image</label>
                <input type="file" name="image" id="image" class="form-control">
            </div>

            <div class="checkbox">
                <label>
                    <input type="checkbox" name="live" id="live"> Live?
                </label>
            </div>

        </div>
        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>
@endsection
