<!-- BEGIN .forum-post -->
<div class="box box--with-margin" id="post-{{ $post->id }}">
    <span class="box__title">
        @if ($posts->currentPage() > 1)
        <a href="#post-{{ $post->id }}">
            #{{ (($posts->currentPage() -1) * 10) + $loop->iteration  }}
        </a>
        @else
        <a href="#post-{{ $post->id }}">
            #{{ $loop->iteration  }}
        </a>
        @endif
        <span class="u-pull-right" title="{{ $post->created_at }}">
            {{ $post->created_at->diffForHumans() }}
        </span>
    </span>
    {{-- START USERINFO  --}}
    <div class="col-3">
        @if ($post->profile)
        <div class="post__name">
            <a href="/&#64;{{ $post->profile->slug }}">{{ $post->profile->display_name }}</a>
            @if ( $post->user->isOnline() )
                <span class="status-online" title="{{$post->profile->display_name}} is online now!"></span>
            @else
                <span class="status-offline" title="{{$post->profile->display_name}} is offline"></span>
            @endif
            <p class="post__usertitle">{{ strip_tags($post->profile->user_title) }}</p>
        </div>

        <div class="post__avatar" style="background-image: url({{ $post->profile->avatar }})"></div>

        <br />
        <p class="post__xp">
            <strong>{{ $post->user->xp->points }}</strong> XP
        </p>
        <hr/>
        <p class="stats">
            <i class="fa fa-calendar-check-o" aria-hidden="true"></i>
            Registered on <strong>{{ $post->user->created_at->format('jS F Y')}}</strong>
        </p>
        <p class="stats">
            <i class="fa fa-upload" aria-hidden="true"></i>
            <strong>XYZ</strong> Files Uploaded
        </p>
        <p class="stats">
            <i class="fa fa-comments" aria-hidden="true"></i> <strong>{{ $post->profile->post_count }}</strong> Posts Made
        </p>
        <p class="stats">
            <i class="fa fa-pencil" aria-hidden="true"></i> <strong>{{ $post->profile->thread_count }}</strong> Threads Made
        </p>
        <p class="stats">
            <i class="fa fa-thumbs-up" aria-hidden="true"></i> <strong>XYZ</strong> Post Reactions
        </p>
        @else
         <div class="post__name">
            <a href="/page/why-am-i-seeing-guest-users">Guest</a>
            <span class="status-offline"></span>
            <p class="post__usertitle">I didn't make it!</p>
        </div>
        <div class="post__avatar" style="background-image: url({{asset('images/defaults/avatar_default.jpg')}});"></div>
        @endif
    </div>
    {{-- END USERINFO  --}}
    {{-- BEGIN POST --}}
    <div class="col-9">
        {!! $post->content !!}

        <div class="reaction-strip">
            <div class="u-pull-right">
                @if (auth()->check())
                    @if ($post->profile)
                        @if ($post->user->id == auth()->user()->id)
                            @include('forums.posts.reaction_strip_disabled')
                        @else
                            @if ( ! $post->reactions->where('user_id', auth()->user()->id)->where('post_id', $post->id)->first() )
                                @include('forums.posts.reaction_strip')
                            @else
                                @include('forums.posts.reaction_strip_disabled')
                            @endif
                        @endif
                    @endif
                @endif
            </div>
            &nbsp;
        </div>

        <div class="clear"></div>

        <hr>
        @if ($post->profile)
            @if ($post->profile->signature)
                <div class="signature-container">
                    <p class="signature-container">{!! $post->profile->signature !!}</p>
                </div>
                <p class="clear"></p>
                <br><br>
            @else
            <br><br>
            @endif
        @else
            <br><br>
        @endif

        @if ($post->hasBeenEdited())
        <p>
            <em>Last edited by <strong>{{ $post->lastEditedBy()->profile->display_name }}</strong> {{ $post->updated_at->diffForHumans() }}</em>
        </p>
        @endif


        <div class="box__footer">
            @if (auth()->check())
                
                <div id="quote{{ $post->id }}" style="display: none;">
                   <blockquote>{!! $post->content !!} 
                    @if ($post->profile)
                        <cite>Posted by {{ $post->profile->display_name }}</cite>
                    @endif
                    </blockquote>
                    <br />
                </div>
                @push ('scripts-after')
                <script type="text/javascript">
                    function copy{{ $post->id }}(copyquote{{ $post->id }}) {
                        var textToCopy = document.getElementById("quote{{ $post->id }}").innerHTML;

                        var editor = $('.js-editor').ckeditor().editor;
                        editor.insertHtml(textToCopy);
                        // $('.js-editor').val(textToCopy);
                        // $('.js-editor').trumbowyg('html', textToCopy);
                    }
                </script>
                @endpush

                <a href="#quick-reply" onclick="copy{{ $post->id }}('copyquote{{ $post->id }}');" class="u-pull-right button icon small">
                    <i class="fa fa-quote-left"></i> Quote
                </a>
                <a class="u-pull-right button red icon small" id="report-post-{{$post->id}}">
                    <i class="fa fa-warning"></i> Report
                </a>
                @if (!$post->user)
                    @if (auth()->user()->isStaff())
                        <a href="{{ route('editPost', [$thread->forum, $thread, $post]) }}" class="u-pull-right button blue small icon">
                            <i class="fa fa-pencil"></i> Edit
                        </a>
                        @if (!$loop->first)
                            <a class="u-pull-right button red small icon" id="delete-post-{{$post->id}}">
                                <i class="fa fa-trash"></i> Delete
                            </a>
                        @endif
                        <form action="{{ route('deletePost', [$thread->forum, $thread, $post]) }}" id="delete-post-form-{{$post->id}}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                        </form>
                        @push('scripts-after')
                            @include('inline-scripts.posts.delete-post-js', $post)
                        @endpush
                    @endif
                @else
                    @if ((auth()->user()->id == $post->user->id) || (auth()->user()->isStaff()))
                        <a href="{{ route('editPost', [$thread->forum, $thread, $post]) }}" class="u-pull-right button blue small icon">
                            <i class="fa fa-pencil"></i> Edit
                        </a>
                        @if (!$loop->first)
                            <a class="u-pull-right button red small icon" id="delete-post-{{$post->id}}">
                                <i class="fa fa-trash"></i> Delete
                            </a>
                        @endif
                        <form action="{{ route('deletePost', [$thread->forum, $thread, $post]) }}" id="delete-post-form-{{$post->id}}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                        </form>
                        @push('scripts-after')
                            @include('inline-scripts.posts.delete-post-js', $post)
                        @endpush
                    @endif
                @endif
            @else
                <a href="{{ route('login') }}" class="u-pull-right button icon small">
                    <i class="fa fa-info"></i> Login or Sign Up to participate
                </a>
            @endif

            @push('scripts-after')
                @include('inline-scripts.posts.report-post-js', $post)
            @endpush
        </div>
    </div>
    {{-- END POST --}}
</div>
