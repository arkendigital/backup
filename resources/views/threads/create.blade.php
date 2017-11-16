@extends('layouts.master')

@section('breadcrumbs')
{{ Breadcrumbs::render() }}
@endsection

@section('content')
<section class="forums">
    <div class="forums__container">
        <h3 class="forum__topic_title">
            <i class="fa fa-gamepad"></i>Creating thread within {{ $forum->name }}
        </h3>
        <div class="box box--no-border">
            <div class="box__content full-reply">
                <form action="/forums/{{ $forum->slug }}" method="POST" role="form">
                    {{ csrf_field() }}
                    <div class="form__group">
                        <input class="form__input" type="text" name="title" id="title" placeholder="I want to talk about...">
                    </div>
                    <div class="form__group">
                        <textarea class="js-editor form__input"  name="content" id="input" rows="10" required="required" placeholder="See, the thing is..."></textarea>
                    </div>
                    <input type="submit" name="submit" value="Create Thread" class="u-pull-right">
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
