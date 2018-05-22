<?php
Route::namespace('Societies')->prefix('regional-societies')->group(function() {
  Route::get('/', 'SocietyController@index');
  Route::post('/', 'SocietyController@search');
  Route::get('/{society}', 'SocietyController@view')
    ->name("front.societies.view");
});
