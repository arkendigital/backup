@extends("layouts.master")

@section("content")

<div class="website-container">
    
    <div class="website-container-content view-section">
        <h1>Blogs</h1>    
    </div>
    
    <div class="blogs">
        
        <div class="row">
            @foreach ($articles as $article)
            <div class="col-4">
                <div class="article">
                    <a href="{{route('showArticle', $article)}}">
                        <div class="article__image" style="background-image: url({{ asset($article->image) }}"></div>
                    </a>
                    <div class="article__title">
                        <a href="{{route('showArticle', $article)}}">{{ str_limit($article->title, 50) }}</a>
                    </div>
                    <div class="article__teaser">
                        {!! str_limit(strip_tags($article->body), 100) !!}
                    </div>
                    <div class="article__button">
                        <a href="{{route('showArticle', $article)}}" class="button button--dark-blue">Read More</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="discussion-pagination">
            {{ $articles->links() }}
        </div>
    </div>    
</div>

@push('scripts-after')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.matchHeight/0.7.2/jquery.matchHeight-min.js"></script>
<script>
    $('.article').matchHeight();
    $('.article__title').matchHeight();
</script>
@endpush

@endsection
