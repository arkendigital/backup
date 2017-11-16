@extends('layouts.master')

@section('breadcrumbs')
    {{ Breadcrumbs::render() }}
@endsection

@section('content')
<section class="forums">
    <div class="forums__container">

        <a href="/forums/{{ $forum->slug }}/create" class="u-pull-right button icon">
            <i class="fa fa-pencil"></i> Create Thread
        </a>
        <div class="clear"></div>
        @if (!$forum->children->isEmpty())
            @if (auth()->guest())
                <div class="box box--with-margin">
                    <h3 class="forum__category">{{$forum->name}} - Sub Forums</h3>
                    @foreach ($forum->children as $child)
                        @if (in_array('Guest', $child->roles))
                            @include('forums.partials.forum', ['forum' => $child])
                        @endif
                    @endforeach
                </div>
            @else
                <div class="box box--with-margin">    
                    <h3 class="forum__category"><i class="fa fa-{{$forum->icon}}"></i>{{$forum->name}} - Sub Forums</h3>

                    @foreach ($forum->children as $child)
                        @hasanyrole($child->roles)
                            @include('forums.partials.forum', ['forum' => $child])
                        @endhasanyrole
                    @endforeach
                </div>
            @endif
        @endif


        <div class="box">
            <div class="forums__info">
                <h3 class="forum__category">
                    <i class="fa fa-{{ $forum->icon }}"></i> {!! $forum->name !!}
                </h3>
                <div class="forum__description_topic">
                    <p>{!! $forum->description !!}</p>
                </div>
            </div>
            <table class="table table-hover table-responsive" width="100%">
                <thead>
                    <tr>
                        <th width="5%"></th>
                        <th width="45%">Topic</th>
                        <th width="16%">Author</th>
                        <th width="7%">Posts</th>
                        <th width="7%">Views</th>
                        <th width="20%"  style="min-width: 400px;">Last Post</th>
                    </tr>
                </thead>
                @unless ( $pinned->isEmpty() )
                    @foreach ($pinned as $thread)
                    <tr class="thread-link @if ( $thread->status == 'closed')thread-locked @endif @if ( $thread->pinned == 1)thread-sticky @endif">
                        <!-- BEGIN .thread-link -->
                        <td>
                            <i class="forum-icon">
                                <i class="fa fa-thumb-tack"></i>
                            </i>
                        </td>
                        <td>
                            <a href="/forums/{{ $forum->slug }}/{{ $thread->slug }}">
                                @if ( $thread->status == 'pinned')<i class="sticky">Pinned</i>@endif
                                @if ( $thread->status == 'locked')<i class="thr-closed">Locked</i>@endif
                                {{ $thread->title }}
                                @if ( $thread->status == 'locked')<i class="fa fa-lock"></i>@endif
                            </a>
                        </td>
                        <td>
                            @if ($thread->profile)
                            <a href="/&#64;{{ $thread->profile->slug }}">
                                <strong>{{ $thread->profile->display_name }}</strong>
                            </a>
                            @endif
                        </td>
                        <td>
                            {{ $thread->post_count }}
                        </td>
                        <td>
                            {{ $thread->view_count }}
                        </td>
                        <td>
                            @if ($thread->lastPoster)
                            By <a href="/&#64;{{ $thread->lastPoster->slug }}"><strong>{{ $thread->lastPoster->display_name }}</strong></a> &mdash; {{ $thread->updated_at->diffForHumans() }} <a href="{{ route('goToLastPost', [$thread->forum, $thread, $thread->lastPost->id]) }}" class="forum__last_arrow"><i class="fa fa-arrow-circle-right"></i></a>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                @endunless
                
                @unless ( $threads->isEmpty() )
                    @foreach ( $threads as $thread )
                    <tr class="thread-link  @if ( $thread->status == 'closed')thread-locked @endif @if ( $thread->pinned == 1)thread-sticky @endif">
                        <!-- BEGIN .thread-link -->
                        <td>
                            <i class="forum-icon">
                                @if ( $thread->status == 'closed')
                                <i class="fa fa-lock"></i>
                                @else
                                <i class="fa fa-comments"></i>
                                @endif
                            </i>
                        </td>
                        <td>
                            <a href="/forums/{{ $forum->slug }}/{{ $thread->slug }}">
                                @if ( $thread->status == 'pinned')<i class="sticky">Pinned</i>@endif
                                @if ( $thread->status == 'locked')<i class="thr-closed">Locked</i>@endif
                                {{ $thread->title }}
                                @if ( $thread->status == 'locked')<i class="fa fa-lock"></i>@endif
                            </a>
                        </td>
                        <td>
                            @if ($thread->profile)
                            <a href="/&#64;{{ $thread->profile->slug }}">
                                <strong>{{ $thread->profile->display_name }}</strong>
                            </a>
                            @endif
                        </td>
                        <td>
                            {{ $thread->post_count }}
                        </td>
                        <td>
                            {{ $thread->view_count }}
                        </td>
                        <td>
                            @if ($thread->lastPost)
                                @if ($thread->lastPoster)
                                   By <a href="/&#64;{{ $thread->lastPoster->slug }}"><strong>{{ $thread->lastPoster->display_name }}</strong></a>
                                @else 
                                    By Guest
                                @endif &mdash; {{ $thread->updated_at->diffForHumans() }} <a href="{{ route('goToLastPost', [$thread->forum, $thread, $thread->lastPost->id]) }}" class="forum__last_arrow"><i class="fa fa-arrow-circle-right"></i></a>
                            @endif
                            <!-- END .thread-link -->
                        </td>
                    </tr>
                    @endforeach
                @endunless
            </table>
        </div>
        <a href="/forums/{{ $forum->slug }}/create" class="u-pull-right button icon">
            <i class="fa fa-pencil"></i> Create Thread
        </a>
        <div class="pagination">
            {{ $threads->links() }}
        </div>
    </div>
</section>
@endsection
