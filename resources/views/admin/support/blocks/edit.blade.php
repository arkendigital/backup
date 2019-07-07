@extends('adminlte::page')

@section('content_header')
    <h1>Support Block - {{ $supportBlock->title }}</h1>
@endsection

@section('content')

<form action="{{ route('support-blocks.update', $supportBlock) }}" method="POST" role="form" id="blockUpdateForm" enctype="multipart/form-data">
  {{ csrf_field() }}
  {{ method_field("PATCH") }}

  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Support Block Information</h3>
    </div>
    <div class="box-body">

      <div class="form-group">
        <label for="title">Title</label>
        <input type="text" class="form-control" name="title" id="title" placeholder="Enter a title for this support block..." value="{{ $supportBlock->title }}">
      </div>

      <div class="form-group">
        <label for="subtitle">Subtitle</label>
        <input type="text" class="form-control" name="subtitle" id="subtitle" placeholder="Enter some subtitle for this support block..." value="{{ $supportBlock->subtitle }}">
      </div>
      <div class="form-group">
        <label for="image">Image</label>
        @if($supportBlock->image != "")
          <p><img src="{{ asset(env('LOCAL_URL').$supportBlock->image) }}" alt="" title="" style="max-height: 100px;"></p>
        @endif
        <input type="file" class="form-control" name="image" id="image">
      </div>

    </div>
  </div>
</form>

  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Support Block Items</h3>
      <a class="btn btn-primary pull-right" href="{{ route("support-block-items.create") }}?block_id={{ $supportBlock->id }}" style="margin-left:15px;">Add Sub Block</a>
      {{-- <a class="btn btn-primary pull-right" href="{{ route("box-items.order", compact("group")) }}">Update Order</a> --}}
    </div>
    <div class="box-body">

      @if(!$supportBlock->items->isEmpty())
        <table class="table table-hover">
          <thead>
            <tr>
              <th>Title</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach($supportBlock->items as $item)
              <tr>
                <td>{{ $item->title }}</td>
                <td>
                  <div class="btn-group">

                    <a class="btn btn-success btn-small" type="button" href="{{ route('support-block-items.edit', $item->id) }}?block_id={{ $supportBlock->id }}">
                      <i class="fa fa-pencil"></i>
                    </a>

                    <a class="btn btn-danger btn-small" type="button" onclick="document.getElementById('remove-{{ $item->id }}').submit()">
                      <i class="fa fa-trash"></i>
                    </a>

                    <form action="{{ route("support-block-items.destroy", $item) }}" method="POST" id="remove-{{ $item->id }}">
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
        There are no items in this block yet.
      @endif

    </div>
  </div>

  <div class="box-footer">
      <button type="button" class="btn btn-primary" onclick="document.getElementById('blockUpdateForm').submit(); return false;">Update</button>
  </div>



@endsection
