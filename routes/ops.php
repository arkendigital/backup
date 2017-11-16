<?php

Route::namespace('Admin')->middleware('admin')->prefix('ops')->group(function() {
    Route::get('/', 'AdminController@index')->name('ops');
    Route::redirect('/index', '/ops', 301);

    Route::get('settings', 'SettingController@index')->name('adminSettings');
    Route::patch('settings', 'SettingController@update')->name('adminSettingsUpdate');

    Route::get('me', 'UserController@resetPassword')->name('adminResetPassword');
    Route::post('me', 'UserController@processResetPassword')->name('adminResetPassword');

    Route::post('/users/{user}/ban', 'UserController@banUser')->name('users.ban');
    Route::get('/cache/clear', 'AdminController@clearCache')->name('cache.clear');


    Route::resource('/articles', 'ArticleController');

    Route::resource('/pages', 'PageController');

    Route::resource('/forums', 'ForumController');
    Route::resource('/forums/categories', 'ForumCategoryController');

    Route::get('/forums/{forum}/resync', 'ForumController@resync')->name('forums.resync');

    Route::resource('/users', 'UserController');

    Route::resource('/roles', 'RoleController');

    Route::resource('/permissions', 'PermissionController');

    Route::get('/reports', 'ReportController@index')->name('reports.index');
    Route::get('/reports/{report}', 'ReportController@show')->name('reports.show');
    Route::get('/reports/{report}/claim', 'ReportController@claim')->name('reports.claim');
    Route::get('/reports/{report}/close', 'ReportController@close')->name('reports.close');
    Route::post('/reports/{report}', 'ReportPostController@store')->name('reports.posts.store');

});
