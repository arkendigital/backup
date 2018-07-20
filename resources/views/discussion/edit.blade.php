@extends("layouts.master")

@section("content")

  <div class="discussion-top-bar"></div>

  <div class="discussion-container">
    <div class="discussion-container-inner">

      <h1 class="discussion-page-title">Discussion <span>Edit</span></h1>

      <a class="discussion-edit-button" href="{{ route("discussion.view", compact("category", "discussion")) }}">Back</a>

      <div class="clear"></div>

      @include("discussion.sidebar")

      <div class="discussion-view-container">
        <div class="discussion-view">
          <div class="discussion-view-thread">

            <form action="{{ route("discussion.update", compact("category", "discussion")) }}" method="POST" class="discussion-edit-form" enctype="multipart/form-data">

              {{ csrf_field() }}
              {{ method_field("PATCH") }}

              @if($errors->any())<div class="discussion-edit-form-item">
                {{-- <label for="name">Name / Title</label> --}}
                <p class="discussion-edit-form-item-error">There are some validation issues with updating this discussion, please see below</p>
              </div>
              @endif

              <div class="discussion-edit-form-item">
                <label for="name">Name / Title</label>
                @if($errors->has("name"))
                  <p class="discussion-edit-form-item-error">{{ $errors->first("name") }}</p>
                @endif
                <input type="text" name="name" id="name" value="{{ session()->exists("errors") ? old("name") : $discussion->name }}">
              </div>

              <div class="discussion-edit-form-item">
                <div class="file-upload-container file-upload" data-id="image" id="upload-container">
                  <i class="fas fa-cloud-upload-alt fa-2x"></i>
                  <span>Upload an image from your device</span>
                </div>

                <input type="file" id="image" name="image" class="file-upload-input" data-id="upload-container" style="display:none;">
              </div>

              <div class="discussion-edit-form-item">
                <label>Category</label>
                @if($errors->has("category_id"))
                    <p class="discussion-edit-form-item-error">{{ $errors->first("category_id") }}</p>
                @endif
                <select name="category_id">
                  <option value="">Select a category to add this discussion to</option>
                  @foreach($categories as $cat)
                    <option value="{{ $cat->id }}"
                        @if(session()->exists("errors"))
                            @if(old("category_id") == $cat->id) selected @endif
                        @else
                            @if($discussion->category_id == $cat->id) selected @endif
                        @endif
                    >{{ $cat->name }}</option>
                  @endforeach
                </select>
              </div>

              <div class="discussion-edit-form-item">
                <label for="excerpt">Short description about your thread <small>(optional)</small></label>
                @if($errors->has("excerpt"))
                  <p class="discussion-edit-form-item-error">{{ $errors->first("excerpt") }}</p>
                @endif
                <input type="text" name="excerpt" id="excerpt" value="{{ session()->exists("errors") ? old("excerpt") : $discussion->excerpt }}">
              </div>

              <div class="discussion-edit-form-item">
                <label for="content">Content</label>
                @if($errors->has("content"))
                  <p class="discussion-edit-form-item-error">{{ $errors->first("content") }}</p>
                @endif
                <textarea name="content" id="content" class="discussion-edit-content-editor">{{ $discussion->content }}</textarea>
              </div>

              <button type="submit" class="discussion-edit-form-submit">Update</a>

            </form>

          </div><!-- /.discussion-view-thread -->
        </div><!-- /.discussion-view -->

      </div><!-- /.discussion-view-container -->

    </div><!-- /.discussion-container-inner -->
  </div><!-- ./discussion-container -->

@endsection
