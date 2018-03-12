@extends('adminlte::page')

@section('content_header')
    <h1>{{ $sidebar->name }} Sidebar</h1>
@endsection

@section('content')

<form action="{{ route('sidebars.update', compact('sidebar')) }}" method="POST" role="form" enctype="multipart/form-data">
  {{ csrf_field() }}
  {{ method_field("PATCH") }}

  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Sidebar Information</h3>
    </div>
    <div class="box-body">

      <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" name="name" id="name" placeholder="Enter a name for this sidebar..." value="{{ $sidebar->name }}">
      </div>

    </div>
  </div>

  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Sidebar Links</h3>
    </div>
    <div class="box-body">

      <div class="form-group">
        <label for="name">Select which pages you want to add to this sidebar</label>
        <select id="sidebar-page-select" class="form-control">
          <option value="">Select a page...</option>
          @foreach($sections as $section)
            <option value="" disabled>- {{ $section->name }}</option>
            @foreach($section->pages as $page)
              <option value="{{ $page->id }}">-- {{ $page->name }}</option>
            @endforeach
          @endforeach
        </select>
        {{-- <button type="button" class="btn btn-success" style="margin-top: 5px;" id="add-page-to-sidebar">Add page</button> --}}
      </div>

      <div class="form-group">
        <label for="name">Or add a custom link</label>
        <input type="text" id="custom-link-text" placeholder="Enter visual text for link..." class="form-control">
        <input type="text" id="custom-link-url" placeholder="Enter link URL..." class="form-control">
        <button type="button" class="btn btn-info" style="margin-top: 5px;" id="add-custom-link">Add link</button>
      </div>

      <div class="form-group">
        <h4>Current Pages and Links</h4>
        @foreach($sidebar->getItems() as $item)
          <p id="sidebar-item-{{ $item->sidebar_item_id }}">{{ $item->text }} - <a style="cursor: pointer;" class="remove-item" data-sidebar-item-id="{{ $item->sidebar_item_id }}">Remove</a></p>
        @endforeach
        <div id="new-pages"></div>
      </div>

    </div>
  </div>

  <div class="box-footer">
      <button type="submit" class="btn btn-primary">Update Sidebar</button>

      <a href="{{ route("sidebars.order", compact("sidebar")) }}">
        <button type="button" class="btn btn-info">Update Links Order</button>
      </a>
  </div>

</form>

@push("scripts-after")
  <script>
  $(function() {
    $("#sidebar-page-select").change(function() {

      /**
      * Get the ID of the new page.
      *
      */
      var page_id = $(this).val();
      var csrf = $("meta[name=csrf_field]").attr("content");

      /**
      * Add this page ID to the hidden field.
      *
      */
      $.ajax({
        type: "POST",
        url: "/api/add-page-to-sidebar",
        data: {
          method_field:"POST",
          page_id:page_id,
          sidebar_id:{{ $sidebar->id }}
        },
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response){
          console.log("SUCCESS");
          console.log(response);
        },
        error: function(response) {
          console.log("FAIL");
          console.log(response);
        }
      });

      /**
      * Add a text visual of the page so the user knows it's been added.
      *
      */
      var page_name = $("#sidebar-page-select option:selected").text();

      $("#new-pages").append("<p>"+page_name+"</p>");

      /**
      * Change back to default value.
      *
      */
      $(this).val("");

    });

    $(".remove-item").click(function() {

      /**
      * Get the sidebar id id.
      *
      */
      var sidebar_item_id = $(this).attr("data-sidebar-item-id");

      /**
      * Remove the text visual.
      *
      */
      $("#sidebar-item-"+sidebar_item_id).hide();

      /**
      * Remove the page id from hidden field.
      *
      */
      $.ajax({
        type: "POST",
        url: "/api/remove-item-from-sidebar",
        data: {
          method_field:"POST",
          sidebar_item_id:sidebar_item_id
        },
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response){
          console.log("SUCCESS");
          console.log(response);
        },
        error: function(response) {
          console.log("FAIL");
          console.log(response);
        }
      });

    });








    $("#add-custom-link").click(function() {

      /**
      * Get the information.
      *
      */
      var text = $("#custom-link-text").val();
      var url = $("#custom-link-url").val();

      /**
      * Add the link to the database.
      *
      */
      $.ajax({
        type: "POST",
        url: "/api/add-link-to-sidebar",
        data: {
          method_field:"POST",
          link_text:text,
          link_url:url,
          sidebar_id:{{ $sidebar->id }}
        },
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response){
          console.log("SUCCESS");
          console.log(response);
        },
        error: function(response) {
          console.log("FAIL");
          console.log(response);
        }
      });

      /**
      * Remove values from fields.
      *
      */
      $("#custom-link-text").val("");
      $("#custom-link-url").val("");

      $("#new-pages").append("<p>"+text+"</p>");

    });
  });
  </script>
@endpush

@endsection
