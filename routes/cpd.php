<?php
Route::namespace('CPD')->prefix('continued-professional-development')->group(function() {
  Route::get('/', 'CPDController@index');
  Route::get('/resources', 'CPDResourceController@index');
  Route::get('/resources/{cpd_resource}', 'CPDResourceController@view');
  Route::get('/publications', 'CPDPublicationController@index');
});

Route::get('/continuous-professional-development/get-verified', 'CPD\CPDLinkController@index');
