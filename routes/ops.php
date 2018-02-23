<?php

Route::namespace('Admin')->middleware('admin')->prefix('ops')->group(function() {

    Route::get('/', 'AdminController@index')->name('ops');
    Route::redirect('/index', '/ops', 301);

    Route::get('settings', 'SettingController@index')->name('adminSettings');
    Route::patch('settings', 'SettingController@update')->name('adminSettingsUpdate');

    Route::post('/users/{user}/ban', 'UserController@banUser')->name('users.ban');
    Route::get('/cache/clear', 'AdminController@clearCache')->name('cache.clear');


    Route::resource('/articles', 'ArticleController');

    Route::resource('/forums', 'ForumController');
    Route::resource('/forums/categories', 'ForumCategoryController');
    Route::get('/forums/{forum}/resync', 'ForumController@resync')->name('forums.resync');

    Route::resource('/users', 'UserController');
    Route::resource('/roles', 'RoleController');
    Route::resource('/permissions', 'PermissionController');

    /**
    * Sections.
    */
    Route::resource("/sections", "Sections\SectionController", ["parameters" => [
      "sections" => "section"
    ]]);

    /**
    * Pages.
    */
    Route::resource("/pages", "Pages\PageController", ["parameters" => [
      "pages" => "page"
    ]]);

    /**
    * Discussion Categories.
    */
    Route::resource("/discussion-categories", "Discussions\DiscussionCategoryController", ["parameters" => [
      "discussion-categories" => "category"
    ]]);

    /**
    * Jobs.
    */
    Route::resource("/jobs", "Jobs\JobController", ["parameters" => [
      "jobs" => "job"
    ]]);
    Route::resource("/job-companies", "Jobs\JobCompanyController", ["parameters" => [
      "job-companies" => "company"
    ]]);

    /**
    * Exam Resources.
    */
    Route::resource("/exam-resources", "Exams\ExamResourceController", ["parameters" => [
      "exam-resources" => "resource"
    ]]);

    /**
    * Exam Links.
    */
    Route::resource("/exam-links", "Exams\ExamLinkController", ["parameters" => [
      "exam-links" => "link"
    ]]);

    /**
    * Adverts.
    */
    Route::resource("/adverts", "Adverts\AdvertController", ["parameters" => [
      "adverts" => "advert"
    ]]);

});
