@if (auth()->check())
    <button id="like" data-post-id="{{ $post->id }}" data-user-id="{{ auth()->user()->id }}" data-tooltip="Like" class="post-likes reaction disabled" disabled="disabled">
        <img src="{{ asset('images/reactions/thumbsup.png') }}" />
        @if ( $post->reactions->where('reaction', 'like')->count() == 0)
            <span class="total hide">{{ $post->reactions->where('reaction', 'like')->count() }}</span>
        @else
            <span class="total">{{ $post->reactions->where('reaction', 'like')->count() }}</span>
        @endif
    </button>


    <button id="joy" data-post-id="{{ $post->id }}" data-user-id="{{ auth()->user()->id }}" data-tooltip="Joy" class="post-likes reaction disabled" disabled="disabled">
        <img src="{{ asset('images/reactions/smile.png') }}" />
        @if ( $post->reactions->where('reaction', 'joy')->count() == 0)
            <span class="total hide">{{ $post->reactions->where('reaction', 'joy')->count() }}</span>
        @else
            <span class="total">{{ $post->reactions->where('reaction', 'joy')->count() }}</span>
        @endif
    </button>

    <button id="cry" data-post-id="{{ $post->id }}" data-user-id="{{ auth()->user()->id }}" data-tooltip="Cry" class="post-likes reaction disabled" disabled="disabled">
        <img src="{{ asset('images/reactions/disappointed.png') }}" />
        @if ( $post->reactions->where('reaction', 'cry')->count() == 0)
            <span class="total hide">{{ $post->reactions->where('reaction', 'cry')->count() }}</span>
        @else
            <span class="total">{{ $post->reactions->where('reaction', 'cry')->count() }}</span>
        @endif
    </button>

    <button id="love" data-post-id="{{ $post->id }}" data-user-id="{{ auth()->user()->id }}" data-tooltip="Love" class="post-likes reaction disabled" disabled="disabled">
        <img src="{{ asset('images/reactions/heart.png') }}" />
        @if ( $post->reactions->where('reaction', 'heart_eyes')->count() == 0)
            <span class="total hide">{{ $post->reactions->where('reaction', 'heart_eyes')->count() }}</span>
        @else
            <span class="total">{{ $post->reactions->where('reaction', 'heart_eyes')->count() }}</span>
        @endif
    </button>


    <button id="expressionless" data-post-id="{{ $post->id }}" data-user-id="{{ auth()->user()->id }}" data-tooltip="Expressionless" class="post-likes reaction disabled" disabled="disabled">
        <img src="{{ asset('images/reactions/expressionless.png') }}" />
        @if ( $post->reactions->where('reaction', 'expressionless')->count() == 0)
            <span class="total hide">{{ $post->reactions->where('reaction', 'expressionless')->count() }}</span>
        @else
            <span class="total">{{ $post->reactions->where('reaction', 'expressionless')->count() }}</span>
        @endif
    </button>

    <button id="tada" data-post-id="{{ $post->id }}" data-user-id="{{ auth()->user()->id }}" data-tooltip="angry" class="post-likes reaction disabled" disabled="disabled">
        <img src="{{ asset('images/reactions/angry.png') }}" />
        @if ( $post->reactions->where('reaction', 'angry')->count() == 0)
            <span class="total hide">{{ $post->reactions->where('reaction', 'angry')->count() }}</span>
        @else
            <span class="total">{{ $post->reactions->where('reaction', 'angry')->count() }}</span>
        @endif
    </button>


@endif
