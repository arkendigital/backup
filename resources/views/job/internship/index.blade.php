@extends("layouts.master")

@section("content")

  <div class="section-hero" style="background-image: url(/images/temp/jobs-section-hero-bg.png); border-color: #d62731;"></div>

  <div class="website-container">
    <div class="website-container-content view-section">

      <h1>{{ $page->section->name }}</h1>
      <h2>{{ $page->getField("page_title") }}</h2>

      <p>{!! $page->getField("page_content") !!}</p>

      <h3>See internships <a onclick="document.getElementById('searchInternshipJobsForm').submit()" class="cursor-pointer">here</a></h3>

      <h3>See internship employers <a href="{{ url('/uni-corner/actuarial-employers') }}">here</a></h3>

      <form action="/actuary-jobs" method="POST" id="searchInternshipJobsForm" style="display: none;">
        {{ csrf_field() }}
        {{ method_field("POST") }}

        <input type="checkbox" name="status[]" value="3" checked>

      </form>

    </div>

    <div class="website-container-sidebar">
      @include("partials.sidebar", [
        "sidebar" => $page->section->sidebar
      ])
    </div>

    <div class="clear"></div>

    @if(isset($page_adverts[0]["main-content"]))
      @include('partials.advert', [
        'advert' => $page_adverts[0]["main-content"]
      ])
    @endif

  </div><!-- /.website-container -->

  @include("partials.latest-jobs", [
    "status_id" => 3
  ])

  @include("partials.join-discussion", [
    "category_id" => $page->discussion_category_id
  ])

@endsection
