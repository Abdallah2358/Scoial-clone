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

Route::get('/login', "UsersController@index");
Route::get('/register', "UsersController@create");
Route::post('/user','UsersController@store' );

Route::post('/posts', "PostsController@show");