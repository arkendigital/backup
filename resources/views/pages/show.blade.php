@extends('layouts.master')

@section('content')
{{-- <div class="gamefront__container" style="margin-top: 10px;">
    @if ($page->image)
    <div class="box profile__header"
         style='background-image: url("{{asset($page->image)}}"); min-height: 300px; margin-top: 20px;'>
    </div>
    @endif
    <div class="box box--with-margin">
        <h3 class="forum__category">{{$page->title}}</h3>
        <p>{!! $page->body !!}</p>
    </div>
</div> --}}

  <div class="section-hero" style="background-image: url({{ $page->section->image }}); border-color: {{ $page->section->color }};"></div>

  <div class="website-container">
    <div class="website-container-content view-section">

      <h1>{{ $page->getField("page_title") }}</h1>

      {!! $page->getField("page_content") !!}

    </div>

    <div class="website-container-sidebar">
      @include("partials.sidebar", [
        "sidebar" => $page->section->sidebar
      ])
    </div>

    <div class="clear"></div>

    @include('partials.carousel-ticker')
  </div><!-- /.website-container -->

  @include("widgets.loop")

  @include("partials.join-discussion", [
    "advert" => isset($page_adverts[0]["discussion-widget"]) ? $page_adverts[0]["discussion-widget"] : [],
    "category_id" => $page->discussion_category_id
  ])

@endsection
