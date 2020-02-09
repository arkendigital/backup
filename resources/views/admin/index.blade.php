@extends('adminlte::page')

@section('content_header')
  <div class="pull-right"><a href="{{ route('cache.clear') }}" class="btn btn-danger">Clear Cache</a></div>
  <h1>actuariesonline.com <small>Administration System</small></h1>
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
                    <h3 class="box-title">Jobs Stats</h3>
                </div>
                <div class="box-body">
                    <form action="{{ route("export.jobs-stats") }}" style="float:left;">
                        <div class="input-group" style="margin-bottom:20px;">
                          <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                          </div>
                          <input type="text" class="form-control pull-right daterange" id="reservation" name="dates" value="{{ \Carbon\Carbon::now()->startOfMonth()->format('d-m-Y') }} - {{ \Carbon\Carbon::now()->endOfMonth()->format('d-m-Y') }}">
                        </div>
                        <button class="btn btn-primary" type="submit">Download Selected Range</button>
                        <a class="btn btn-info" href="{{ route("export.jobs-stats") }}">Download {{ date('F') }} Data</a>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
@push("scripts-after")
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <script>
        $(function() {
          $(".daterange").daterangepicker({
            locale: {
              format: 'DD-MM-Y'
            }
          });
        });
    </script>
@endpush

@stop

@push("scripts-after")
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <script>
    $(function() {
      $(".daterange").daterangepicker({
        locale: {
          format: 'DD-MM-Y'
        }
      });
    });
    </script>
  @endpush

