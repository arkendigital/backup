<?php
use Illuminate\Support\Facades\Mail;

use Illuminate\Support\Facades\Hash;
Route::namespace('Auth')->group(function () {
    Route::get('login/{provider}', 'LoginController@redirectToProvider')->name('socialAuth');
    Route::get('login/{provider}/callback', 'LoginController@handleProviderCallback')->name('socialCallback');
});
Auth::routes();

Route::get('test',function(){
    return Hash::make('password');
	// Mail::send('test', [], function ($m) {
 //        $m->from('no-reply@actuariesonline.com', Setting::get('site_name'));
 //        $m->to('j.girgis85@gmail.com')->subject('test email');
 //    });
});

/**
* Homepage.
*/
Route::get('/', 'HomeController@index')->name("index");

Route::get('/cpd', function () {
    return redirect('https://actuariesonline.com/continued-professional-development');
});

/**
* Sections
*
* - Jobs
* - Exams
* - CV Support
* - CPD
* - Uni Corner
* - Discussion
* - Societies
* - Salary Survey
*
*/
require(base_path() . '/routes/jobs.php');
require(base_path() . '/routes/exams.php');
require(base_path() . '/routes/cvsupport.php');
require(base_path() . '/routes/cpd.php');
require(base_path() . '/routes/uni-corner.php');
require(base_path() . '/routes/discussion.php');
require(base_path() . '/routes/societies.php');
require(base_path() . '/routes/salary-survey.php');

/**
* Pages
*
* - Contact
* - Terms and Conditions
* - Privacy and Cookies
* - About
* - Suggest a Feature
*
*/
Route::get('/contact', 'Contact\ContactController@index')->name("contact");
Route::post('/contact', 'Contact\ContactController@submit');
Route::get('/terms-and-conditions', 'Misc\TermsController@index')->name("terms");
Route::get('/privacy-cookies', 'Misc\PrivacyController@index')->name("privacy");
Route::get('/about', 'Misc\AboutController@index')->name("about");
Route::get('/suggest-a-feature', 'Misc\SuggestFeatureController@index')->name("suggestfeature.index");
Route::post('/suggest-a-feature', 'Misc\SuggestFeatureController@submit')->name("suggestfeature.submit");

/**
 * Salary Survey Detailed Download
 *
 */
Route::get("/export/salary-survey", "Admin\ExportController@salary")
    ->name("export.public.salary-survey");








Route::get('search', 'Search\SearchController@index')->name('search');



// Route::get('/home', 'HomeController@home')->middleware('auth')->name('home');

Route::get('invite', 'Auth\InviteController@check')->name('checkInvite');
Route::post('invite', 'Auth\InviteController@registerInvitedUser')->name('registerInvitedUser');

Route::get('/@{profile}', 'Profile\ProfileController@show')->name('me');
Route::get('/@{profile}/follow', 'Profile\ProfileController@follow')->name('followUser');
Route::get('/@{profile}/unfollow', 'Profile\ProfileController@unfollow')->name('unfollowUser');

Route::get('/community/members', 'Community\CommunityController@index')->name('memberList');

Route::get('/email/verify/{token}', 'Auth\RegisterController@verify')->name('verifyEmail');

require(base_path() . '/routes/account.php');
require(base_path() . '/routes/articles.php');
require(base_path() . '/routes/ops.php');
require(base_path() . '/routes/forums.php');
require(base_path() . '/routes/page.php');

Route::get('socialredirect/{network}/{username}', 'Utilities\\RedirectController@handle')->name('socialRedirect');

/**
* AJAX API Routes.
*
*/
Route::post('/api/remove-item-from-sidebar', 'Api\\Admin\\SidebarController@removeItem');

Route::post('/api/add-page-to-sidebar', 'Api\\Admin\\SidebarController@addPage');
Route::post('/api/remove-page-from-sidebar', 'Api\\Admin\\SidebarController@removePage');
Route::post('/api/add-link-to-sidebar', 'Api\\Admin\\SidebarController@addLink');

// API Routes
// Mainly used for AJAX
Route::post('api/react', 'Api\\ReactionController@store');
Route::post('api/profile/{user}/avatar', 'Api\\ProfileController@storeAvatar');
Route::post('api/profile/{user}/cover', 'Api\\ProfileController@storeCover');
Route::post('api/reports/{post}', 'Api\\ReportController@store');
Route::get('api/posts/content/{post}', 'Api\\ForumPostController@show');
Route::get('api/users', 'Api\\UsersController@index');
Route::post('api/trumbowyg-upload-image', 'Api\\TrumbowygUploadImage@store');

/**
 * Advert tracking
 *
 */
Route::get("track", "Adverts\\AdvertTrackingController@track")
  ->name("advert.track");


/**
* Advert tracking
*
*/
Route::get("track/job", "Job\\JobTrackingController@track")
    ->name("job.track");

/**
 * Sitemap
 *
 */
Route::redirect('/sitemap.xml', '/sitemap_index.xml');
Route::get('/sitemap_index.xml', 'Sitemap\\SitemapController@index');
Route::get('/sitemap-pages-{page?}.xml', 'Sitemap\\SitemapController@pages')->name('sitemap.pages');
Route::get('/sitemap-jobs-{page?}.xml', 'Sitemap\\SitemapController@jobs')->name('sitemap.jobs');
Route::get('/sitemap-discussions-{page?}.xml', 'Sitemap\\SitemapController@discussions')->name('sitemap.discussions');
Route::get('/sitemap-exam-categories-{page?}.xml', 'Sitemap\\SitemapController@examCategories')->name('sitemap.exam.categories');


/**
 * Reset password confirmation page
 *
 */
Route::get('/password-reset-email-sent', 'Auth\ForgotPasswordController@confirmation');
