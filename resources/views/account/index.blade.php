@extends('layouts.master')

@section('breadcrumbs')
    {{ Breadcrumbs::render() }}
@endsection

@section('content')
<main class="site">
    <section class="site__container">
        <div class="col-3">
            @include('account.partials.sidebar')
        </div>
        <div class="col-9">
            <div class="box box--with-margin">
                <div class="u-pull-left profile__xp" style="vertical-align: middle !important;">
                    <img src="{{ auth()->user()->profile->avatar }}" class="post_avatar_cp"> <strong>{{ auth()->user()->xp->points }}</strong> XP
                </div>
                <div class="u-pull-right">
                    <h2>{{ auth()->user()->profile->display_name }}'s Control Panel</h2>
                    <p><i>"{{ auth()->user()->profile->user_title }}"</i></p>
                </div>
                <div class="clear"></div>
                <hr>
            </div>
            
            @unless($subscriptions->isEmpty())
            <div class="box box--with-margin">
                <span class="box__title">Your Watched Threads</span>
                <table class="table table-hover table-responsive">
                    <thead>
                        <tr>
                            <th width="10"></th>
                            <th>Topic</th>
                            <th>Author</th>
                            <th>Posts</th>
                            <th>Views</th>
                            <th>Last Post</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($subscriptions as $subscription)
                        <tr class="thread-link">
                            <td>
                                <i class="forum-icon">
                                    <i class="fa fa-comments"></i>
                                </i>
                            </td>
                            <td>
                                <a href="{{ route('showThread', [$subscription->thread->forum, $subscription->thread]) }}">
                                    {{ $subscription->thread->title }}
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('me', $subscription->thread->firstPost()->profile) }}">
                                    <strong>{{ $subscription->thread->firstPost()->profile->display_name }}</strong>
                                </a>
                            </td>
                            <td>{{ $subscription->thread->post_count }}</td>
                            <td>{{ $subscription->thread->view_count }}</td>
                            <td>
                                By 
                                <a href="{{ route('me', $subscription->thread->lastPost()->profile) }}">
                                    <strong>{{ $subscription->thread->lastPost()->profile->display_name }}</strong>
                                </a> 
                                - {{ $subscription->thread->updated_at->diffForHumans() }}
                                <a href="{{ route('goToLastPost', [$subscription->thread->forum, $subscription->thread, $subscription->thread->lastPost()->id]) }}" class="forum__last_arrow">
                                    <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="clear"></div>
            </div>
            @endunless
            
            @if ((env('INVITE_ONLY') == 1) && (auth()->user()->isStaff()))
            <div class="box box--with-margin">
                <span class="box__title">Invite Someone to {{Setting::get('site_name')}} Closed BETA</span>
                <div class="box__content">
                    <div class="alert alert-info">
                        <p><strong>Important!</strong> You only have {{count($codes)}} codes to invite users to {{Setting::get('site_name')}}!</p>
                        <p>Make sure you use them wisely. They do not expire, however they are only single use.</p>
                        <p>Copy and paste one of the following codes to your friends to invite them in.</p>
                    </div>
                    @foreach ($codes as $code)
                        <input type="text" class="form__input" value="{{ route('checkInvite', ['invite_code' => $code->code])}}">
                    @endforeach
                </div>
            </div>
            @endif

        </div>
    </section>
</main>
@endsection
