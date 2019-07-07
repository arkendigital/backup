@extends('adminlte::page')

@section('content_header')
    <h1>Support Block Item - {{ $item->title }}</h1>
@endsection

@section('content')

<form action="{{ route('support-block-items.update', $item->id) }}" method="POST" role="form" id="blockItemUpdateForm" enctype="multipart/form-data">
  {{ csrf_field() }}
  {{ method_field("PATCH") }}
  
  <input type="hidden" name="support_block_id" value="{{ $block->id }}">
  
  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Support Block Item Information</h3>
    </div>
    <div class="box-body">

      <div class="form-group">
        <label for="title">Title</label>
        <input type="text" class="form-control" name="title" id="title" placeholder="Enter a title for this support block item..." value="{{ $item->title }}">
      </div>

      <div class="form-group">
        <label for="subtitle">Subtitle</label>
        <input type="text" class="form-control" name="subtitle" id="subtitle" placeholder="Enter some subtitle for this support block item..." value="{{ $item->subtitle }}">
      </div>
      <div class="form-group">
        <label for="name">Support artilce to show</label>
        <select id="page_id" class="form-control" name="support_article_id">
          <option value="">Select a support article...</option>
          @foreach($supportArticles as $supportArticle)
              <option value="{{ $supportArticle->id }}" {{ ($supportArticle->id==$item->support_article_id)? 'selected' : '' }}>{{ $supportArticle->title }}</option>
          @endforeach
        </select>
      </div>

      <div class="form-group">
        <label for="image">Image</label>
        @if($item->image != "")
          <p><img src="{{ asset(env('LOCAL_URL').$item->image) }}" alt="" title="" style="max-height: 100px;"></p>
        @endif
        <input type="file" class="form-control" name="image" id="image">
      </div>

    </div>
  </div>
</form>

  <div class="box-footer">
      <button type="button" class="btn btn-primary" onclick="document.getElementById('blockItemUpdateForm').submit(); return false;">Update</button>
  </div>



@endsection
