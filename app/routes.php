<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', array(
  'as'    => 'index',
  'uses'  => 'HomeController@getHomeView'
));

//user page
Route::get('/user/register', array(
  'as'    => 'user_register',
  'uses'  => 'UserController@getUserRegister'
));
Route::post('/user/register', array(
  'uses'  => 'UserController@postUserRegister'
));
Route::get('/user/login', array(
  'as'    => 'user_login',
  'uses'  => 'UserController@getUserLogin'
));
Route::post('/user/login', array(
  'uses'  => 'UserController@postUserLogin'
));
Route::get('/user/logout', array(
  'as'    => 'user_logout',
  'uses'  => 'UserController@getUserLogout'
));
Route::post('/user/logout', array(
  'uses'  => 'UserController@postUserLogout'
));
Route::get('/user/change-password', array(
  'as'    => 'user_password',
  'uses'  => 'UserController@getUserPassword'
));
Route::post('/user/change-password', array(
  'uses'  => 'UserController@postUserPassword'
));
Route::get('/user/info', array(
  'as'    => 'user_info',
  'uses'  => 'UserController@getUserInfo'
));
Route::post('/user/info', array(
  'uses'  => 'UserController@postUserInfo'
));
Route::get('/user/update/{uid?}', array(
  'as'    => 'user_update',
  'uses'  => 'UserController@getUserUpdate'
));
Route::post('/user/update/{uid?}', array(
  'uses'  => 'UserController@postUserUpdate'
));
Route::get('/user/provisioning', array(
  'as'    => 'user_provisioning',
  'uses'  => 'UserController@getUserProvisioning'
));
Route::post('/user/provisioning', array(
  'uses'  => 'UserController@postUserProvisioning'
));
Route::get('/user/profilepic', array(
  'as'    => 'user_profilepic',
  'uses'  => 'UserController@getUserProfilePic'
));
Route::post('/user/profilepic', array(
  'uses'  => 'UserController@postUserProfilePic'
));

//feed page
Route::get('/feed', array(
  'as'    => 'feed',
  'uses'  => 'FeedController@getFeed'
));
Route::post('/feed', array(
  'uses'  => 'FeedController@postFeed'
));

//post page
Route::get('/post/user', array(
  'as'    => 'userpost',
  'uses'  => 'PostController@getUserPost'
));
Route::post('/post/user', array(
  'uses'  => 'PostController@postUserPost'
));
Route::get('/post/userlike', array(
  'as'    => 'userlike',
  'uses'  => 'PostController@getUserLike'
));
Route::post('/post/userlike', array(
  'uses'  => 'PostController@postUserLike'
));
Route::get('/post/createpost', array(
  'as'    => 'createpost',
  'uses'  => 'PostController@getCreatePost'
));
Route::get('/post/readpost', array(
  'as'    => 'readpost',
  'uses'  => 'PostController@getReadPost'
));
Route::post('/post/readpost', array(
  'uses'  => 'PostController@postReadPost'
));
Route::get('/post/editpost/{post_id?}', array(
  'as'    => 'editpost',
  'uses'  => 'PostController@getEditPost'
));
Route::post('/post/editpost', array(
  'uses'  => 'PostController@postEditPost'
));
Route::get('/post/deletepost', array(
  'as'    => 'deletepost',
  'uses'  => 'PostController@getDeletePost'
));
