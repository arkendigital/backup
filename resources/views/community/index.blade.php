@extends('layouts.master')

@section('breadcrumbs')
{!! Breadcrumbs::render() !!}
@endsection

@section('content')
<div class="gamefront__container">
    <ul class="pager">
        <li><a href="{{route('memberList') }}">ALL</a></li>
        @foreach ($letters as $letter)
            @if (preg_match("/^[a-zA-Z0-9]/", $letter))
                <li>
                    <a href="{{route('memberList') }}?filter={{$letter}}">{{ucfirst($letter)}}</a>
                </li>
            @endif
        @endforeach
    </ul>
    @foreach($users as $member)
    <div class="col-3">
        <div class="box box--with-margin matchheight">
            <div class="post__name">
                <a href="/&#64;{{ $member->profile->slug }}">{{ $member->profile->display_name }}</a>
                <p class="post__usertitle">{{ $member->profile->user_title }}</p>
            </div>

            <div class="post__avatar" style="background-image: url({{ $member->profile->avatar }})"></div>

            <br />
            <p class="post__xp">
                <strong>{{ $member->xp->points }}</strong> XP
            </p>
            <hr/>

            <div class="text-center">
                @if ($member->profile->about)
                    <p><small>{!!$member->profile->about!!}</small></p>
                    <hr/>
                @endif
            </div>

            <p class="stats">
                <i class="fa fa-calendar-check-o" aria-hidden="true"></i>
                Registered <strong>{{ $member->profile->created_at->format('jS F Y')}}</strong>
            </p>
        </div>
    </div>
    @endforeach
    <div class="clear"></div>
    <div class="row">
        {{$users->appends(['filter' => request()->filter])->links()}}
    </div>
</div>
@endsection
