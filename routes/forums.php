<?php
Route::namespace('Forum')->prefix('forums')->group(function() {
    Route::get('/', 'ForumController@index')->name('forumIndex');
    Route::get('search', 'ForumSearchController@show')->name('forumSearch');
    Route::get('search/latest', 'ForumSearchController@latestThreads')->name('forumLatest');
    Route::get('search/popular', 'ForumSearchController@popularThreads')->name('forumPopular');
    Route::get('{forum}', 'ForumController@show')->name('forumDisplay');
    Route::get('{forum}/create', 'ThreadController@create')->name('threadCreate');
    Route::get('{forum}/{thread}', 'ThreadController@show')->name('showThread');
    Route::get('{forum}/{thread}/pin', 'ThreadController@pin')->name('pinThread');
    Route::get('{forum}/{thread}/close', 'ThreadController@close')->name('closeThread');
    Route::get('{forum}/{thread}/move', 'ThreadController@move')->name('moveThread');
    Route::post('{forum}/{thread}/move', 'ThreadController@processMove')->name('processMoveThread');
    Route::get('{forum}/{thread}/reply/{post}', 'ThreadController@goToLastPost')->name('goToLastPost');
    Route::get('{forum}/{thread}/replies/{forumpost}/edit', 'PostController@edit')->name('editPost');
    Route::patch('{forum}/{thread}/replies/{forumpost}', 'PostController@update')->name('updatePost');
    Route::delete('{forum}/{thread}/replies/{forumpost}/delete', 'PostController@destroy')->name('deletePost');
    Route::post('{forum}/{thread}', 'PostController@store')->name('storePost');
    Route::post('{forum}', 'ThreadController@store')->name('storeThread');
    Route::delete('{forum}/{thread}/', 'ThreadController@destroy')->name('deleteThread');

    Route::post('{forum}/{thread}/subscriptions', 'ThreadSubscriptionsController@store')->name('subscribeThread');
    Route::delete('{forum}/{thread}/subscriptions', 'ThreadSubscriptionsController@destroy')->name('unsubscribeThread');
});
