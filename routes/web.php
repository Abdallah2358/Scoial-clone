<?php
use App\Posts;
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
    return view('landing');
});
//user
Route::get('/login', "PostsController@login");
Route::get('/logout', "PostsController@logout");

Route::get('/register', "UsersController@create");
Route::post('/user','UsersController@store' );
Route::post('/users/search','UsersController@show' );

//posts
Route::post('/posts', "PostsController@show");
Route::post('/posts/create/{user}', "PostsController@store");
Route::get('/posts/create/{user}', "PostsController@create");



//chats 
Route::post('/chats','ChatsController@store' );
