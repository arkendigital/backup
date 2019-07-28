@extends("layouts.master")

@section("content")
<style>
        
        @media only screen and (max-width: 499px){
            .support_block_layer_2{
                width: 100% !important;
            }
        }
        
        @media (min-width: 500px) and (max-width: 767px) {
            
            .support_block_layer_2{
                width:50%;
            }
            .support_block_layer_2:nth-child(2n+1){
                clear:left;
            }
        }
        @media (min-width: 768px) and (max-width: 991px) { 
            .support_block_layer_2{
                width:50%;
            }
            .support_block_layer_2:nth-child(2n+1){
                clear:left;
            }
        }
        @media (min-width: 992px) and (max-width: 1199px) {
            .support_block_layer_2{
                width:33.333% !important;
            }
            .support_block_layer_2:nth-child(3n+1){
                clear:left;
            }   
        }
        @media (min-width: 1200px){
            .support_block_layer_2{
                width:33.333% !important;
            }
            .support_block_layer_2:nth-child(3n+1){
                clear:left;
            }  
        }
    </style>

<div class="website-container">
    
    <div class="website-container-content view-section">
        <h1>{{ $block->title }}</h1>    
    </div>
    
    <div class="blogs">
        
        <div class="row">
            @foreach ($blockItems as $blockItem)
            <div class="col-md-4 col-sm-6 col-12 support_block_layer_2">
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
