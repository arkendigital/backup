<?php
Route::namespace('UniCorner')->prefix('uni-corner')->group(function() {
  Route::get('/', 'UniCornerController@index');
  Route::get('/how-to-become-an-actuary', 'UniCornerHowToController@index');
  Route::get('/what-is-an-actuary', 'UniCornerWhatIsController@index');
  Route::get('/why-become-an-actuary', 'UniCornerWhyBecomeController@index');
});
