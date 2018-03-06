@extends("layouts.master")

@section("content")

  <div class="discussion-top-bar"></div>

  <div class="discussion-container">
    <div class="discussion-container-inner">

      <h1 class="discussion-page-title">Discussion <span>{{ $category->name }}</span></h1>

      <div class="clear"></div>

      @include("discussion.sidebar")

      <div class="discussion-view-container">
        <div class="discussion-view">
          <div class="discussion-view-thread">

            <div class="discussion-view-thread-avatar">
              <img src="{{ $discussion->user->avatar }}" alt="{{ $discussion->user->username }}" title="{{ $discussion->user->username }}">
            </div><!-- /.discussion-view-thread-avatar -->

            <div class="discussion-view-thread-content">
              <p class="discussion-view-thread-content-title">{{ $discussion->name }}</p>
              <span class="discussion-view-thread-content-text">{!! $discussion->content !!}</span>

              <div class="discussion-view-thread-content-footer">
                @if($discussion->subject != "")
                  <p class="discussion-view-thread-content-footer-subject">{{ $discussion->subject }}</p>
                @endif
                <p class="discussion-view-thread-content-footer-time">{{ $discussion->created_at->diffForHumans() }}</p>
                <p class="discussion-view-thread-content-footer-user">by {{ $discussion->user->username }}</p>
              </div><!-- /.discussion-view-thread-content-footer -->
            </div><!-- /.discussion-view-thread-content -->

            <div class="discussion-list-reply-count">
              {{ $discussion->reply_count }}
            </div><!-- /.discussion-list-reply-count -->

          </div><!-- /.discussion-view-thread -->

          @foreach($discussion->replies as $reply)
            @include("discussion.partials.reply", $reply)
          @endforeach
          <div id="newDiscussionReply"></div>
        </div><!-- /.discussion-view -->

        @if(auth()->check())
        <div class="discussion-view-reply">
          <form action="{{ route("discussionStoreReply", compact("category", "discussion")) }}" method="POST" id="discussion-reply-form">
            {{ csrf_field() }}
            {{ method_field("POST") }}

            <p class="discussion-view-reply-title">Reply to this discussion</p>

            @if($errors->has("content"))
              <p class="discussion-view-reply-error">
                {{ $errors->first("content") }}
              </p>
            @endif

            <textarea class="discussion-view-reply-editor" name="content"></textarea>

            <button type="submit" class="discussion-view-reply-submit">Submit Reply</a>

          </form>
        </div><!-- /.discussion-view-reply -->
        @else
          <div class="discussion-view margin-top--small">
            <div class="discussion-view-thread" style="padding-bottom: 40px;">
              <a class="button button--large button--dark-blue" href="{{ route("register") }}">REGISTER TO REPLY</a>
              &nbsp;&nbsp;or&nbsp;&nbsp;
              <a class="button button--large button--dark-blue" href="{{ route("login") }}?from={{ urlencode(url()->full()) }}">LOGIN</a>
            </div>
          </div>
        @endif

      </div><!-- /.discussion-view-container -->

    </div><!-- /.discussion-container-inner -->
  </div><!-- ./discussion-container -->

@endsection
