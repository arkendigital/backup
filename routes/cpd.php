<?php
Route::namespace('CPD')->prefix('cpd')->group(function() {
  Route::get('/', 'CPDController@index');
});
