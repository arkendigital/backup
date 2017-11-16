@extends('layouts.master')

@section('breadcrumbs')
    {{ Breadcrumbs::render() }}
@endsection

@section('content')
<div class="box profile__header" style="margin-top:-2rem;background-image: url({{ $profile->cover }})">
    <div class="profile__avatar" style="background-image: url({{ $profile->avatar }})"></div>
    <div class="profile__name"><h2>{{ $profile->display_name }}</h2>
        <p class="profile__usertitle">{!! $profile->user_title !!}</p>
    </div>
</div>
<section class="profile">
    <div class="profile__container">
        <div class="profile__links">
            @if (!auth()->guest())
                @if (auth()->user()->id != $profile->id)
                    @if ($profile->isWatched())
                        <a href="{{route('unfollowUser', [$profile]) }}" class="button icon">
                            <i class="fa fa-bell-o"></i> Unfollow {{$profile->display_name}}
                        </a>
                    @else
                        <a href="{{route('followUser', [$profile]) }}" class="button icon">
                            <i class="fa fa-bell"></i> Follow {{$profile->display_name}}
                        </a>
                    @endif
                @endif
                @if (auth()->user()->id == $profile->user_id)
                    <a href="{{ route('profileEdit') }}" class="button">Edit Profile</a>
                @endif
                @if (auth()->user()->isAdmin())
                    <a class="button blue">Ban User</a>
                @endif
                @if(auth()->user()->isStaff())
                    <a class="button blue">User Notes</a>
                @endif
            @endif
        </div>

        <div class="col-4">
            <div class="box box--with-margin">
                <span class="box__title">{{ $profile->display_name }}'s Stats</span>
                <div class="box__content">
                    <p class="profile__xp">
                        <strong>{{ $profile->user->xp->points }}</strong> XP
                    </p>
                    <hr/>
                    <p class="stats">
                        <i class="fa fa-bell"></i>
                        <strong>{{ $profile->collectWatchers()->count() }} Followers</strong>
                    </p>
                    <p class="stats">
                        <i class="fa fa-calendar-check-o" aria-hidden="true"></i>
                        Registered <strong>{{ $profile->created_at->diffForHumans() }}</strong>
                    </p>
                    <p class="stats">
                        <i class="fa fa-comment-o" aria-hidden="true"></i>
                        <strong>XYX</strong> Comments Made
                    </p>
                    <p class="stats">
                        <i class="fa fa-comments" aria-hidden="true"></i>
                        <strong>{{ $profile->post_count }}</strong> Forum Posts Made
                    </p>
                    <p class="stats">
                        <i class="fa fa-pencil" aria-hidden="true"></i>
                        <strong>{{ $profile->thread_count }}</strong> Forum Topics Made
                    </p>
                    <p class="stats">
                        <i class="fa fa-thumbs-up" aria-hidden="true"></i>
                        <strong>XYX</strong> Post Reactions
                    </p>
                </div>
            </div>

            <div class="box box--with-margin">
                <span class="box__title">Contact {{ $profile->display_name }}</span>
                <div class="box__content">
                    <p class="stats">
                        <i class="fa fa-envelope" aria-hidden="true"></i> 
                        <strong>
                            <a href="{{route('messageCreate', ['to' => $profile->display_name])}}">
                                Private Message
                            </a>
                        </strong>
                    </p>
                    @if ($profile->social_networks)
                        @foreach ($profile->social_networks as $network => $username)
                            @if($username)
                            <p class="stats">
                                <i class="fa fa-{{$network}}" aria-hidden="true"></i>
                                {{ucwords($network)}}
                                <strong>
                                    <a href="{{ route('socialRedirect', [$network, $username]) }}" class="js-social-link">
                                        {{ $username }}
                                    </a>
                                </strong>
                            </p>
                            @endif
                        @endforeach
                    @endif
                </div>
            </div>
        </div>

        <div class="col-8">
            @if ($profile->about)
            <div class="box box--with-margin">
                <span class="box__title">About {{ $profile->display_name }}</span>
                <div class="box__content">
                    {!!$profile->about!!}
                </div>
            </div>
            @endif

            @unless ($posts->isEmpty())
            <div class="box box--with-margin">
                <span class="box__title">Recent Comments & Posts</span>
                <div class="box__content">

                    @foreach ($posts as $post)
                    @if ($post->thread)
                        <a href="{{ route('goToLastPost', [$post->thread->forum, $post->thread, $post->id]) }}">
                            <blockquote>
                                <p>{!! str_limit(strip_tags($post->content, 140)) !!}</p>
                                <footer>{{ $post->thread->title }}</footer>
                            </blockquote>
                        </a>
                    @endif
                    @endforeach

                    <div class="profile__links"><a class="button blue">View More</a></div>
                </div>
            </div>
            @endunless
        </div>

    </div>
</section>

@push('scripts-after')
<script>
    $('.js-social-link').on('click', function(e){
        e.preventDefault();
        let href = $(this).attr('href');
        console.log(href);
        swal({
            title: "Leaving example.com!",
            text: "You are now leaving example.com to an external site! Beware of dragons!",
            buttons: true,
        })
        .then((willRedirect) => {
            if (willRedirect) {
                window.location.href = href;
            } else {
                return false;
            }
        });
    });
</script>
@endpush
@endsection
