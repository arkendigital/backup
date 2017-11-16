@extends('adminlte::page')

@section('content_header')
    <div class="pull-right"><a href="{{ route('cache.clear') }}" class="btn btn-danger btn-lg">Clear Cache</a></div>
    <h1>GameFront.com <small>Online Publishing System</small></h1>
@endsection

@section('content')
@if ($activeReports)
<div class="col-md-12">
    <div class="alert alert-warning">
        <p>
            <strong>{{ auth()->user()->name }}, there are active reports awaiting your attention!</strong>
            <a href="{{ route('reports.index') }}">Click here to address them.</a>
        </p>
    </div>
</div>
@endif

<div class="col-md-6">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">HOW TO UPLOAD A FILE</h3>
        </div>
        <div class="panel-body">
            <div style="position:relative;height:0;padding-bottom:75.0%"><iframe src="https://www.youtube.com/embed/Xt_pD01-VAU?rel=0&amp;controls=0&amp;showinfo=0?ecver=2" width="480" height="360" frameborder="0" style="position:absolute;width:100%;height:100%;left:0" allowfullscreen></iframe></div>
        </div>
    </div>
</div>


<div class="col-md-6">
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">GameFront Plays</h3>
    </div>
    <div class="panel-body">
        <div style="position:relative;height:0;padding-bottom:56.25%"><iframe src="https://www.youtube.com/embed/_igVY4KJ1p8?rel=0&amp;controls=0&amp;showinfo=0?ecver=2" width="640" height="360" frameborder="0" style="position:absolute;width:100%;height:100%;left:0" allowfullscreen></iframe></div>
    </div>
</div>
</div>

@stop
