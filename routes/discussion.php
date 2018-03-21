<?php
Route::namespace('Discussion')->prefix('discussion')->group(function() {

  /**
  * Display the home of the discussion section.
  *
  */
  Route::get('/', 'DiscussionController@index');

  /**
  * Store a new discussion in the database.
  *
  */
  Route::post('/', 'DiscussionController@store');

  /**
  * Display a list of the most popular discussion threads.
  *
  */
  Route::get('/popular-threads', 'DiscussionController@popular');

  /**
  * Display all answered threads (with replies).
  *
  */
  Route::get('/answered-threads', 'DiscussionController@answered');

  /**
  * Display all unanswered threads (no replies).
  *
  */
  Route::get('/unanswered-threads', 'DiscussionController@unanswered');

  /**
  * Show all discussion threads in a specific discussion category.
  *
  */
  Route::get('/{category}', 'DiscussionController@index');

  /**
  * Viewing a specific discussion thread.
  *
  */
  Route::get('/{category}/{discussion}', 'DiscussionController@view')->name("discussion.view");

  /**
  * Store discussion thread reply.
  *
  */
  Route::post('/{category}/{discussion}', 'DiscussionReplyController@store')->name("discussionStoreReply");

  /**
  * Edit form for a discussion thread.
  *
  */
  Route::get('/{category}/{discussion}/edit', 'DiscussionController@edit')
    ->name("discussion.edit")
    ->middleware("discussion");

  /**
  * Update discussion thread in database storage.
  *
  */
  Route::patch('/{category}/{discussion}/edit', 'DiscussionController@update')->name("discussion.update");

});
