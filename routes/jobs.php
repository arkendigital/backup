<?php
// Route::redirect('/jobs', '/actuary-jobs');

Route::namespace('Job')->group(function() {
  Route::get('/jobs/vacancies-per-page/{perPage}', 'JobVacanciesController@perPage');
  Route::get('/actuary-jobs', 'JobVacanciesController@index');
  Route::post('/actuary-jobs', 'JobVacanciesController@set_filtering');

  Route::get('/actuary-jobs/{pageorjob}', 'JobVacanciesController@index');
  // Route::get('/actuary-jobs/{job}', 'JobVacanciesController@view')->name('job.show');


  Route::post('/actuary-jobs/{id}/track', 'JobVacanciesController@track');
  Route::get('/jobs/advertise-with-us', 'JobAdvertiseController@index');
  Route::post('/jobs/advertise-with-us', 'JobAdvertiseController@submit');
  Route::get('/jobs/internships', 'JobInternshipController@index');
  Route::get('/jobs/graduate-jobs', 'JobGraduateController@index');
});
