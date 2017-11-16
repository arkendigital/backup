<?php
Route::namespace('Page')->prefix('page')->group(function() {
    Route::get('/{page}', 'PageController@show')->name('showPage');
});
