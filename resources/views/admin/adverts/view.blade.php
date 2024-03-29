@extends('adminlte::page')

@section('content_header')
    <h1>{{ $advert->name }}</h1>
@endsection

@section("content")

  <a href="{{ route('adverts.index') }}">
    <button type="button" class="btn btn-primary">Back</button>
  </a><br><br>

  <form action="">
    <h5>Date Search</h5>
    <div class="input-group">
      <div class="input-group-addon">
        <i class="fa fa-calendar"></i>
      </div>
      <input type="text" class="form-control pull-right daterange" id="reservation" name="dates" value="{{ $start_date }} - {{ $end_date }}">
    </div>
    <br>
    <button class="btn btn-primary">Search</button>
    <a href="{{ route('adverts.show', $advert) }}">
      <button type="button" class="btn btn-info">Reset</button>
    </a>
  </form>

  <br>

  <div class="callout callout-info">
    <h4>Advert Information</h4>

    <p>Type: <strong>{{ strtoupper($advert->type) }}</strong></p>
    <p>Cost: <strong>
      @if($advert->type == "cpc")
        &pound;{{ $advert->cpc }} per click
      @elseif($advert->type == "tenancy")
        &pound;{{ $advert->tenancy_price }}
      @endif
    </strong></p>
  </div>

  <br>

  <div class="row">

  	<div class="col-md-3 col-sm-6 col-xs-12">
  		<div class="info-box bg-aqua">
  	    <span class="info-box-icon"><i class="fa fa-eye"></i></span>

  	    <div class="info-box-content">
  	      <span class="info-box-text">Impressions</span>
  	      <span class="info-box-number">{{ $impressions }}</span>

  	      <div class="progress">
  	        <div class="progress-bar" style="width: 70%"></div>
  	      </div>
          <span class="progress-description">
            {{ date("jS M", strtotime($start_date)) }} to
            {{ date("jS M", strtotime($end_date)) }}
          </span>
  	    </div>
  	    <!-- /.info-box-content -->
  	  </div>
  	</div>

    <div class="col-md-3 col-sm-6 col-xs-12">
  		<div class="info-box bg-aqua">
  	    <span class="info-box-icon"><i class="fa fa-binoculars"></i></span>

  	    <div class="info-box-content">
  	      <span class="info-box-text">Unique Impressions</span>
  	      <span class="info-box-number">{{ $unique_impressions }}</span>

  	      <div class="progress">
  	        <div class="progress-bar" style="width: 70%"></div>
  	      </div>
          <span class="progress-description">
            {{ date("jS M", strtotime($start_date)) }} to
            {{ date("jS M", strtotime($end_date)) }}
          </span>
  	    </div>
  	    <!-- /.info-box-content -->
  	  </div>
  	</div>

  	<div class="col-md-3 col-sm-6 col-xs-12">
  		<div class="info-box bg-aqua">
  	    <span class="info-box-icon"><i class="fa fa-mouse-pointer"></i></span>

  	    <div class="info-box-content">
  	      <span class="info-box-text">Clicks</span>
  	      <span class="info-box-number">{{ $clicks }}</span>

  	      <div class="progress">
  	        <div class="progress-bar" style="width: 70%"></div>
  	      </div>
          <span class="progress-description">
            {{ date("jS M", strtotime($start_date)) }} to
            {{ date("jS M", strtotime($end_date)) }}
          </span>
  	    </div>
  	    <!-- /.info-box-content -->
  	  </div>
  	</div>

  </div>

  <div class="row">

  	<div class="col-md-3 col-sm-6 col-xs-12">
  		<div class="info-box bg-maroon">
  	    <span class="info-box-icon"><i class="fa fa-gbp"></i></span>

  	    <div class="info-box-content">
  	      <span class="info-box-text">Revenue</span>
  	      <span class="info-box-number">
            @if($advert->type == "cpc")
              &pound;{{ $clicks * $advert->cpc }}
            @elseif($advert->type == "tenancy")
              &pound;{{ $advert->tenancy_price }}
            @endif
          </span>

  	      <div class="progress">
  	        <div class="progress-bar" style="width: 70%"></div>
  	      </div>
          <span class="progress-description">
            {{ date("jS M", strtotime($start_date)) }} to
            {{ date("jS M", strtotime($end_date)) }}
          </span>
  	    </div>
  	    <!-- /.info-box-content -->
  	  </div>
  	</div>

  	<div class="col-md-3 col-sm-6 col-xs-12">
  		<div class="info-box bg-maroon">
  	    <span class="info-box-icon"><i class="fa fa-rocket"></i></span>

  	    <div class="info-box-content">
  	      <span class="info-box-text">Click-through Rate</span>
  	      <span class="info-box-number">{{ $click_rate }}%</span>

  	      <div class="progress">
  	        <div class="progress-bar" style="width: 70%"></div>
  	      </div>
          <span class="progress-description">
            {{ date("jS M", strtotime($start_date)) }} to
            {{ date("jS M", strtotime($end_date)) }}
          </span>
  	    </div>
  	    <!-- /.info-box-content -->
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

@endsection
