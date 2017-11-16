@extends('adminlte::page')

@section('content_header')
    <h1>
        {{ $page->title }}
    </h1>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Page Information</h3>
            </div>
            <div class="box-body">
                <div class="list-group">
                    <div class="list-group-item">
                        <h4 class="list-group-item-heading">Description</h4>
                        <strong class="list-group-item-text">{{ $page->body }}</strong>
                    </div>
                    <div class="list-group-item">
                        <h4 class="list-group-item-heading">Added to GameFront</h4>
                        <strong class="list-group-item-text">{{ $page->created_at->format('d/m/Y') }} ({{ $page->created_at->diffForHumans() }})</strong>
                    </div>
                    <div class="list-group-item">
                        <h4 class="list-group-item-heading">Last Updated</h4>
                        <strong class="list-group-item-text">{{ $page->updated_at->format('d/m/Y') }} ({{ $page->updated_at->diffForHumans() }})</strong>
                    </div>
                    <div class="list-group-item">
                        <h4 class="list-group-item-heading">File Count</h4>
                        <strong class="list-group-item-text">{{ $page->file_count }}</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
