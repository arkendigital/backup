<?php
Route::namespace('CVSupport')->prefix('recruiters')->group(function() {
  Route::get('/', 'CVSupportController@index');
});
