@extends('adminlte::page')

@section('content_header')
    <h1>Box Item {{ $item->title }}</h1>
@endsection

@section('content')

<form action="{{ route('box-items.update', compact('item')) }}" method="POST" role="form">
  {{ csrf_field() }}
  {{ method_field("PATCH") }}

  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Box Information</h3>
    </div>
    <div class="box-body">

      <div class="form-group">
        <label for="title">Title</label>
        @if($errors->has("title"))
          <p>{{ $errors->first("title") }}</p>
        @endif
        <input type="text" class="form-control" name="title" id="title" placeholder="Enter a title for this box..." value="{{ $item->title }}">
      </div>

      <div class="form-group">
        <label for="link">Link (URL)</label>
        <input type="text" class="form-control" name="link" id="link" placeholder="Enter a link for this box..." value="{{ $item->link }}">
      </div>

      <div class="form-group">
        <label for="external">Open in a new tab?&nbsp;</label>
        <input type="checkbox" name="external" id="external" @if(session()->exists("errors")) @if(old("external")) checked="checked" @endif @else @if($item->external) checked="checked" @endif @endif>
      </div>

    </div>
  </div>

  <div class="box-footer">
      <button type="submit" class="btn btn-primary">Update Box</button>
  </div>

</form>

@endsection
