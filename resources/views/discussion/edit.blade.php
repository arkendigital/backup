@extends("layouts.master")

@section("content")

  <div class="discussion-top-bar"></div>

  <div class="discussion-container">
    <div class="discussion-container-inner">

      <h1 class="discussion-page-title">Discussion <span>{{ $category->name }}</span></h1>

      <a class="discussion-edit-button" href="{{ route("discussion.view", compact("category", "discussion")) }}">Back</a>

      <div class="clear"></div>

      @include("discussion.sidebar")

      <div class="discussion-view-container">
        <div class="discussion-view">
          <div class="discussion-view-thread">

            <form action="{{ route("discussion.update", compact("category", "discussion")) }}" method="POST" class="discussion-edit-form" enctype="multipart/form-data">

              {{ csrf_field() }}
              {{ method_field("PATCH") }}

              <div class="discussion-edit-form-item">
                <label for="name">Name / Title</label>
                @if($errors->has("name"))
                  <p class="discussion-edit-form-item-error">You must enter a name / title</p>
                @endif
                <input type="text" name="name" id="name" value="{{ $discussion->name }}">
              </div>

              <div class="discussion-edit-form-item">
                <div class="file-upload-container file-upload" data-id="image" id="upload-container">
                  <i class="fas fa-cloud-upload-alt fa-2x"></i>
                  <span>Upload an image from your device</span>
                </div>

                <input type="file" id="image" name="image" class="file-upload-input" data-id="upload-container" style="display:none;">
              </div>

              <div class="discussion-edit-form-item">
                <label for="subject">Subject</label>
                @if($errors->has("subject"))
                  <p class="discussion-edit-form-item-error">Please enter a subject</p>
                @endif
                <input type="text" name="subject" id="subject" value="{{ $discussion->subject }}">
              </div>

              <div class="discussion-edit-form-item">
                <label for="content">Content</label>
                @if($errors->has("content"))
                  <p class="discussion-edit-form-item-error">Please enter some content</p>
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
