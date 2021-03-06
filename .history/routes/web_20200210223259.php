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

Auth::routes(['verify' => true]);

Route::get('/home', function() {
    return view('home');
})->name('home')->middleware(['verified']);

Route::get('/user/change/password', 'Auth\ChangePasswordController@edit')->name('change.password');
Route::get('/profile/data/edit/{id?}', 'UserProfileController@edit')->name('profile.edit');
Route::get('/profile/data/{id?}', 'UserProfileController@show')->name('profile.show');
Route::put('/profile/data/{userProfile?}', 'UserProfileController@update')->name('profile.update');
