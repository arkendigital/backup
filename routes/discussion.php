<?php
Route::namespace('Discussion')->prefix('discussion')->group(function() {

Route::get('/', function(){ return Redirect::to('/discussion/current', 301); })->name("front.discussion.index");
Route::get('jobs', function(){ return Redirect::to('/discussion/current', 301); });
Route::get('exams', function(){ return Redirect::to('/discussion/current', 301); });
Route::get('cpd', function(){ return Redirect::to('/discussion/current', 301); });
Route::get('recruiters', function(){ return Redirect::to('/discussion/current', 301); });
Route::get('uni-corner', function(){ return Redirect::to('/discussion/current', 301); });
Route::get('resources', function(){ return Redirect::to('/discussion/current', 301); });
Route::get('need-a-hand', function(){ return Redirect::to('/discussion/current', 301); });
Route::get('discuss-salaries', function(){ return Redirect::to('/discussion/current', 301); });
Route::get('regional-societies', function(){ return Redirect::to('/discussion/current', 301); });

  /**
  * Display the home of the discussion section.
  *
  */
  // Route::get('/', 'DiscussionController@index')
  //   ->name("front.discussion.index"); 

  /**
  * Store a new discussion in the database.
  *
  */
  Route::post('/', 'DiscussionController@store');

  /**
  * Display a list of the recent discussion threads.
  *
  */
  Route::get('/latest-messages', 'DiscussionController@latest');

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

  /**
  * Delete a discussion thread.
  *
  */
  Route::delete('/{category}/{discussion}', 'DiscussionController@destroy')
    ->name("discussion.destroy")
    ->middleware("discussion");

});
