@extends('adminlte::page')

@section('content_header')
  <div class="pull-right"><a href="{{ route('cache.clear') }}" class="btn btn-danger">Clear Cache</a></div>
  <h1>Actuaries.Online <small>Administration System</small></h1>
@endsection

@section("content")

    <div class="row">
        <div class="col-md-3">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Exam Survey</h3>
                </div>
                <div class="box-body">

                    <a class="btn btn-primary" href="{{ route("export.exam-survey") }}">Download Data</a>
                    <a class="btn btn-info" href="{{ route("upload.exam-survey") }}">Upload Data</a>

                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Salary Survey</h3>
                </div>
                <div class="box-body">

                    <a class="btn btn-primary" href="{{ route("export.salary-survey") }}">Download Data</a>
                    <a class="btn btn-info" href="{{ route("upload.salary-survey") }}">Upload Data</a>

                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Sitemap</h3>
                </div>
                <div class="box-body">

                    <a class="btn btn-primary" href="{{ url("/generate-xml-sitemap") }}">Regenerate Sitemap</a>

                </div>
            </div>
        </div>
    </div>

@stop
