@extends("layouts.master")

@section("content")

<div class="website-container">
    
    <div class="website-container-content view-section">
        <h1>{{ $block->title }} Support Articles</h1>    
    </div>
    
    <div class="blogs">
        
        <div class="row">
            @foreach ($blockItems as $blockItem)
            <div class="col-4">
                <div class="article">
                    <a href="{{ url('support-articles/'.$blockItem->slug) }}">
                        <div class="article__image" style="background-image: url({{ asset(env('LOCAL_URL').$blockItem->image) }}"></div>
                    </a>
                    <div class="article__title">
                        <a href="{{route('show-support-article', $blockItem->slug)}}">{{ str_limit($blockItem->title, 50) }}</a>
                    </div>
                    <div class="article__teaser">
                        {{  $blockItem->subtitle }}
                    </div>
                    <div class="article__button">
                        <a href="{{route('show-support-article', $blockItem->slug)}}" class="button button--dark-blue">Read More</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="discussion-pagination">
            {{ $blockItems->links() }}
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
