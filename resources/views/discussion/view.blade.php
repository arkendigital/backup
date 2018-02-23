@extends("layouts.master")

@section("content")

  <div class="discussion-top-bar"></div>

  <div class="discussion-container">
    <div class="discussion-container-inner">

      <h1 class="discussion-page-title">Discussion <span>{{ $category->name }}</span></h1>

      @include("discussion.sidebar")

      <div class="discussion-view-container">
        <div class="discussion-view">
          <div class="discussion-view-thread">

            <div class="discussion-view-thread-avatar">
              <img src="{{ $discussion->user->avatar }}" alt="{{ $discussion->user->username }}" title="{{ $discussion->user->username }}">
            </div><!-- /.discussion-view-thread-avatar -->

            <div class="discussion-view-thread-content">
              <p class="discussion-view-thread-content-title">{{ $discussion->name }}</p>
              <p class="discussion-view-thread-content-text">{{ $discussion->excerpt }}</p>

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
            <div class="discussion-view-thread discussion-view-thread-reply">

              <div class="discussion-view-thread-avatar">
                <img src="{{ $reply->user->avatar }}" alt="{{ $reply->user->username }}" title="{{ $reply->user->username }}">
              </div><!-- /.discussion-view-thread-avatar -->

              <div class="discussion-view-thread-content">
                <p class="discussion-view-thread-content-title"><i class="fa fa-reply"></i></p>
                <p class="discussion-view-thread-content-text">{{ $reply->content }}</p>

                <div class="discussion-view-thread-content-footer">
                  @if($reply->subject != "")
                    <p class="discussion-view-thread-content-footer-subject">{{ $reply->subject }}</p>
                  @endif
                  <p class="discussion-view-thread-content-footer-time">{{ $reply->created_at->diffForHumans() }}</p>
                  <p class="discussion-view-thread-content-footer-user">by {{ $reply->user->username }}</p>
                </div><!-- /.discussion-view-thread-content-footer -->
              </div><!-- /.discussion-view-thread-content -->

            </div><!-- /.discussion-view-thread -->
          @endforeach
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

            <a class="discussion-view-reply-submit" onclick="document.getElementById('discussion-reply-form').submit()">Submit Reply</a>

          </form>
        </div><!-- /.discussion-view-reply -->
        @else
          <div class="discussion-view margin-top--small">
            <div class="discussion-view-thread" style="padding-bottom: 40px;">
              <a class="button button--large button--dark-blue" href="{{ route("register") }}">REGISTER TO REPLY</a>
              &nbsp;&nbsp;or&nbsp;&nbsp;
              <a class="button button--large button--dark-blue" href="{{ route("login") }}">LOGIN</a>
            </div>
          </div>
        @endif

      </div><!-- /.discussion-view-container -->

    </div><!-- /.discussion-container-inner -->
  </div><!-- ./discussion-container -->

@endsection
