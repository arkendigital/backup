@extends("layouts.master")

@section("content")
    <style>
        
        @media only screen and (max-width: 499px){
            .support_block_layer_1{
                width: 100% !important;
            }
        }
        
        @media (min-width: 500px) and (max-width: 767px) {
            
            .support_block_layer_1{
                width:50%;
            }
            .support_block_layer_1:nth-child(2n+1){
                clear:left;
            }
        }
        @media (min-width: 768px) and (max-width: 991px) { 
            .support_block_layer_1{
                width:50%;
            }
            .support_block_layer_1:nth-child(2n+1){
                clear:left;
            }
        }
        @media (min-width: 992px) and (max-width: 1199px) {
            .support_block_layer_1{
                width:33.333% !important;
            }
            .support_block_layer_1:nth-child(3n+1){
                clear:left;
            }   
        }
        @media (min-width: 1200px){
            .support_block_layer_1{
                width:33.333% !important;
            }
            .support_block_layer_1:nth-child(3n+1){
                clear:left;
            }  
        }
    </style>

  <div class="section-hero" style="background-image: url({{ 'storage/'.$section->image_path }}); border-color: {{ $section->color }};"></div>

  <div class="website-container view-section">
    <div class="website-container-content">

      <h1>{{ $page->getField("page_title") }}</h1>

      {!! $page->getField("page_content") !!}

    </div>
    <div class="website-container-sidebar">
      @include("partials.sidebar", [
        "sidebar" => $page->section->sidebar
      ])
    </div>

    <div class="clear"></div>

    <div class="row">
        @foreach ($supportBlocks as $supportBlock)
        <div class="col-md-4 col-sm-6 col-xs-12 support_block_layer_1">
            <div class="article">
                <a href="{{route('support-block-items',$supportBlock->id)}}">
                    <div class="article__image" style="background-image: url({{ asset(env('LOCAL_URL').$supportBlock->image) }}"></div>
                </a>
                <div class="article__title">
                    <a href="{{route('support-block-items',$supportBlock->id)}}">{{ str_limit($supportBlock->title, 50) }}</a>
                </div>
                <div class="article__teaser">
                    {{  $supportBlock->subtitle }}
                </div>
            </div>
        </div>
        @endforeach
    </div>

  </div><!-- /.website-container -->

  @include("partials.join-discussion", [
    "advert" => isset($page_adverts[0]["discussion-widget"]) ? $page_adverts[0]["discussion-widget"] : [],
    "category_id" => $page->discussion_category_id
  ])

@endsection
