<?php
Route::redirect('/jobs', '/jobs/vacancies');
Route::namespace('Job')->prefix('jobs')->group(function() {
  Route::get('/vacancies-per-page/{perPage}', 'JobVacanciesController@perPage');
  Route::get('/vacancies', 'JobVacanciesController@index');
  Route::post('/vacancies', 'JobVacanciesController@set_filtering');
  Route::get('/vacancies/{job}', 'JobVacanciesController@view')->name('job.show');
  Route::get('/advertise-with-us', 'JobAdvertiseController@index');
  Route::post('/advertise-with-us', 'JobAdvertiseController@submit');
  Route::get('/internships', 'JobInternshipController@index');
  Route::get('/graduate-jobs', 'JobGraduateController@index');
});
