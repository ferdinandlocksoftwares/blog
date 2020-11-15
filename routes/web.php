<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



Route::get('/', 'App\Http\Controllers\PostController@index');
Route::get('/home', ['as' => 'home', 'uses' => 'App\Http\Controllers\PostController@index']);
Route::get('/logout', 'App\Http\Controllers\UserController@logout');
Route::group(['prefix' => 'auth'], function () {
  Auth::routes();
});


Route::middleware(['auth'])->group(function () {
  // show new post form
  Route::get('new-post', 'App\Http\Controllers\PostController@create');
  // save new post
  Route::post('new-post', 'App\Http\Controllers\PostController@store');
  // edit post form
  Route::get('edit/{id}', 'App\Http\Controllers\PostController@edit');
  Route::get('show/{id}', 'App\Http\Controllers\PostController@show');
  // update post
  Route::post('update', 'App\Http\Controllers\PostController@update');
  // delete post
  Route::get('delete/{id}', 'App\Http\Controllers\PostController@destroy');
  // display user's all posts
  // Route::get('my-all-posts', 'UserController@user_posts_all');
  // // display user's drafts
  // Route::get('my-drafts', 'UserController@user_posts_draft');
  // add comment
  Route::post('comment/add', 'App\Http\Controllers\CommentController@store');
  // delete comment
  Route::post('comment/delete/{id}', 'App\Http\Controllers\CommentController@distroy');
});

