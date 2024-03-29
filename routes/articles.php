<?php

Route::namespace('Article')->prefix('support-articles')->group(function() {
	Route::get('/{supportblockid}/items', 'SupportArticleController@items')->name('support-block-items');
    Route::get('/{articleid}', 'SupportArticleController@show')->name('show-support-article');
});

Route::namespace('Article')->prefix('news')->group(function() {
    Route::get('/', 'ArticleController@index')->name('articles');
    Route::get('/{article}', 'ArticleController@show')->name('showArticle');
    Route::post('/{article}/comment', 'CommentsController@store')->name('storeArticleComment');
    Route::get('/{article}/comment/{comment}/edit', 'CommentsController@edit')->name('editArticleComment');
    Route::patch('/{article}/comment/{comment}', 'CommentsController@update')->name('updateArticleComment');
    Route::delete('/{article}/comment/{comment}', 'CommentsController@destroy')->name('deleteArticleComment');
});
