<?php
Route::namespace('Exam')->prefix('exams')->group(function() {
  Route::get('/', 'ExamController@index');
  Route::get('/resources', 'ExamResourcesController@index');
  Route::get('/resources/{exam_resource}', 'ExamResourcesController@view');
  Route::get('/useful-links', 'ExamLinksController@index');
  Route::get('/individual-exams', 'ExamIndividualController@index');
  Route::get('/exam-survey', 'ExamSurveyController@index');
  Route::post('/exam-survey', 'ExamSurveyController@submit');
  Route::get('/survey/results', 'ExamSurveyController@results');
  Route::get('/centres', 'ExamCentreController@index');
  Route::post('/centres', 'ExamCentreController@search');
  
  Route::get('/{slug}', 'ExamIndividualController@moduleList');
});