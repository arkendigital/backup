@if(!isset($showpost))

  <div class="dashboard-post chocolat-parent" id="timeline-post-{{ $post->id }}">
    <div class="post-view-settings">

      <i class="fa fa-eye-slash margin-right-x-small cursor-pointer hide-timeline-post text-grey" data-post-id="{{ $post->id }}"></i>

      <i class="fa fa-flag-o margin-right-x-small cursor-pointer report-timeline-post text-grey" data-post-id="{{ $post->id }}"></i>

      <i class="fa fa-share-alt fa-lg text-light-blue cursor-pointer share-post" aria-hidden="true" data-postId="@if($post->share_id == "") {{ $post->id }} @else {{ $post->share->id }} @endif">
        <div class="popover popover-account">
          <a class="popover-link share-on-netmutts" data-postId="@if($post->share_id == "") {{ $post->id }} @else {{ $post->share->id }} @endif">Share on Netmutts</a>
          <a href="https://www.facebook.com/sharer/sharer.php?u={{ $post->share_url }}" class="popover-link" target="_blank">Share on Facebook</a>
          <a href="https://twitter.com/share?url={{ $post->share_url }}" class="popover-link" target="_blank">Share on Twitter</a>
          <a href="https://plus.google.com/share?url={{ $post->share_url }}" class="popover-link" target="_blank">Share on Google+</a>
          <a href="https://pinterest.com/pin/create/button/?url={{ $post->share_url }}" class="popover-link" target="_blank">Share on Pinterest</a>
          <a href="mailto:?subject=Checkout this post on Netmutts!&body={{ $post->share_url }}" class="popover-link">Share via Email</a>
          <a class="popover-link open-refur-a-friend" target="_blank">Refur a Friend</a>
        </div><!-- /.popover -->
      </i>

      @if(auth()->check() && auth()->user()->id == $post->profile->user_id || auth()->check() && $post->profile_id == auth()->user()->id)
      <i class="fa fa-cog post-settings cursor-pointer margin-left-x-small text-grey" aria-hidden="true">
        <div class="popover popover-account">
          <a href="/{{ "@".$post->profile->slug }}/{{ $post->uuid }}/edit" class="text-grey"><i class="fa fa-pencil" aria-hidden="true"></i> Edit post</a>

          <form action="{{ route('post.destroy', $post->id) }}" method="POST" id="deletePost-{{ $post->id }}">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
            <a class="text-grey" href="javascript: document.getElementById('deletePost-{{ $post->id }}').submit();"><i class="fa fa-close" aria-hidden="true"></i> Delete post</a>
          </form>
        </div><!-- /.popover -->
      </i>
      @endif
    </div><!-- /.post-view-settings -->

    <a href="/{{ "@".$post->profile->slug }}"><img src="{{ $post->profile->avatar }}" class="dashboard-post-avatar" /></a>
    <div class="dashboard-post-user-time">
      <a href="/{{ "@".$post->profile->slug }}" class="dashboard-post-user text-decoration-none">{{ $post->profile->display_name }}</a>
      <p class="dashboard-post-time">{{ $post->created_at->diffForHumans() }}</p>
    </div>

    <div class="clear"></div>

    @if($post->share_id != "")
      <div class="dashboard-post-is-share">
        @if($post->share->image != "")
          @if(!str_contains($post->share->image, ".jpeg"))
            <video width="100%" controls class="dashboard-post-image">
              <source src="{{ $post->share->image }}" type="video/mp4">
                Your browser does not support video.
            </video>
          @else
            @if($post->share->image != "")
              <a class="chocolat-image" href="{{ $post->share->image }}" target="_blank">
                <img src="{{ $post->share->image }}" class="dashboard-post-image" alt="{{ $post->share->content }}" title="{{ $post->share->content }}" />
              </a>
            @endif
          @endif
        @endif

        <div class="dashboard-post-copy">{!! $post->share->content !!}</div>
      </div><!-- /.dashboard-post-is-share -->
    @endif

    @if($post->image != "")
      @if(!str_contains($post->image, ".jpeg"))
        <video width="100%" controls class="dashboard-post-image">
          <source src="{{ $post->image }}" type="video/mp4">
            Your browser does not support video.
        </video>
      @else
        @if($post->image != "")
          <a class="chocolat-image" href="{{ $post->image }}" target="_blank">
            <img src="{{ $post->image }}" class="dashboard-post-image" alt="{{ $post->content }}" title="{{ $post->content }}" />
          </a>
        @endif
      @endif
    @endif

    <div class="dashboard-post-copy margin-top-small">{!! $post->content !!}</div>

    <div class="divider margin-top-small margin-bottom-small"></div>

    <div class="dashboard-post-actions margin-bottom-small">

      <form action="{{ route('postlike.store') }}" method="POST" id="likePost-{{ $post->id }}">
        {{ csrf_field() }}
        <input type="hidden" value="{{ $post->id }}" name="post_id" />
      </form>

      <a href="javascript:void(0);" data-postId="{{ $post->id }}" class="dashboard-post-action dashboard-post-action-love lovePost-{{ $post->id }} @if(in_array(Auth::id(), $post->likes->pluck('user_id')->toArray())) text-red @endif">
        <i class="fa fa-heart" aria-hidden="true"></i> <span class="lovePostCount-{{ $post->id }}">{{ count($post->likes) }}</span>
      </a>

      <a class="cursor-pointer dashboard-post-action dashboard-post-action-comment dashboard-post-action-comment-{{$post->id}} @if(in_array(Auth::id(), $post->comments->pluck('user_id')->toArray())) text-blue @endif" data-postid="{{ $post->id }}" data-postuuid="{{ $post->uuid }}">
        <i class="fa fa-comment" aria-hidden="true"></i> <span id="post-comments-count-{{ $post->id }}">{{ count($post->comments) }}</span>
        <span class="dashboard-post-action-show-comments">Show comments</span>
      </a>
    </div>

    @if(auth()->check() && isVerified())
      <form action="{{ route('postcomment.store') }}" method="POST" class="post-comment-form position-relative" id="timeline-post-comment-form-{{ $post->id }}" data-postId="{{ $post->id }}">
        {{ csrf_field() }}

        {{-- <input class="dashboard-post-reply-input dashboard-post-reply-input-{{$post->id}}" type="text" placeholder="Leave a comment..." autocomplete="off" name="content" /> --}}

        <div class="create-post-trum leave-comment-trum timeline-leave-comment-wrap" data-post-id="{{$post->id}}" id="post-comment-trum-wrap-{{$post->id}}">
          <textarea id="leave-comment" class="create-post-editor" name="content" class="dashboard-post-reply-input" placeholder="Leave a comment..."></textarea>
          <i class="fa fa-2x fa-arrow-circle-o-right dashboard-post-reply-send" data-postid="{{$post->id}}"></i>
        </div>

        <input type="hidden" value="{{ $post->id }}" name="post_id" />
      </form>

      <div class="timeline-post-comments-preview" id="post-comments-preview-{{$post->id}}">
      </div>

      <div class="clear"></div>
      <div class="timeline-post-show-all dashboard-post-action-comment" id="post-comments-show-all-button-{{$post->id}}" data-postid="{{ $post->id }}" data-postuuid="{{ $post->uuid }}">Show all comments</div>
    @endif
  </div>

