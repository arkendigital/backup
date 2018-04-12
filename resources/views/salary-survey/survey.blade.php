@extends("layouts.master")

@section("content")

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




    <form action="" method="POST" id="salary-survey-form">

      {{ csrf_field() }}
      {{ method_field("POST") }}

      <input type="hidden" id="type" name="type" value="">
      <input type="hidden" id="sector" name="sector" value="">
      <input type="hidden" id="field" name="field" value="">
      <input type="hidden" id="experience" name="experience" value="">
      <input type="hidden" id="qualifications" name="qualifications" value="">

      <!-- Q1 -->
      <div class="salary-survey-question-container">
        <div class="salary-survey-question-number-wrap">
          <span class="salary-survey-question-number">Q1</span>
        </div>

        <div class="salary-survey-question-wrap">

          <p class="salary-survey-question-title">Are you either...</p>

          <div class="salary-survey-question-answer-row">
            <div class="salary-survey-question-answer-clickable salary-survey-question-answer-clickable-type" data-key="type" data-value="permanent">Permanent</div>
            <input class="salary-survey-question-answer-input" name="annual_salary" placeholder="Enter annual salary">
          </div>

          <div class="salary-survey-question-answer-row">
            <div class="salary-survey-question-answer-clickable salary-survey-question-answer-clickable-type" data-key="type" data-value="contractor">Contractor</div>
          </div>

        </div>
      </div>
      <!-- / Q1 -->

      <!-- Q2 -->
      <div class="salary-survey-question-container">
        <div class="salary-survey-question-number-wrap">
          <span class="salary-survey-question-number">Q2</span>
        </div>

        <div class="salary-survey-question-wrap">

          <p class="salary-survey-question-title">What sector do you cover?</p>

          <div class="salary-survey-question-answer-row">
            <div class="salary-survey-question-answer-clickable salary-survey-question-answer-clickable-sector" data-key="sector" data-value="life">Life</div>
            <div class="salary-survey-question-answer-clickable salary-survey-question-answer-clickable-sector" data-key="sector" data-value="gi">GI</div>
            <div class="salary-survey-question-answer-clickable salary-survey-question-answer-clickable-sector" data-key="sector" data-value="health">Health</div>
            <div class="salary-survey-question-answer-clickable salary-survey-question-answer-clickable-sector" data-key="sector" data-value="investments">Investments</div>
            <div class="salary-survey-question-answer-clickable salary-survey-question-answer-clickable-sector" data-key="sector" data-value="other">Other</div>
          </div>

          <p class="salary-survey-question-title">What field do you work in?</p>

          <div class="salary-survey-question-answer-row">
            <div class="salary-survey-question-answer-clickable salary-survey-question-answer-clickable-field" data-key="field" data-value="consultancy">Consultancy</div>
            <div class="salary-survey-question-answer-clickable salary-survey-question-answer-clickable-field" data-key="field" data-value="insurance">Insurance</div>
            <div class="salary-survey-question-answer-clickable salary-survey-question-answer-clickable-field" data-key="field" data-value="reinsurance">Reinsurance</div>
          </div>

        </div>
      </div>
      <!-- / Q2 -->

      <!-- Q3 -->
      <div class="salary-survey-question-container">
        <div class="salary-survey-question-number-wrap">
          <span class="salary-survey-question-number">Q3</span>
        </div>

        <div class="salary-survey-question-wrap">

          <p class="salary-survey-question-title">Your experience</p>

          <div class="salary-survey-question-answer-row">
            <div class="salary-survey-question-answer-clickable salary-survey-question-answer-clickable-experience" data-key="experience" data-value="1-4">1-4 years</div>
            <div class="salary-survey-question-answer-clickable salary-survey-question-answer-clickable-experience" data-key="experience" data-value="5-9">5-9 years</div>
            <div class="salary-survey-question-answer-clickable salary-survey-question-answer-clickable-experience" data-key="experience" data-value="10-14">10-14 years</div>
            <div class="salary-survey-question-answer-clickable salary-survey-question-answer-clickable-experience" data-key="experience" data-value="15-19">15-19 years</div>
            <div class="salary-survey-question-answer-clickable salary-survey-question-answer-clickable-experience" data-key="experience" data-value="20+">20+</div>
          </div>

        </div>
      </div>
      <!-- / Q3 -->

      <!-- Q4 -->
      <div class="salary-survey-question-container">
        <div class="salary-survey-question-number-wrap">
          <span class="salary-survey-question-number">Q4</span>
        </div>

        <div class="salary-survey-question-wrap">

          <p class="salary-survey-question-title">Your experience</p>

          <div class="salary-survey-question-answer-row">
            <div class="salary-survey-question-answer-clickable salary-survey-question-answer-clickable-qualifications" data-key="qualifications" data-value="1-4">1-4 exams</div>
            <div class="salary-survey-question-answer-clickable salary-survey-question-answer-clickable-qualifications" data-key="qualifications" data-value="5-9">5-9 exams</div>
            <div class="salary-survey-question-answer-clickable salary-survey-question-answer-clickable-qualifications" data-key="qualifications" data-value="10-12">10-12 exams</div>
            <div class="salary-survey-question-answer-clickable salary-survey-question-answer-clickable-qualifications" data-key="qualifications" data-value="13+">13+ exams</div>
            <div class="salary-survey-question-answer-clickable salary-survey-question-answer-clickable-qualifications" data-key="qualifications" data-value="Qualified">Qualified</div>
          </div>

        </div>
      </div>
      <!-- / Q4 -->





      <div class="salary-survey-footer">

        <div id="salary-survey-footer-before-submission">
          <button type="submit">Submit</button>
        </div>

        <div id="salary-survey-footer-after-submission" style="display: none;">
          Thank you for taking part
          <a href="/salary-survey/results"><button type="button">See results</button></a>
          <button type="button">Discuss Salaries</button>

          Looking for more detailed results?
          <button type="button">Download here</button>
        </div>

      </div>

    </form>

    <div class="clear"></div>

    @include('partials.carousel-ticker')

    <div class="clear margin-bottom--medium"></div>

    @if(isset($page_adverts[0]["main-content"]))
      @include('partials.advert', [
        'advert' => $page_adverts[0]["main-content"]
      ])
    @endif

  </div><!-- /.website-container -->


  @include("widgets.loop")

  @include("partials.join-discussion", [
    "category_id" => $page->discussion_category_id
  ])

@endsection
