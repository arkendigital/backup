@extends('adminlte::page')

@section('content_header')
    <h1>Create Advert</h1>
@endsection

@section('content')

<div class="box box-primary">
    <form action="{{ route('adverts.store') }}" method="POST" role="form" enctype="multipart/form-data">
        <div class="box-body">
            {{ csrf_field() }}
            {{ method_field("POST") }}

            <div class="form-group">
              <label for="name">Advert Name</label>
              @if ($errors->has("name"))
                <p class="text-danger">{{ $errors->first("name") }}</p>
              @endif
              <input type="text" class="form-control" name="name" id="name" value="{{ old("name") }}" placeholder="Enter name of advert...">
            </div>

            <div class="form-group">
              <label for="url">Advert Link (URL)</label>
              @if($errors->has("url"))
                <p class="text-danger">{{ $errors->first("url") }}</p>
              @endif
              <input type="text" class="form-control" name="url" id="url" value="{{ old("url") }}" placeholder="Enter link (URL) for advert...">
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
                    <option value="cpc">Cost Per Click</option>
                    <option value="tenancy">Tenancy (One off payment for a certain time)</option>
                </select>
            </div>

            <div class="form-group">
                <label for="tenancy_price">Tenancy Price</label>
                @if($errors->has("tenancy_price"))
                    <p class="text-danger">{{ $errors->first("tenancy_price") }}</p>
                @endif
                <input type="text" class="form-control" name="tenancy_price" id="tenancy_price" placeholder="Enter full cost of ad tenancy">
            </div>

            <div class="form-group">
                <label for="cpc">Cost per Click (CPC)</label>
                @if($errors->has("cpc"))
                    <p class="text-danger">{{ $errors->first("cpc") }}</p>
                @endif
                <input type="text" class="form-control" name="cpc" id="cpc" placeholder="Enter cost per click">
            </div>

            <div class="form-group">
                <label for="start_date">Start Date</label>
                <input type="text" class="form-control datepicker" name="start_date" id="start_date" autocomplete="off">
            </div>

            <div class="form-group">
                <label for="end_date">End Date</label>
                <input type="text" class="form-control datepicker" name="end_date" id="end_date" autocomplete="off">
            </div>

            <div class="form-group">
                <label for="active">Active &nbsp;</label>
                <input type="checkbox" class="" name="active" id="active">
            </div>

        </div>
        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Create Advert</button>
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
