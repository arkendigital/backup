@extends('adminlte::page')

@section('content_header')
  <div class="pull-right"><a href="{{ route('cache.clear') }}" class="btn btn-danger">Clear Cache</a></div>
  <h1>Actuaries.Online <small>Administration System</small></h1>
@endsection

@section("content")

    <p><a class="btn btn-primary" href="{{ route("export.exam-survey") }}">Download Exam Survery Data</a></p>
    <p><a class="btn btn-success" href="{{ route("export.salary-survey") }}">Download Salary Survery Data</a></p>

@stop
