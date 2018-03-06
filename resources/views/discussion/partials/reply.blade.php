<div class="discussion-view-thread discussion-view-thread-reply">

  <div class="discussion-view-thread-avatar">
    <img src="{{ $reply->user->avatar }}" alt="{{ $reply->user->username }}" title="{{ $reply->user->username }}">
  </div><!-- /.discussion-view-thread-avatar -->

  <div class="discussion-view-thread-content">
    <p class="discussion-view-thread-content-title"><i class="fa fa-reply"></i></p>
    <span class="discussion-view-thread-content-text">{!! $reply->content !!}</span>

    <div class="discussion-view-thread-content-footer">
      @if($reply->subject != "")
        <p class="discussion-view-thread-content-footer-subject">{{ $reply->subject }}</p>
      @endif
      <p class="discussion-view-thread-content-footer-time">{{ $reply->created_at->diffForHumans() }}</p>
      <p class="discussion-view-thread-content-footer-user">by {{ $reply->user->username }}</p>
    </div><!-- /.discussion-view-thread-content-footer -->
  </div><!-- /.discussion-view-thread-content -->

</div><!-- /.discussion-view-thread -->
