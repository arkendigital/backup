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

    <div class="survey-container">

      <form action="" method="POST" id="survey-form">
        {{ csrf_field() }}
        {{ method_field("POST") }}

        <input type="hidden" name="module_id" id="module_id" value="">
        <input type="hidden" name="difficulty" id="difficulty" value="">

        <span class="survey-title">Questions</span>

        <span class="survey-sub-title">Which exam did you take?</span>
        <div class="survey-answer-container">
          @foreach($categories as $category)
            <div class="survey-answer survey-answer-cat survey-answer-has-dropdown" id="survey-answer-cat-{{ $category->id }}">
              <span class="survey-answer-icon-wrap">
                <span id="survey-answer-category-{{ $category->id }}">{{ $category->name }}</span>
                <i class="fas fa-angle-down survey-answer-icon"></i>
              </span>

              <div class="survey-answer-dropdown">
                @foreach($category->getModules() as $module)
                  <span class="survey-answer-dropdown-item" data-module-id="{{ $module->id }}" data-module-name="{{ $module->name }}" data-category-id="{{ $category->id }}">
                    {{ $module->name }}
                  </span>
                @endforeach
              </div>
            </div>
          @endforeach
        </div>

        <span class="survey-sub-title">How did you find it?</span>
        <div class="survey-answer-container">
          <div class="survey-answer survey-answer-difficulty" data-difficulty="easy">Easy</div>
          <div class="survey-answer survey-answer-difficulty" data-difficulty="moderate">Moderate</div>
          <div class="survey-answer survey-answer-difficulty" data-difficulty="difficult">Difficult</div>
        </div>

        <div class="clear"></div>

        <a class="survey-button survey-button-add">Submit Answers</a>
        <a class="survey-button" href="/exams/survey/results">Show Results</a>

      </form>

    </div><!-- /.survey-container -->

    <div class="clear"></div>

    @include('partials.carousel-ticker')

  </div><!-- /.website-container -->

  @include("widgets.loop")

  @include("partials.join-discussion", [
    "advert" => isset($page_adverts[0]["discussion-widget"]) ? $page_adverts[0]["discussion-widget"] : [],
    "category_id" => $page->discussion_category_id
  ])

@endsection
