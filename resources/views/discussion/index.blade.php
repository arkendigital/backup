@extends("layouts.master")

@section("content")

  <div class="discussion-top-bar"></div>

  <div class="discussion-container">
    <div class="discussion-container-inner">

      <h1 class="discussion-page-title">Discussion <span>{{ isset($category) ? $category->name : "" }}</span></h1>

      <a class="discussion-add-button">Create Discussion</a>

      <div class="clear"></div>

      @include("discussion.sidebar")

      <div class="discussion-list-container margin-bottom--medium">
        <div class="discussion-list">
          @if($discussions->isEmpty())
            <p class="discussion-list-thread-content-title" style="padding: 25px 0 10px 0;">Sorry, we couldn't find any discussions here.</p>
          @else
          @foreach($discussions as $discussion)
            <div class="discussion-list-thread">

              <div class="discussion-list-thread-avatar">
                <img src="{{ $discussion->user->avatar }}" alt="{{ $discussion->user->username }}" title="{{ $discussion->user->username }}">
              </div><!-- /.discussion-list-thread-avatar -->

              <div class="discussion-list-thread-content">
                <a class="discussion-list-thread-content-title" href="/discussion/{{ $discussion->category->slug }}/{{ $discussion->slug }}">{{ $discussion->name }}</a>
                <p class="discussion-list-thread-content-text">{{ $discussion->excerpt }}</p>

                <div class="discussion-list-thread-content-footer">
                  @if($discussion->subject != "")
                    <p class="discussion-list-thread-content-footer-subject">{{ $discussion->subject }}</p>
                  @endif
                  <p class="discussion-list-thread-content-footer-time">{{ $discussion->created_at->diffForHumans() }}</p>
                  <p class="discussion-list-thread-content-footer-user">by {{ $discussion->user->username }}</p>
                </div><!-- /.discussion-list-thread-content-footer -->
              </div><!-- /.discussion-list-thread-content -->

              <div class="discussion-list-reply-count">
                {{ $discussion->reply_count }}
              </div><!-- /.discussion-list-reply-count -->

            </div><!-- /.discussion-list-thread -->
          @endforeach
          @endif
        </div><!-- /.discussion-list -->

        <div class="discussion-pagination">
          {{ $discussions->links() }}
        </div><!-- /.discussion-pagination -->
      </div><!-- /.discussion-list-container -->

    </div><!-- /.discussion-container-inner -->
  </div><!-- ./discussion-container -->

  <div class="discussion-popover">
    <form action="/discussion/" method="POST" enctype="multipart/form-data">
      {{ csrf_field() }}
      {{ method_field("POST") }}

      @if(isset($category->id) && $category->id != "")
        <input type="hidden" name="category_id" value="{{ $category->id }}">
      @endif

      <p class="discussion-popover-title">Create New Discussion</p>

      <div class="discussion-popover-form-item">
        <label>Title</label>
        <input type="text" name="name" placeholder="Enter a title for this discussion...">
      </div>

      <div class="discussion-popover-form-item">
        <label>Subject</label>
        <input type="text" name="subject" placeholder="Enter a subject...">
      </div>

      <div class="discussion-popover-form-item">
        <div class="file-upload-container file-upload" data-id="image" id="upload-container">
          <i class="fas fa-cloud-upload-alt fa-2x"></i>
          <span>Upload an image from your device</span>
        </div>

        <input type="file" id="image" name="image" class="file-upload-input" data-id="upload-container" style="display:none;">
      </div>

      @if(!isset($category->id) || isset($category->id) && $category->id == "")
        <div class="discussion-popover-form-item">
          <label>Category</label>
          <select name="category_id">
            <option value="">Select a category to add this discussion to</option>
            @foreach($categories as $cat)
              <option value="{{ $cat->id }}">{{ $cat->name }}</option>
            @endforeach
          </select>
        </div>
      @endif

      <div class="discussion-popover-form-item">
        <label>Excerpt <small>(optional)</small></label>
        <input type="text" name="excerpt" placeholder="Enter an excerpt for your discussion...">
      </div>

      <div class="discussion-popover-form-item">
        <label>Content</label>
        <textarea name="content" placeholder="Enter your discussions content..."></textarea>
      </div>

      <button type="submit" class="discussion-popover-button">Create Discussion</button>
      <button type="button" class="discussion-popover-button discussion-popover-button-cancel discussion-popover-close">Cancel</button>

    </form>
  </div>

@endsection
