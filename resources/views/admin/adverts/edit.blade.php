@extends('adminlte::page')

@section('content_header')
    <h1>Edit Advert - {{ $advert->name }}</h1>
@endsection

@section('content')

<div class="box box-primary">
    <form action="{{ route('adverts.update', compact("advert")) }}" method="POST" role="form" enctype="multipart/form-data">
        <div class="box-body">
            {{ csrf_field() }}
            {{ method_field("PATCH") }}

            <div class="form-group">
              <label for="name">Advert Name</label>
              @if($errors->has("name"))
                <p class="text-danger">{{ $errors->first("name") }}</p>
              @endif
              <input type="text" class="form-control" name="name" id="name" value="{{ $advert->name }}" placeholder="Enter name of advert...">
            </div>

            <div class="form-group">
              <label for="url">Advert Link (URL)</label>
              @if($errors->has("url"))
                <p class="text-danger">{{ $errors->first("url") }}</p>
              @endif
              <input type="text" class="form-control" name="url" id="url" value="{{ $advert->url }}" placeholder="Enter link (URL) for advert...">
            </div>

            <div class="form-group">
              <label for="image">Advert Image</label>
              @if($errors->has("image"))
                <p class="text-danger">{{ $errors->first("image") }}</p>
              @endif
              <input type="file" class="form-control" name="image" id="image">
            </div>

            <div class="form-group">
              <label for="type">Ad Cost Type</label>
              @if($errors->has("type"))
                <p class="text-danger">{{ $errors->first("type") }}</p>
              @endif
              <select class="form-control" name="type">
                <option value="">Please select...</option>
                <option value="cpc" @if($advert->type == "cpc") selected @endif>Cost Per Click</option>
                <option value="tenancy" @if($advert->type == "tenancy") selected @endif>Tenancy (One off payment for a certain time)</option>
              </select>
            </div>

            <div class="form-group">
              <label for="tenancy_price">Tenancy Price</label>
              @if($errors->has("tenancy_price"))
                <p class="text-danger">{{ $errors->first("tenancy_price") }}</p>
              @endif
              <input type="text" class="form-control" name="tenancy_price" id="tenancy_price" value="{{ $advert->tenancy_price }}" placeholder="Enter full cost of ad tenancy">
            </div>

            <div class="form-group">
              <label for="cpc">Cost per Click (CPC)</label>
              @if($errors->has("cpc"))
                <p class="text-danger">{{ $errors->first("cpc") }}</p>
              @endif
              <input type="text" class="form-control" name="cpc" id="cpc" value="{{ $advert->cpc }}" placeholder="Enter cost per click">
            </div>

            <div class="form-group">
              <label for="start_date">Start Date</label>
              <input type="text" class="form-control datepicker" name="start_date" id="start_date" autocomplete="off" value="{{ session()->exists("errors") ? old("start_date") : $advert->start_date }}">
            </div>

            <div class="form-group">
              <label for="end_date">End Date</label>
              <input type="text" class="form-control datepicker" name="end_date" id="end_date" autocomplete="off" value="{{ session()->exists("errors") ? old("end_date") : $advert->end_date }}">
            </div>

            <div class="form-group">
              <label for="active">Active &nbsp;</label>
              <input type="checkbox" class="" name="active" id="active" @if(session()->exists("errors")) @if(old("active")) checked="checked" @endif @else @if($advert->active) checked="checked" @endif @endif>
            </div>

        </div>
        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Update Advert</button>
        </div>
    </form>
</div>

@push("scripts-after")
  <script src="https://cdnjs.cloudflare.com/ajax/libs/datepicker/0.6.5/datepicker.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datepicker/0.6.5/datepicker.min.css">
  <script>
  $(function() {
    $(".datepicker").datepicker({
      format: "dd-mm-yyyy",
      startDate: "{{ date("d-m-Y") }}"
    });
  });
  </script>
@endpush

@endsection