@endif

<!-- Post View -->
<div class="post-view" id="postView-{{ $post->id }}" @if(!isset($showpost)) style="display: none;" @endif>
  <div class="post-view-wrapper" @if($post->image == "") style="width: 385px; min-height: 80%;" @endif>

    <span class="post-view-close">X</span>

    @if($post->image != "")
      <img class="post-view-image" src="{{ $post->image }}" alt="{{ $post->content }}" title="{{ $post->content }}" />
    @endif

    <div class="post-view-content" @if($post->image == "") style="width: calc(100% - 50px)" @endif>

      <div>
        <div class="post-view-user-wrap">
          <img class="post-view-user-avatar" src="{{ $post->profile->avatar }}" alt="placeholder" title="placeholder" />
          <div class="post-view-user-info">
            <p class="post-view-user-name">{{ $post->profile->user->username }}</p>
            <p class="post-view-user-time margin-top-x-small">{{ $post->created_at->diffForHumans() }}</p>
          </div><!-- /.post-view-user-info -->
        </div><!-- /.post-view-user-wrap -->

        <div class="post-view-copy">{!! $post->content !!}</div>

        <div class="post-view-action @if(in_array(Auth::id(), $post->likes->pluck('user_id')->toArray())) text-red @endif"><i class="fa fa-heart" aria-hidden="true"></i>{{ count($post->likes) }}</div>
        <div class="post-view-action text-dark-grey"><i class="fa fa-comment" aria-hidden="true"></i>{{ count($post->comments) }}</div>

        @foreach($post->comments as $comment)
          <div class="post-view-user-comment">
            <img class="post-view-user-avatar" src="{{ $comment->profile->avatar }}" alt="placeholder" title="placeholder" />
            <div class="post-view-user-comment-top">
              <span class="post-view-user-name">{{ $comment->profile->user->username }}</span>
              <span class="post-view-user-time">{{ $comment->created_at->diffForHumans() }}</span>
            </div>
            <div class="post-view-user-comment-copy">{!! $comment->content !!}</div>
          </div><!-- /.post-view-user-comment -->
        @endforeach
      </div>
    </div><!-- /.post-view-content -->

    @if(auth()->check() && isVerified())
      <form action="{{ route('postcomment.store') }}" method="POST" class="post-view-comment-input-wrap" @if($post->image == "") style="width: 100%;" @endif>
        {{ csrf_field() }}
        <input type="text" class="post-view-comment-input" placeholder="Leave a comment..." name="content" autocomplete="off" />
        <input type="hidden" value="{{ $post->id }}" name="post_id" />
      </form>
    @endif
  </div><!-- /.post-view-wrapper -->
</div><!-- /.post-view -->
<!-- / Post View -->
