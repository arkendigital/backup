<?php
Route::namespace('Job')->prefix('jobs')->group(function() {
  Route::get('/', 'JobController@index');
  Route::get('/vacancies', 'JobVacanciesController@index');
  Route::post('/vacancies', 'JobVacanciesController@set_filtering');
  Route::get('/vacancies/{job}', 'JobVacanciesController@view');
  Route::get('/advertise-with-us', 'JobAdvertiseController@index');
  Route::post('/advertise-with-us', 'JobAdvertiseController@submit');
  Route::get('/internships', 'JobInternshipController@index');
  Route::get('/graduate-jobs', 'JobGraduateController@index');
});
