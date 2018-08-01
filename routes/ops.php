<?php

Route::namespace('Admin')->middleware('admin')->prefix('ops')->group(function () {

    Route::get('/', 'AdminController@index')->name('ops');

    /**
     * Exam survey data
     *
     */
    Route::get("/export/exam-survey", "ExportController@exam")
        ->name("export.exam-survey");

    Route::get("/upload/exam-survey", "ImportController@exam")
        ->name("upload.exam-survey");

    Route::post("/upload/exam-survey", "ImportController@examImport")
        ->name("import.exam-survey");

    /**
     * Salary survey data
     *
     */
    Route::get("/export/salary-survey", "ExportController@salary")
        ->name("export.salary-survey");

    Route::get("/upload/salary-survey", "ImportController@salary")
        ->name("upload.salary-survey");

    Route::post("/upload/salary-survey", "ImportController@salaryImport")
        ->name("import.salary-survey");

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
    * Sidebars.
    */
    Route::resource("/sidebars", "Sidebars\SidebarController", ["parameters" => [
      "sidebars" => "sidebar"
    ]]);
    Route::get('/sidebars/{sidebar}/order', 'Sidebars\SidebarOrderController@index')->name("sidebars.order");
    Route::patch('/sidebars/{sidebar}/order', 'Sidebars\SidebarOrderController@update');

    /**
    * Pages.
    */
    Route::get("/pages", "Pages\PageController@index")->name("pages.index");
    Route::get("/pages/create", "Pages\PageController@create")->name("pages.create");
    Route::post("/pages/create", "Pages\PageController@store")->name("pages.store");
    Route::get("/pages/{id}/edit", "Pages\PageController@edit")->name("pages.edit");
    Route::patch("/pages/{id}/edit", "Pages\PageController@update")->name("pages.update");
    Route::get("/pages/{id}/widgets", "Pages\PageController@addWidget")->name("pages.add.widget");
    Route::post("/pages/{id}/widgets", "Pages\PageController@insertWidget");
    Route::delete("/pages/{id}", "Pages\PageController@destroy")->name("pages.destroy");

    /**
    * Page Widgets.
    */
    Route::resource("/page-widgets", "Pages\PageWidgetController", ["parameters" => [
      "page-widgets" => "widget"
    ]]);
    Route::get('/page-widgets/{widget}/order', 'Pages\PageWidgetOrderController@index')->name("page-widgets.order");
    Route::patch('/page-widgets/{widget}/order', 'Pages\PageWidgetOrderController@update');

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

    Route::get('/job-locations', 'Jobs\JobLocationController@index')->name('jobs.locations');
    Route::get('/job-locations/create', 'Jobs\JobLocationController@create')->name('jobs.locations.create');
    Route::put('/job-locations', 'Jobs\JobLocationController@store')->name('jobs.locations.store');
    Route::get('/job-locations/{location}/edit', 'Jobs\JobLocationController@edit')->name('jobs.locations.edit');
    Route::patch('/job-locations/{location}', 'Jobs\JobLocationController@update')->name('jobs.locations.update');
    Route::delete('/job-locations/{location}/delete', 'Jobs\JobLocationController@destroy')->name('jobs.locations.delete');

    Route::get('/job-sectors', 'Jobs\JobSectorController@index')->name('jobs.sectors');
    Route::get('/job-sectors/create', 'Jobs\JobSectorController@create')->name('jobs.sectors.create');
    Route::put('/job-sectors', 'Jobs\JobSectorController@store')->name('jobs.sectors.store');
    Route::get('/job-sectors/{sector}/edit', 'Jobs\JobSectorController@edit')->name('jobs.sectors.edit');
    Route::patch('/job-sectors/{sector}', 'Jobs\JobSectorController@update')->name('jobs.sectors.update');
    Route::delete('/job-sectors/{sector}/delete', 'Jobs\JobSectorController@destroy')->name('jobs.sectors.delete');


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
    * Exam Categories.
    */
    Route::resource("/exam-categories", "Exams\ExamCategoryController", ["parameters" => [
      "exam-categories" => "category"
    ]]);

    /**
    * Exam Modules.
    */
    Route::resource("/exam-modules", "Exams\ExamModuleController", ["parameters" => [
      "exam-modules" => "module"
    ]]);

    /**
    * Adverts.
    */
    Route::resource("/adverts", "Adverts\AdvertController", ["parameters" => [
      "adverts" => "advert"
    ]]);

    /**
    * CPD Resources.
    */
    Route::resource("/cpd-resources", "CPD\CPDResourceController", ["parameters" => [
      "cpd-resources" => "resource"
    ]]);

    /**
     * CPD Resource LInks
     *
     */
    Route::get("/cpd-resources/{resource}/links/create", "CPD\CPDResourceLinkController@create")
      ->name("ops.cpd.resources.links.create");
    Route::post("/cpd-resources/{resource}/links/create", "CPD\CPDResourceLinkController@store")
      ->name("ops.cpd.resources.links.store");
    Route::get("/cpd-resources/{resource}/links/{link}/edit", "CPD\CPDResourceLinkController@edit")
      ->name("ops.cpd.resources.links.edit");
    Route::patch("/cpd-resources/{resource}/links/{link}/edit", "CPD\CPDResourceLinkController@update")
      ->name("ops.cpd.resources.links.update");

    /**
    * CPD Publications.
    */
    Route::resource("/cpd-publications", "CPD\CPDPublicationController", ["parameters" => [
      "cpd-publications" => "publication"
    ]]);

    /**
    * CPD Links.
    */
    Route::resource("/cpd-links", "CPD\CPDLinkController", ["parameters" => [
      "cpd-links" => "link"
    ]]);

    /**
    * Slides.
    */
    Route::resource("/slides", "Slides\SlideController", ["parameters" => [
      "slides" => "slide"
    ]]);

    Route::get('/box-groups/wealth-of-information', 'WealthOfInformation@index');
    Route::get('/box-groups/wealth-of-information/{wealth}/edit', 'WealthOfInformation@edit')->name('wealth.edit');
    Route::patch('/box-groups/wealth-of-information/{wealth}', 'WealthOfInformation@update')->name('wealth.update');

    /**
    * Box Groups.
    */
    Route::resource("/box-groups", "BoxGroups\BoxGroupController", ["parameters" => [
      "box-groups" => "group"
    ]]);


    /**
    * Box Items.
    */
    Route::resource("/box-items", "BoxGroups\BoxItemController", ["parameters" => [
      "box-items" => "item"
    ]]);
    Route::get('/box-items/{group}/order', 'BoxGroups\BoxItemOrderController@index')->name("box-items.order");
    Route::patch('/box-items/{group}/order', 'BoxGroups\BoxItemOrderController@update');

    /**
    * Employers.
    */
    Route::resource("/employers", "Employers\EmployerController", ["parameters" => [
      "employers" => "employer"
    ]]);

    /**
    * Courses.
    */
    Route::resource("/courses", "Courses\CourseController", ["parameters" => [
      "courses" => "course"
    ]]);

    /**
    * Societies.
    */
    Route::resource("/societies", "Societies\SocietyController", ["parameters" => [
      "societies" => "society"
    ]]);

    /**
    * Societies.
    */
    Route::resource("/uni-societies", "Societies\UniSocietyController", ["parameters" => [
      "uni-societies" => "society"
    ]]);
});
