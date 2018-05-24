<?php
Route::namespace('SalarySurvey')->prefix('salary-survey')->group(function() {

  /**
  * Main salary content page.
  *
  */
  Route::get('/', 'SalarySurveyController@index');

  /**
  * Take part questionnaire.
  *
  */
  Route::get('/take-part', 'TakePartController@index');

  /**
  * Submission of questionnaire.
  *
  */
  Route::post('/take-part', 'TakePartController@submit');

  /**
  * Show salary survey results.
  *
  */
  Route::get('/results', 'ResultsController@index');

  /**
  * Download salary survey results
  *
  */
  Route::get('/download', 'ResultsController@download');

});
