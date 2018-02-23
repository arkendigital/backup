<?php
Route::namespace('Discussion')->prefix('discussion')->group(function() {
  Route::get('/', 'DiscussionController@index');
  Route::get('/popular-threads', 'DiscussionController@popular');
  Route::get('/answered-threads', 'DiscussionController@answered');
  Route::get('/unanswered-threads', 'DiscussionController@unanswered');
  Route::get('/{category}', 'DiscussionController@index');
  Route::get('/{category}/{discussion}', 'DiscussionController@view');
  Route::post('/{category}/{discussion}', 'DiscussionReplyController@store')->name("discussionStoreReply");
});
