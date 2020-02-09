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

Route::get('/home', function() {
    return view('home');
})->name('home')->middleware('auth');

Route::get('/profile/data/{userProfile?}', 'UserProfileController@show')->name('profile.show');
Route::get('/profile/data/{userProfile}/edit', 'UserProfileController@edit')->name('profile.edit');
Route::put('/profile/data/{userProfile}', 'UserProfileController@update')->name('profile.update');
