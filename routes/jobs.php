<?php
  Route::redirect('/jobs/vacancies', '/jobs');
Route::namespace('Job')->prefix('jobs')->group(function() {
  Route::get('/vacancies-per-page/{perPage}', 'JobVacanciesController@perPage');
  // Route::get('/vacancies', 'JobVacanciesController@index');
  Route::get('/', 'JobVacanciesController@index');
  Route::post('/vacancies', 'JobVacanciesController@set_filtering');
  Route::get('/vacancies/{job}', 'JobVacanciesController@view')->name('job.show');
  Route::post('/vacancies/{id}/track', 'JobVacanciesController@track');
  Route::get('/advertise-with-us', 'JobAdvertiseController@index');
  Route::post('/advertise-with-us', 'JobAdvertiseController@submit');
  Route::get('/internships', 'JobInternshipController@index');
  Route::get('/graduate-jobs', 'JobGraduateController@index');
});
