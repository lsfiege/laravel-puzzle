<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


/**
 * Posts
 */
Route::get('/posts/crear', [
    'uses' => 'PostController@create',
    'as' => 'posts.create'
]);

Route::post('/posts', [
    'uses' => 'PostController@store',
    'as' => 'posts.store'
]);

//TODO: create edit post route

Route::put('/post/{post}/', [
    'uses' => 'PostController@update',
    'as' => 'posts.update'
]);

Route::delete('/post/{id}/', [
    'uses' => 'PostController@destroy',
    'as' => 'posts.destroy'
]);

/**
 * Posts de Usuario
 */
Route::get('/usuario/{user}/posts', [
    'uses' => 'HomeController@userPosts',
    'as' => 'users.posts'
]);
