@extends('layouts.master')

@section('breadcrumbs')
    {{ Breadcrumbs::render() }}
@endsection

@section('content')
    <main class="site">
        <section class="site__container">
            <h3 class="forum__category"><i class="fa fa-fire"></i> Popular Forum Activity</h3>
            @unless($threads->isEmpty())
            <br>
            <div class="box">
                <table class="table table-hover table-responsive">
                    <thead>
                        <tr>
                            <th width="10px"></th>
                            <th>Topic</th>
                            <th>Author</th>
                            <th>Posts</th>
                            <th>Views</th>
                            <th>Last Post</th>
                        </tr>
                    </thead>
                @foreach ( $threads as $thread )
                @if ($thread->lastPoster)
                    @if (auth()->guest())
                        @if (!in_array('Guest', $thread->forum->roles))
                            @continue
                        @else
                        @if ($thread->forum)
                            <tr class="thread-link
                            @if ( $thread->status == 'pinned')thread-unread thread-sticky @endif
                            @if ( $thread->status == 'locked')thread-locked @endif">
                                <!-- BEGIN .thread-link -->
                                <td>
                                    <i class="forum-icon">
                                        <i class="fa fa-comments"></i>
                                    </i>
                                </td>
                                <td>
                                    <a href="/forums/{{ $thread->forum->slug }}/{{ $thread->slug }}">
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
                                    <a href="/&#64;{{ $thread->lastPoster->slug }}">
                                        <strong>{{ $thread->lastPoster->display_name }}</strong>
                                    </a>
                                    <a href="{{ route('goToLastPost', [$thread->forum, $thread->forum->lastThread, $thread->forum->lastPost]) }}">
                                        <i class="fa fa-arrow-circle-right"></i>
                                    </a>
                                    @endif
                                    {{ $thread->updated_at->diffForHumans() }}
                                </td>
                                <!-- END .thread-link -->
                            </tr>
                            @endif
                        @endif
                    @else
                    @if ($thread->forum)
                        @hasanyrole($thread->forum->roles)
                            <tr class="thread-link
                            @if ( $thread->status == 'pinned')thread-unread thread-sticky @endif
                            @if ( $thread->status == 'locked')thread-locked @endif">
                                <!-- BEGIN .thread-link -->
                                <td>
                                    <i class="forum-icon">
                                        <i class="fa fa-comments"></i>
                                    </i>
                                </td>
                                <td>
                                    <a href="/forums/{{ $thread->forum->slug }}/{{ $thread->slug }}">
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
                                    <a href="/&#64;{{ $thread->lastPoster->slug }}">
                                        <strong>{{ $thread->lastPoster->display_name }}</strong>
                                    </a>
                                    <a href="{{ route('goToLastPost', [$thread->forum, $thread->forum->lastThread, $thread->forum->lastPost]) }}">
                                        <i class="fa fa-arrow-circle-right"></i>
                                    </a>
                                    @endif
                                    {{ $thread->updated_at->diffForHumans() }}
                                </td>
                                <!-- END .thread-link -->
                            </tr>
                        @endhasanyrole
                        @endif
                    @endif
                @endif
                @endforeach
            </table>

            @endunless
        </div>

    </section>
</main>
@endsection
