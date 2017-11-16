@extends('layouts.master')
@section('breadcrumbs')
{{ Breadcrumbs::render() }}
@endsection
@section('content')
<section class="forums">
    <div class="forums__container">
        <div class="row">
            <div class="col-8">
                <h3 class="forum__topic_title">
                    <i class="fa fa-{{$thread->forum->icon}}"></i>
                    {{ $thread->title }} - {{ $thread->post_count }} {{ str_plural('reply', $thread->post_count ) }}
                </h3>
            </div>
            <div class="col-4">
                <div class="pagination u-pull-right">
                    {{ $posts->links() }}
                </div>
            </div>
        </div>

        @if (auth()->check())
            @if (($thread->status == 'open') || (auth()->user()->isStaff()))
                <a href="#quick-reply" class="button icon">
                    <i class="fa fa-pencil"></i> Post Reply
                </a>
            @else
                <a class="button red icon">
                    <i class="fa fa-lock"></i> Closed to further replies
                </a>
            @endif
            @if (!$thread->isSubscribedTo)
                <a class="button icon blue" id="subscribe-thread-{{$thread->id }}">
                    <i class="fa fa-eye"></i> Subscribe
                </a>
                @push('scripts-after')
                    @include('inline-scripts.threads.subscribe-thread-js', $thread)
                @endpush
            @else
                <a class="button icon red" id="unsubscribe-thread-{{$thread->id }}">
                    <i class="fa fa-eye"></i> Unsubscribe
                </a>
                @push('scripts-after')
                    @include('inline-scripts.threads.unsubscribe-thread-js', $thread)
                @endpush
            @endif
        @endif

        @if (auth()->check())
            @if (auth()->user()->isStaff())
                <a href="{{ route('closeThread', [$thread->forum, $thread]) }}" class="u-pull-right button blue icon">
                    @if ($thread->status == 'open')
                        <i class="fa fa-lock"></i> Close
                    @elseif($thread->status == 'closed')
                        <i class="fa fa-unlock"></i> Open
                    @endif
                </a>

                <a href="{{ route('pinThread', [$thread->forum, $thread]) }}" class="u-pull-right button blue icon">
                    @if ($thread->pinned == 0)
                        <i class="fa fa-level-up"></i> Pin
                    @else
                        <i class="fa fa-level-down"></i> Unpin
                    @endif
                </a>

                <a href="{{ route('moveThread', [$thread->forum, $thread]) }}" class="u-pull-right button blue icon">
                    <i class="fa fa-arrow-circle-right"></i> Move
                </a>
            @endif

            @if ($thread->user)
                @if ((auth()->user()->id == $thread->user->id) || (auth()->user()->isStaff()))
                    <a class="u-pull-right button red icon" id="delete-thread-{{$thread->id}}">
                        <i class="fa fa-trash"></i> Delete
                    </a>
                @endif
            @endif
        @endif

        @unless( $posts->isEmpty() )
            @foreach ( $posts as $post )
                @include('threads.partials.post', $post)
            @endforeach
        @endunless

        {{ $posts->links() }}

        @if ( auth()->user() )
            @if (($thread->status == 'open') || (auth()->user()->isStaff()))
                <div id="quick-reply">
                    <div class="box box--no-border box--with-margin" id="post-{{ $post->id }}">
                        <span class="box__title">
                            Replying to {{ $thread->title }}
                        </span>
                        <table width="100%" cellpadding="4">
                            <tr>
                                <td width="20%" valign="top" style="padding-top: 15px;">
                                    <div class="post__name">
                                        <a href="/&#64;{{ auth()->user()->profile->slug }}">
                                            {{ auth()->user()->profile->display_name }}
                                        </a>
                                        <p class="post__usertitle">{{ auth()->user()->profile->user_title }}</p>
                                    </div>
                                    <div class="post__avatar" style="background-image: url({{ auth()->user()->profile->avatar }})"></div>
                                    <br />
                                </td>
                                <td width="80%" valign="top">
                                    <form action="{{ route('storePost', [$thread->forum, $thread]) }}" method="POST" class="form" role="form">
                                        <input type="hidden" name="lastPage" id="lastPage" value="{{ $posts->lastPage() }}">
                                        {{ csrf_field() }}
                                        <textarea name="content" id="content" class="form__input js-editor" rows="8" required="required"></textarea>
                                        @if ($thread->status == 'closed')
                                        <div class="alert alert-danger u-text-center">
                                            <p>This thread is closed. As a staff member, you may reply to it.</p>
                                            <p><strong>Use your power wisely...</strong></p>
                                        </div>
                                        @endif
                                        <input type="submit" name="submit" value="Post Reply" class="u-pull-right">
                                    </form>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            @endif
        @endif
    </div>
</section>

@if (auth()->check())
    @if ($thread->user)
        @if ((auth()->user()->id == $thread->user->id) || (auth()->user()->isStaff()))
            <form action="{{ route('deleteThread', [$thread->forum, $thread]) }}" method="post" id="delete-thread-form-{{$thread->id }}">
                {{ csrf_field() }}
                {{ method_field('DELETE')}}
            </form>

            @push('scripts-after')
                @include('inline-scripts.threads.delete-thread-js', $thread)
            @endpush
        @endif
    @endif
@endif

@endsection
