@extends("layouts.master")

@section("content")

  <div class="section-hero" style="background-image: url({{ $page->section->image }}); border-color: {{ $page->section->color }};"></div>

  <div class="website-container">
    <div class="website-container-content view-section">

      <h1>{{ $page->getField("page_title") }}</h1>

      @if(isset($category->name))
        <h2>{{ $category->name }}</h2>
      @endif

      {!! $page->getField("page_content") !!}

    </div>
    <div class="website-container-sidebar">
      @include("partials.sidebar", [
        "sidebar" => $page->section->sidebar
      ])
    </div>

    <div class="clear"></div>

    <div class="survey-results-container">
      <span class="survey-results-title">Results</span>
      @foreach($categories as $category)
        <table class="survey-results-table">
          <thead>
            <tr>
              <th>EXAM</th>
              <th class="bg-green">EASY</th>
              <th class="bg-orange">MODERATE</th>
              <th class="bg-red">DIFFICULT</th>
            </tr>
          </thead>
          <tbody>
            @foreach($category->getModules() as $module)
              <tr>
                <th>{{ $module->name }}</th>
                <td>{{ $module->getSurveyPercentage($module->getSurveyResult($module->id, "easy"), $module->getSurveyTotal($module->id), 2) }}</td>
                <td>{{ $module->getSurveyPercentage($module->getSurveyResult($module->id, "moderate"), $module->getSurveyTotal($module->id)) }}</td>
                <td>{{ $module->getSurveyPercentage($module->getSurveyResult($module->id, "difficult"), $module->getSurveyTotal($module->id)) }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      @endforeach
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
