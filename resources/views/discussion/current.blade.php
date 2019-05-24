@extends("layouts.master")

@section("content")

  <div class="discussion-top-bar"></div>

  <div class="discussion-container">
    <div class="discussion-container-inner">

      <h1 class="discussion-page-title">Discussion</h1>

      @if(auth()->check())
          <a class="discussion-button--reply">Reply</a>
      @endif

      @if($discussion->canEdit())
        <form action="{{ route("discussion.destroy", compact("category", "discussion")) }}" method="POST">
          {{ csrf_field() }}
          {{ method_field("DELETE") }}
          <button type="submit" class="discussion-button--delete">Delete</button>
        </form>
        <a class="discussion-edit-button" href="{{ route("discussion.edit", compact("category", "discussion")) }}">Edit</a>
      @endif

      <div class="clear"></div>

      @include("discussion.sidebar")

      <div class="discussion-view-container">
        <h2 class="dicussion-page-subtitle">{{ $discussion->name }}</h2>
        <div class="discussion-view">
          <div class="discussion-view-thread @if($discussion->replies->isEmpty()) discussion-view-thread--no-border @endif" style="width:auto;padding:0px;text-align: left;">

            <div class="margin-bottom--medium view-section" style="margin: 0px;">
              @if(! str_contains($discussion->image, 'placeholder')) 
                <div class="section-hero" style="background-image: url({{ asset('/'.$discussion->image) }}); border-color: #0d72b9;border-bottom:0px;"></div>
              @endif
              <section class="discussion-view-thread-content-text" style="padding:0px 25px;">{!! $discussion->content !!}</section>

              @if($discussion->image_path != "")
                  <img class="discussion-view-thread-content-image" alt="" title="" src="{{ $discussion->image }}">
              @endif

            </div><!-- /.discussion-view-thread-content -->



          </div><!-- /.discussion-view-thread -->

          <div class="discussion-replies-wrapper">
              @foreach($discussion->replies as $reply)
                @include("discussion.partials.reply", $reply)
              @endforeach
          </div>
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
          <div class="discussion-view margin-top--small discussion-login-register">
            <div class="discussion-view-thread" style="padding-bottom: 40px;">
              <p><a class="button button--large button--dark-blue" href="{{ route("register") }}">REGISTER TO REPLY</a>
              <span>or</span>
              <a class="button button--large button--dark-blue" href="{{ route("login") }}?from={{ urlencode(url()->full()) }}">LOGIN</a></p>
            </div>
          </div>
        @endif

      </div><!-- /.discussion-view-container -->

    </div><!-- /.discussion-container-inner -->
  </div><!-- ./discussion-container -->

  @if(isset($page_adverts[0]["main-content"]))
    @include('partials.advert', [
      'advert' => $page_adverts[0]["main-content"]
    ])
  @endif

  @push("scripts-after")
      <script src='https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.4/latest.js?config=TeX-MML-AM_CHTML' async></script>
  @endpush

@endsection
