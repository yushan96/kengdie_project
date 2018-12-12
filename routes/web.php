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
Route::delete('/users/{user}/friends','UserController@unfriend')->name('user.unfriend');

Route::resource('comments','CommentsController', ['only' => ['store', 'destroy']]);

