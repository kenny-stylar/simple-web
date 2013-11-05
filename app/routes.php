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
  'uses'  => 'FeedController@getFeedView'
));
Route::post('/feed', array(
  'uses'  => 'FeedController@postFeed'
));

//post page
Route::get('/post/user', array(
  'as'    => 'userpost',
  'uses'  => 'UserPostController@getUserPost'
));
Route::post('/post/user', array(
  'uses'  => 'UserPostController@postUserPost'
));
Route::get('/post/userlike', array(
  'as'    => 'userlike',
  'uses'  => 'UserPostController@getUserLike'
));
Route::post('/post/userlike', array(
  'uses'  => 'UserPostController@postUserLike'
));