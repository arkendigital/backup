<?php
Route::namespace('Page')->prefix('page')->group(function() {
    Route::get('/{page}', 'PageController@show')->name('showPage');
});

Route::namespace('Page')->prefix('actuaries')->group(function() {
    Route::get('/{slug}', 'PageController@showPage');
});
