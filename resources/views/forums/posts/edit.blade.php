@extends('layouts.master')
@section('breadcrumbs')
{{ Breadcrumbs::render() }}
@endsection
@section('content')
<section class="forums">
    <div class="forums__container">
        <h3 class="forum__topic_title">
            <i class="fa fa-gamepad"></i>Editing post #{{ $forumpost->id }} of {{ $thread->title }}
        </h3>
        <div class="box box--no-border">
            <form action="/forums/{{ $forum->slug }}/{{ $thread->slug }}/replies/{{ $forumpost->id }}" method="POST" role="form">
                {{ method_field('PATCH') }}
                {{ csrf_field() }}

                <textarea class="js-editor form__input" name="content" id="input" rows="10" cols="100" required="required" placeholder="See, the thing is..">
                    {!! $forumpost->content !!}
                </textarea>
                <input type="submit" name="submit" value="Edit Post" class="u-pull-right">

            </form>
        </div>
    </div>
</section>
@endsection
