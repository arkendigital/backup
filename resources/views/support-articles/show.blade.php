@extends("layouts.master")

@section("content")

@if(! str_contains($article->image, 'placeholder')) 
<div class="section-hero" style="background-image: url({{ asset($article->image) }}); border-color: #0d72b9;"></div>
@endif

<div class="website-container">
    <div class="website-container-content website-container-blog view-section">
        <h1>{{ $article->title }}</h1>
        
        {!! $article->body !!}
    </div>
    <div class="website-container-sidebar website-container-sidebar--social">
        <h4 class="sidebar-menu--title">Author: {{ ($article->author)? $article->author : $article->user->name }}</h4>
        <span class="muted">{{ $article->created_at->diffForHumans() }}</span>
        <div>
            <a href="https://www.facebook.com/sharer/sharer.php?u={{ env('APP_URL') }}/news/{{ $article->slug }}" target="_blank" class="article__social article__social--facebook"><i class="fab fa-facebook"></i></a>
            <a href="https://twitter.com/intent/tweet?url={{ env('APP_URL') }}/news/{{ $article->slug }}" target="_blank" class="article__social article__social--twitter"><i class="fab fa-twitter-square"></i></a>
        </div>
    </div>
</div>


@endsection