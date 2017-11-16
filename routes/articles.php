<?php
Route::namespace('Article')->prefix('news')->group(function() {
    Route::get('/', 'ArticleController@index')->name('articles');
    Route::get('/category/{category}', 'ArticleController@show')->name('articleShowCategory');
    Route::post('/{article}/comment', 'CommentsController@store')->name('storeArticleComment');
    Route::get('/{article}/comment/{comment}/edit', 'CommentsController@edit')->name('editArticleComment');
    Route::patch('/{article}/comment/{comment}', 'CommentsController@update')->name('updateArticleComment');
    Route::delete('/{article}/comment/{comment}', 'CommentsController@destroy')->name('deleteArticleComment');
});
