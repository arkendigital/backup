@extends('adminlte::page')

@section('content_header')
    <h1>{{ $page->name }} - Update Widget Ordering</h1>
@endsection

@section('content')

<form action="{{ route('page-widgets.order', $page->id) }}" method="POST" role="form">
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
              <th>Widget Name</th>
            </tr>
          </thead>
          <tbody id="sortable">
            @foreach($page->getWidgets() as $widget)
              <tr>
                <td>{{ $widget->order }}</td>
                <td>{{ $widget->widget->name }}</td>
                <input type="hidden" name="order[]" value="{{ $widget->id }}">
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>

    </div>
  </div>

  <div class="box-footer">
      <button type="submit" class="btn btn-primary">Update Order</button>

      <a href="{{ route("pages.edit", $page->id) }}">
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

