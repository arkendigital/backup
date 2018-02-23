<?php
Route::namespace('Exam')->prefix('exams')->group(function() {
  Route::get('/', 'ExamController@index');
  Route::get('/resources', 'ExamResourcesController@index');
  Route::get('/resources/{exam_resource}', 'ExamResourcesController@view');
  Route::get('/useful-links', 'ExamLinksController@index');
});
