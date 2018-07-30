@extends('adminlte::page')

@section('content_header')
    <h1>Box Group - {{ $group->name }}</h1>
@endsection

@section('content')

<form action="{{ route('box-groups.update', compact("group")) }}" method="POST" role="form" enctype="multipart/form-data">
  {{ csrf_field() }}
  {{ method_field("PATCH") }}

  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Box Group Information</h3>
    </div>
    <div class="box-body">

      <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" name="name" id="name" placeholder="Enter a name for this box group..." value="{{ $group->name }}">
      </div>

      <div class="form-group">
        <label for="text">Text</label>
        <input type="text" class="form-control" name="text" id="text" placeholder="Enter some text for this group..." value="{{ $group->text }}">
      </div>

      <div class="form-group">
        <label for="widget_slug">Name</label>
        <select class="form-control" name="widget_slug" id="widget_slug">
          @foreach($widgets as $widget)
            <option value="{{ $widget->slug }}" @if($widget->slug == $group->widget_slug) selected @endif>{{ $widget->name }}</option>
          @endforeach
        </select>
      </div>

      <div class="form-group">
        <label for="image">Image</label>
        @if($group->image_path != "")
          <p><img src="{{ $group->image }}" alt="" title="" style="max-height: 100px;"></p>
        @endif
        <input type="file" class="form-control" name="image" id="image">
      </div>

    </div>
  </div>

  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Group Items</h3>
      <a class="btn btn-primary pull-right" href="{{ route("box-items.create") }}?group_id={{ $group->id }}" style="margin-left:15px;">Add Item</a>
      <a class="btn btn-primary pull-right" href="{{ route("box-items.order", compact("group")) }}">Update Order</a>
    </div>
    <div class="box-body">

      @if(!$group->items->isEmpty())

        <table class="table table-hover">
          <thead>
            <tr>
              <th>Title</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach($group->items as $item)
              <tr>
                <td>{{ $item->title }}</td>
                <td>
                  <div class="btn-group">

                    <a class="btn btn-success btn-small" type="button" href="{{ route('box-items.edit', $item) }}">
                      <i class="fa fa-pencil"></i>
                    </a>

                    <a class="btn btn-danger btn-small" type="button" onclick="document.getElementById('remove-{{ $item->id }}').submit()">
                      <i class="fa fa-trash"></i>
                    </a>

                    <form action="{{ route("box-items.destroy", $item) }}" method="POST" id="remove-{{ $item->id }}">
                        {{ csrf_field() }}
                        {{ method_field("DELETE") }}
                    </form>

                  </div>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      @else
        There are no items in this group yet.
      @endif

    </div>
  </div>

  <div class="box-footer">
      <button type="submit" class="btn btn-primary">Update</button>
  </div>

</form>

@endsection
