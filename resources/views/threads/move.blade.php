@extends('layouts.master')

@section('content')
<section class="site">
    <div class="site__container">
        <div class="box">
            <span class="box__title">Move Thread: {{ $thread->title }} from {{ $thread->forum->name }}</span>
            <form action="{{ route('processMoveThread', [$thread->forum, $thread]) }}" method="post" class="form">
                {{csrf_field()}}
                <div class="box__content">
                    <div class="form__group">
                        <label for=""></label>
                        <select name="forum_id" id="forum_id" class="form__input">
                            @foreach ($categories as $category)
                            <optgroup label="{{ $category->name }}">
                                @foreach ($category->forums as $forum)
                                <option value="{{ $forum->id }}" @if ($forum->id == $thread->forum->id) selected @endif>
                                    {{ $forum->name }}
                                    @if ($forum->id == $thread->forum->id) (current) @endif
                                </option>
                                @endforeach
                            </optgroup>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="u-pull-right">
                    <input type="submit" value="Move Thread">
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
