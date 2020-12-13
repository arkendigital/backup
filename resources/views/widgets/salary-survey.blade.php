<div class="box-select box-select--dark-blue" style="background-image:url(/images/temp/homepage-wealth-information-bg.png);">
  <div class="box-select-container">

    <p class="box-select-title">{{ $page->getField("wealth_info_title") }}</p>
    <p class="box-select-text">{{ $page->getField("wealth_info_sub_title") }}</p>

    <a class="box-select-item" href="/actuary-jobs">{{ $page->getField("wealth_info_vacancies_text") }}</a>
    <a class="box-select-item" href="/salary-survey/take-part">{{ $page->getField("wealth_info_survays_text") }}</a>
    <a class="box-select-item" href="/salary-survey/results">{{ $page->getField("wealth_info_salary_text") }}</a>

    <div class="clear"></div>

    <a href="/discussion" class="box-select-button margin-top--small">{{ $page->getField("wealth_info_discussion_button") }}</a>

  </div>
</div><!-- /.box-select -->
