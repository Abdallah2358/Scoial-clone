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
//friends 
Route::get('/friends/{id}', "UsersController@friends");

//posts
Route::post('/posts', "PostsController@show");
Route::post('/posts/create/{user}', "PostsController@store");
Route::get('/posts/create/{user}', "PostsController@create");

Route::get('/posts/delete/{id}', "PostsController@destroy");
Route::get('/posts/edit/{id}', "PostsController@edit");
Route::post('/posts/edit/{id}', "PostsController@update");


//chats 
Route::post('/chats','ChatsController@store' );
//comments
Route::post('/comment/create', "PostsController@comment");
Route::get('/comment/edit/{id}', "PostsController@edit_comment");
Route::post('/comment/update/{id}', "PostsController@update_comment");

Route::get('/comment/delete/{id}', "PostsController@delete_comment");


//likes
Route::get('/like/delete/{id}', "PostsController@like_delete");
Route::get('/like/{id}', "PostsController@like");
//show
Route::get('/likes/{id}', "PostsController@likess");

