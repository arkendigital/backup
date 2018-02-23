<?php
Route::namespace('UniCorner')->prefix('uni-corner')->group(function() {
  Route::get('/', 'UniCornerController@index');
});
