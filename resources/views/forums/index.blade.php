@extends('layouts.master')

@section('breadcrumbs')
    {{ Breadcrumbs::render() }}
@endsection

@section('content')
<section class="forums">
    @include('forums.partials.latest-threads-buttons')

    {{-- DANNY DONT TOUCH BELOW PLS --}}
    @foreach ($categories as $category)
        @if (auth()->guest())
        <div class="forums__container">
            @if (in_array('Guest', $category->roles))
            <div class="box box--with-margin">
                @include('forums.partials.category', $category)
                @foreach ($category->forums as $forum)
                    @if (in_array('Guest', $forum->roles))
                        @if ($forum->parent == 0)
                            @include('forums.partials.forum', $forum)
                        @endif
                    @endif
                @endforeach
            </div>
            @endif
        </div>
        @else
            @hasanyrole($category->roles)
            <div class="forums__container">
                <div class="box box--with-margin">
                    @include('forums.partials.category', $category)
                    @foreach ($category->forums as $forum)
                    @hasanyrole($forum->roles)
                        @if ($forum->parent == 0)
                            @include('forums.partials.forum', $forum)
                        @endif
                    @endhasanyrole
                    @endforeach
                </div>
            </div>
            @endhasanyrole
        @endif
    @endforeach
    {{-- DANNY DONT TOUCH ABOVE PLS --}}

    @if (auth()->check())
    @include('forums.partials.onlinelist')
    @endif
</section>
@endsection
