@extends("layouts.master")

@section("content")

  <div class="section-hero" style="background-image: url(/images/temp/cvsupport-section-hero-bg.png); border-color: {{ $section->color }};"></div>

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
        <div class="col-4">
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
