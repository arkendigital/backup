@extends('adminlte::page')
@section('content_header')
<h1>Viewing Report</h1>
@endsection
@section('content')
<div class="col-md-9">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">{{ $report->title }}</h3>
        </div>
    </div>
    <div class="box box-info">
        <div class="box-body">
            <div class="alert alert-warning">
                <strong>This report is in relation to the following post</strong>
            </div>
            <blockquote>
                <div class="media">
                    <div class="media-left">
                        <img src="{{ $report->getContent()->profile->avatar }}" class="media-object" style="width:60px">
                    </div>
                    <div class="media-body">
                        <h3 class="media-heading"><a href="{{ route('users.show', $report->getContent()->profile->user) }}" title="">{{  $report->getContent()->profile->display_name }}</a></h3>
                        <p>{!! $report->getContent()->content !!}</p>
                    </div>
                </div>
            </blockquote>
        </div>
        <div class="box-footer">
            {{ $report->getContent()->created_at->diffForHumans() }}
        </div>
    </div>
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Comments on this report</h3>
        </div>
    </div>
    @foreach ($report->posts as $post)
    <div class="box @if ($post->user->isStaff()) box-danger @else box-default @endif">
        <div class="box-body">
            <blockquote>
                <div class="media">
                    <div class="media-left">
                        <img src="{{ $post->user->profile->avatar }}" class="media-object" style="width:60px">
                    </div>
                    <div class="media-body">
                        <h3 class="media-heading"><a href="{{ route('users.show', $post->user) }}" title="">{{ $post->user->profile->display_name }}</a></h3>
                        <p>{{ $post->content }}</p>
                    </div>
                </div>
            </blockquote>
        </div>
        <div class="box-footer">
            {{ $post->created_at->diffForHumans() }}
        </div>
    </div>
    @endforeach
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Add note to report</h3>
        </div>
        <div class="box-body">
            <form action="{{ route('reports.posts.store', $report) }}" method="POST" class="form">
                {{ csrf_field() }}
                <div class="form-group">
                    <textarea name="content" id="content" class="form-control" placeholder="Comment on Report"></textarea>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Add comment">
                </div>
            </form>
        </div>
    </div>
</div>
<div class="col-md-3">
    <div class="box box-primary">
        <div class="box-header with-border">
            <div class="box-content">
                @if ($report->status == 'closed')
                <p>This report is closed</p>
                @if (auth()->user()->can('open report'))
                <a href="{{ route('reports.claim', $report) }}" class="btn btn-warning btn-block">Claim &amp; Re-open Report</a>
                @endif
                @elseif($report->status == 'claimed')
                <p>This report has been claimed by {{ $report->owner->profile->display_name }}</p>
                @if (auth()->user()->can('close report'))
                <a href="{{ route('reports.close', $report) }}" class="btn btn-danger btn-block">Close Report</a>
                @endif
                @else
                @if (auth()->user()->can('claim report'))
                <a href="{{ route('reports.claim', $report) }}" class="btn btn-success btn-block">
                    Claim Report
                </a>
                @endif
                @endif
            </div>
        </div>
    </div>
</div>
<br>
<div class="container">
    <div class="clear"></div>
</div>
@push('css')
<style media="screen">
blockquote img {
max-width: 150px;
}
.media-object {
    border-radius: 50%;
}
</style>
@endpush
@endsection
