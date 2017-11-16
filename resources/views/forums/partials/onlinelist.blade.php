<div class="gamefront__container">
    <div class="box box--with-margin">
        <span class="box__title">{{ $onlineUsers->count() }} Users Online (within the last 10 minutes)</span>
        <div class="box__content">
            @foreach ($onlineUsers as $activity)
                <a href="{{ route('me', $activity->user->profile) }}">{{$activity->user->profile->display_name}}</a> @if (!$loop->last),@endif
            @endforeach
        </div>
    </div>
</div>
