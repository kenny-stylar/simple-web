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
