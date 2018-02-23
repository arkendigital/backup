<?php
Route::namespace('CVSupport')->prefix('cv-support')->group(function() {
  Route::get('/', 'CVSupportController@index');
});
