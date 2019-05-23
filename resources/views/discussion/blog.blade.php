@extends("layouts.master")

@section("content")

  <div class="discussion-top-bar"></div>

  <div class="discussion-container">
    <div class="discussion-container-inner">
      <div class="row">
        <h1 class="discussion-page-title" style="margin: 50px 0px 25px 0;">Discussion</h1>
      </div>

      @if(!auth()->check())
        {{-- <a class="discussion-add-button" href="{{ route("login") }}?from={{ url()->full() }}">Login to Chat</a> --}}
      @endif

      <div class="clear"></div>

      @include("discussion.sidebar_blog")

      <div class="discussion-list-container margin-bottom--medium view-section" style="margin: 0px;">
        <h2 class="dicussion-page-subtitle">What Automation Means for Actuaries</h2>
        @if(! str_contains($article->image, 'placeholder')) 
            <div class="section-hero" style="background-image: url({{ asset($article->image) }}); border-color: #0d72b9;border-bottom:0px;"></div>
        @endif
        {!! $article->body !!}
      </div>

    </div>
  </div>

  @if(isset($page_adverts[0]["main-content"]))
    @include('partials.advert', [
      'advert' => $page_adverts[0]["main-content"]
    ])
  @endif

  @include("discussion.partials.create")

  @push("scripts-after")
      <script src='https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.4/latest.js?config=TeX-MML-AM_CHTML' async></script>

      @if(session("new_user"))
          <script>dataLayer.push({'event' : 'gtm.formSubmit', 'formName' : 'signup'});</script>
      @endif

  @endpush

@endsection
