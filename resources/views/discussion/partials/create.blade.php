@if (auth()->user())
    <div class="discussion-popover @if($errors->any()) discussion-popover-active @endif">
      <form action="/discussion/" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        {{ method_field("POST") }}

        @if(isset($category->id) && $category->id != "")
          <input type="hidden" name="category_id" value="{{ $category->id }}">
        @endif

        <p class="discussion-popover-title">Create New Discussion</p>

        @if($errors->any())
            <p class="discussion-popover-error" style="margin-bottom: 25px;">There are some issues with this post, please review the items marked in red below</p>
        @endif

        <div class="discussion-popover-form-item">
          <label>Title</label>
          @if($errors->has("name"))
              <p class="discussion-popover-error">{{ $errors->first("name") }}</p>
          @endif
          <input type="text" name="name" placeholder="Enter a title for this discussion..." value="{{ old("name") }}">
        </div>

        <div class="discussion-popover-form-item">
            @if($errors->has("image"))
                <p class="discussion-popover-error">{{ $errors->first("image") }}</p>
            @endif
          <div class="file-upload-container file-upload" data-id="image" id="upload-container">
            <i class="fas fa-cloud-upload-alt fa-2x"></i>
            <span>Upload an image from your device</span>
          </div>

          <input type="file" id="image" name="image" accept="image/*" class="file-upload-input" data-id="upload-container" style="display:none;">
        </div>

        @if(!isset($category->id) || isset($category->id) && $category->id == "")
          <div class="discussion-popover-form-item">
            <label>Category</label>
            @if($errors->has("category_id"))
                <p class="discussion-popover-error">{{ $errors->first("category_id") }}</p>
            @endif
            <select name="category_id">
              <option value="">Select a category to add this discussion to</option>
              @foreach($categories as $cat)
                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
              @endforeach
            </select>
          </div>
        @endif

        <div class="discussion-popover-form-item">
          @if($errors->has("excerpt"))
              <p class="discussion-popover-error">{{ $errors->first("excerpt") }}</p>
          @endif
          <label>Short description about your thread <small>(optional)</small></label>
          <input type="text" name="excerpt" placeholder="Enter an excerpt for your discussion...">
        </div>

        <div class="discussion-popover-form-item">
          <label>Content</label>
          @if($errors->has("content"))
              <p class="discussion-popover-error">{{ $errors->first("content") }}</p>
          @endif
          <textarea name="content" placeholder="Enter your discussions content..."></textarea>
        </div>

        <button type="submit" class="discussion-popover-button">Create Discussion</button>
        <button type="button" class="discussion-popover-button discussion-popover-button-cancel discussion-popover-close">Cancel</button>

      </form>
    </div>
@endif
