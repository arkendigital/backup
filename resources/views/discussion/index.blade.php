@extends("layouts.master")

@section("content")

  <div class="discussion-top-bar"></div>

  <div class="discussion-container">
    <div class="discussion-container-inner">

      <h1 class="discussion-page-title">Discussion <span>{{ isset($category) ? $category->name : "" }}</span></h1>

      @if(auth()->check())
        <a class="discussion-add-button">Create Discussion</a>
      @else
        <a class="discussion-add-button" href="{{ route("login") }}?from={{ url()->full() }}">Login to Chat</a>
      @endif

      <div class="clear"></div>

      @include("discussion.sidebar")

      <div class="discussion-list-container margin-bottom--medium">
        <div class="discussion-list">
          @if($discussions->isEmpty())
            <p class="discussion-list-thread-content-title" style="padding: 25px 0 10px 0;">Sorry, we couldn't find any discussions here.</p>
          @else
          @foreach($discussions as $discussion)
            @if ($discussion->user)
            <div class="discussion-list-thread">

              <div class="discussion-list-thread-avatar">
                <img src="{{ $discussion->user->avatar }}" alt="{{ $discussion->user->username }}" title="{{ $discussion->user->username }}">
              </div><!-- /.discussion-list-thread-avatar -->

              <div class="discussion-list-thread-content">
                <a class="discussion-list-thread-content-title" href="/discussion/{{ $discussion->category->slug }}/{{ $discussion->slug }}">{{ $discussion->name }}</a>
                <p class="discussion-list-thread-content-text">{{ $discussion->excerpt }}</p>

                <div class="discussion-list-thread-content-footer">
                  @if($discussion->category)
                    <p class="discussion-list-thread-content-footer-subject">{{ $discussion->category->name }}</p>
                  @endif
                  <p class="discussion-list-thread-content-footer-time">{{ $discussion->created_at->diffForHumans() }}</p>
                  <p class="discussion-list-thread-content-footer-user">by {{ $discussion->user->username }}</p>
                </div><!-- /.discussion-list-thread-content-footer -->
              </div><!-- /.discussion-list-thread-content -->

              <div class="discussion-list-reply-count">
                {{ $discussion->replies_count }}
                @if($discussion->replies_count == 1)
                    Reply
                @else
                    Replies
                @endif
              </div><!-- /.discussion-list-reply-count -->

            </div><!-- /.discussion-list-thread -->
            @endif
          @endforeach
          @endif
        </div><!-- /.discussion-list -->

        <div class="discussion-pagination">
          {{ $discussions->links() }}
        </div><!-- /.discussion-pagination -->
      </div><!-- /.discussion-list-container -->

    </div><!-- /.discussion-container-inner -->
  </div><!-- ./discussion-container -->

  @if(isset($page_adverts[0]["main-content"]))
    @include('partials.advert', [
      'advert' => $page_adverts[0]["main-content"]
    ])
  @endif

  @include("discussion.partials.create")

  @push("scripts-after")
      <script src='https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.4/latest.js?config=TeX-MML-AM_CHTML' async></script>

      @if(session("new_user"))
          <script>dataLayer.push({'event' : 'gtm.formSubmit', 'formName' : 'signup'});</script>
      @endif

  @endpush

@endsection
