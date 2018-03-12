@extends('adminlte::page')

@section('content_header')
    <h1>Box Group "{{ $group->name }}" - Update Ordering</h1>
@endsection

@section('content')

<form action="{{ route('box-items.order', compact('group')) }}" method="POST" role="form">
  {{ csrf_field() }}
  {{ method_field("PATCH") }}

  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Sidebar Information</h3>
    </div>
    <div class="box-body">

      <div class="table-responsive">
        <table class="table table-hover" id="datatable-nopaging">
          <thead>
            <tr>
              <th>Order</th>
              <th>Link</th>
            </tr>
          </thead>
          <tbody id="sortable">
            @foreach($group->getItems() as $item)
              <tr>
                <td>{{ $item->order }}</td>
                <td>{{ $item->title }}</td>
                <input type="hidden" name="order[]" value="{{ $item->id }}">
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>

    </div>
  </div>

  <div class="box-footer">
      <button type="submit" class="btn btn-primary">Update Order</button>

      <a href="{{ route("box-groups.edit", compact("group")) }}">
        <button type="button" class="btn btn-info">Back</button>
      </a>
  </div>

</form>

@push("scripts-after")
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#sortable" ).sortable();
    $( "#sortable" ).disableSelection();
  } );
  </script>
@endpush

@endsection
