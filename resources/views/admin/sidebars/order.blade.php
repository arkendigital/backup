@extends('adminlte::page')

@section('content_header')
    <h1>{{ $sidebar->name }} Sidebar - Update Ordering</h1>
@endsection

@section('content')

<form action="{{ route('sidebars.order', compact('sidebar')) }}" method="POST" role="form">
  {{ csrf_field() }}
  {{ method_field("PATCH") }}

  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Sidebar Information</h3>
    </div>
    <div class="box-body">

      <div class="table-responsive">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>Order</th>
              <th>Link</th>
            </tr>
          </thead>
          <tbody id="sortable">
            @foreach($sidebar->getItems() as $item)
              <tr>
                <td>{{ $item->order }}</td>
                <td>{{ $item->text }}</td>
                <input type="hidden" name="order[]" value="{{ $item->sidebar_item_id }}">
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>

    </div>
  </div>

  <div class="box-footer">
      <button type="submit" class="btn btn-primary">Update Order</button>

      <a href="{{ route("sidebars.edit", compact("sidebar")) }}">
        <button type="button" class="btn btn-info">Back</button>
      </a>
  </div>

</form>

@push("scripts-after")
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#sortable" ).sortable();
    $( "#sortable" ).disableSelection();
  } );
  </script>
@endpush

@endsection
