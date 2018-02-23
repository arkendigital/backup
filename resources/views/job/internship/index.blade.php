@extends("layouts.master")

@section("content")

  <div class="section-hero" style="background-image: url(/images/temp/jobs-section-hero-bg.png); border-color: #d62731;"></div>

  <div class="website-container view-section">
    <div class="website-container-content">

      <h1>{{ $page->section->name }}</h1>
      <h2>{{ $page->getField("page_title") }}</h2>

      <p>{!! $page->getField("page_content") !!}</p>

      {{--
      <h3>See our university pages <a href="">here</a></h3>

      <h2>Ask an actuary</h2>
      <p>Uteos enisciaspe ma dolorpo rerunti oreseque di ulparum etur seque vellaut int facea am inci uscius. Con comnis alictatus veligni hillessequia core</p>

      <a href="" class="button button--dark-blue">Click</a>
      --}}

    </div>
    <div class="website-container-sidebar">
      @include("partials.sidebar.jobs", ["key" => "internships"])
    </div>

    <div class="clear"></div>

    <img src="/images/temp/jobs-advertise-banner.png" alt="" title="">

  </div><!-- /.website-container -->

  @include("partials.latest-jobs", [
    "status_id" => 3
  ])
  @include("partials.join-discussion", [
    "category_id" => $page->discussion_category_id
  ])

@endsection
