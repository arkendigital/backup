<?php
Route::namespace('UniCorner')->prefix('uni-corner')->group(function() {
  Route::get('/', 'UniCornerController@index');
  Route::get('/how-to-become-an-actuary', 'UniCornerHowToController@index');
  Route::get('/what-is-an-actuary', 'UniCornerWhatIsController@index');
  Route::get('/why-become-an-actuary', 'UniCornerWhyBecomeController@index');
  Route::get('/actuarial-employers', 'UniCornerEmployers@index');
  Route::get('/actuarial-employers/{employer}', 'UniCornerEmployers@view');
  Route::get('/uni-courses', 'CoursesController@index');
  Route::get('/uni-courses/{course}', 'CoursesController@view');
  Route::get('/uni-societies', 'SocietyController@index');
  Route::get('/uni-societies/{society}', 'SocietyController@view')
    ->name("uni-societies.view");
});
