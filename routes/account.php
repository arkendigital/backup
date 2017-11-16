<?php

Route::namespace('Account')->middleware('auth')->prefix('account')->group(function() {
    Route::get('/', 'AccountController@index')->name('myAccount');
    Route::get('/edit', 'AccountController@edit')->name('accountEdit');
    Route::patch('/edit', 'AccountController@update')->name('accountUpdate');

    Route::get('/profile/edit', 'ProfileController@edit')->name('profileEdit');
    Route::patch('/profile/edit', 'ProfileController@update')->name('profileUpdate');

    Route::get('conversations', 'MessagesController@index')->name('messageIndex');
    Route::get('conversations/create', 'MessagesController@create')->name('messageCreate');
    Route::post('conversations', 'MessagesController@store')->name('messageStore');
    Route::get('conversations/{id}', 'MessagesController@show')->name('messageView');
    Route::put('conversations/{id}', 'MessagesController@update')->name('messageUpdate');
});
