<?php

Route::namespace('Auth')->group(function() {
    Route::get('login/{provider}', 'LoginController@redirectToProvider')->name('socialAuth');
    Route::get('login/{provider}/callback', 'LoginController@handleProviderCallback')->name('socialCallback');
});

Auth::routes();

Route::get('/', 'HomeController@index')->name('index');

Route::get('/home', 'HomeController@home')->middleware('auth')->name('home');

Route::get('invite', 'Auth\InviteController@check')->name('checkInvite');
Route::post('invite', 'Auth\InviteController@registerInvitedUser')->name('registerInvitedUser');

Route::get('/@{profile}', 'Profile\ProfileController@show')->name('me');
Route::get('/@{profile}/files', 'Profile\FilesController@show')->name('usersFiles');
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

// API Routes
// Mainly used for AJAX
Route::post('api/react', 'Api\\ReactionController@store');
Route::post('api/profile/{user}/avatar', 'Api\\ProfileController@storeAvatar');
Route::post('api/profile/{user}/cover', 'Api\\ProfileController@storeCover');
Route::post('api/reports/{post}', 'Api\\ReportController@store');
Route::get('api/posts/content/{post}', 'Api\\ForumPostController@show');
Route::get('api/users', 'Api\\UsersController@index');
Route::get('api/games', 'Api\\GamesController@index');
Route::get('api/games/{gameId}/categories', 'Api\\GamesController@getCategories');
Route::post('api/files/{file}/thumbUp', 'Api\\FileRatingController@thumbUp');
Route::post('api/files/{file}/thumbDown', 'Api\\FileRatingController@thumbDown');
Route::get('api/files/{file}/hasRated', 'Api\\FileRatingController@userHasRated');
Route::get('api/files/ratings/{file}', 'Api\\FileRatingController@getCount');

