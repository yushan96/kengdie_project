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

Route::get('/','StaticPagesController@home')->name('home');
Route::get('/signup','UserController@create')->name('signup');

Route::resource('users','UserController');

Route::get('login', 'SessionsController@create')->name('login');
Route::post('login', 'SessionsController@store')->name('login');
Route::delete('logout', 'SessionsController@destroy')->name('logout');

Route::resource('notes', 'NotesController', ['only' => ['store', 'destroy']]);
Route::get('new_note','SessionsController@add_note')->name('note.new');

Route::get('/notes/{note}/tags','NotesController@tags')->name('notes.tags');

Route::get('/users/{user}/friends','UserController@friends')->name('user.friends');
Route::post('/users/{user}/friends','UserController@befriend')->name('user.befriend'); //send friend request
Route::delete('/users/{user}/friends','UserController@unfriend')->name('user.unfriend');

Route::get('/users/{user}/friend-requests','FriendshipController@requests')->name('friendship.requests');
Route::post('/users/{user}/friend-requests','FriendshipController@acceptRequest')->name('friendship.acceptRequest');
Route::delete('/users/{user}/friend-requests','FriendshipController@denyRequest')->name('friendship.denyRequest');


Route::get('/map','UserController@map')->name('map');

Route::resource('comments','CommentsController', ['only' => ['store', 'destroy']]);


