@extends('layouts.master')

@section('breadcrumbs')
    {{ Breadcrumbs::render() }}
@endsection

@section('content')
    <main class="site">
        <section class="site__container">
            <div class="box">
                <span class="box__title">Search</span>
                <div class="box__content">
                    <form action="{{ route('forumSearch') }}" method="get" class="form">
                        <input type="text" id="q" name="q" class="form__input" placeholder="Enter Search Term">
                        <div class="u-pull-right">
                            <input type="submit" value="Search">
                        </div>
                    </form>
                </div>
            </div>
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
                            <a href="/&#64;{{ $thread->user->profile->slug }}">
                                <strong>{{ $thread->user->profile->display_name }}</strong>
                            </a>
                        </td>
                        <td>
                            {{ $thread->post_count }}
                        </td>
                        <td>
                            xxx
                        </td>
                        <td>
                            <a href="/&#64;{{ $thread->posts->last()->user->profile->slug }}">
                                <strong>{{ $thread->posts->last()->user->profile->display_name }}</strong>
                            </a>
                            {{ $thread->updated_at->diffForHumans() }}
                        </td>
                        <!-- END .thread-link -->
                    </tr>
                    @endforeach
            </table>
            @endunless
        </div>
    </section>
</main>
@endsection
