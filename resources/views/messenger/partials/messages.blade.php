<div class="box box--with-margin">
    <span class="box__title"><small>Posted {{ $message->created_at->diffForHumans() }}</small></span>
    <div class="col-3">
        <div class="post__name">
            <a href="/&#64;{{ $message->user->profile->slug }}">{{ $message->user->profile->display_name }}</a>
            @if ( $message->user->isOnline() )
            <span class="status-online" title="{{ $message->user->profile->display_name }} is online now!">
            </span>
            @else
            <span class="status-offline" title="{{ $message->user->profile->display_name }} is offline">
            </span>
            @endif
            <p class="post__usertitle">{!!$message->user->icon!!} {{ $message->user->profile->user_title }}</p>
        </div>
        <div class="post__avatar" style="background-image: url({{ ($message->user->profile->avatar) }})"></div>
        <a href="{{ route('me', $message->user->profile) }}">
            <strong></strong>
        </a>
    </div>
    <div class="col-9">
        <p>{!! $message->body !!}</p>
    </div>
</div>
