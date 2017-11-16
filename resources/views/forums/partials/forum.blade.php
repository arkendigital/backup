<div class="forum">
    <div class="forum__icon">
        <i class="fa fa-{{ $forum->icon }}"></i>
    </div><!--
--><div class="forum__info">
        <h4 class="forum__title">
            <a href="{{ route('forumDisplay', $forum) }} " title="View {{ $forum->name }}">{!! $forum->name !!}</a>
        </h4>
        <p class="forum__description">{!! $forum->description !!}</p>
    </div>
    <div class="forum__stats">
        {{-- <p>{{ $forum->threads->count() }} {{ str_plural('Thread', $forum->threads->count() ) }}</p> --}}
    </div><!--
--><div class="forum__latest">
        <div class="forum__lastposter">
            @if ($forum->lastPoster)
                <a href="/forums/{{$forum->slug }}" class="forum__avatar" style="background-image: url({{ $forum->lastPoster->avatar }})"></a>
            @endif
        </div>
        <div class="forum__lastpost">
            <h6 class="forum__heading">
                @if (($forum->lastPost) && ($forum->lastPoster))
                    <a href="/forums/{{ $forum->slug }}/{{ $forum->lastThread->slug }}">{{ $forum->lastThread->title }}</a>
                    <a href="{{ route('goToLastPost', [$forum, $forum->lastThread, $forum->lastPost]) }}">
                        <i class="fa fa-arrow-circle-right"></i>
                    </a>
                @endif
            </h6>
            <small class="u-t-muted">{{ $forum->updated_at->diffForHumans() }}</small>
            @if (($forum->lastPost) && ($forum->lastPoster))
            <small class="u-t-muted">
                <a href="/&#64;{{ $forum->lastPoster->slug }}">
                    <strong>{{ $forum->lastPoster->display_name }}</strong>
                </a>
            </small>
            @endif
        </div>
    </div>
</div>
