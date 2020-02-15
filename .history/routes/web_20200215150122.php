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

Route::get('/user/password', 'Auth\ChangePasswordController@show')->name('changePassword.show');
Route::put('/user/password', 'Auth\ChangePasswordController@update')->name('changePassword.update');
Route::get('/profile/data/edit/{id?}', 'UserProfileController@edit')->name('profile.edit');
Route::get('/profile/data/{id?}', 'UserProfileController@show')->name('profile.show')->middleware('can:viewAny');
Route::put('/profile/data/{userProfile?}', 'UserProfileController@update')->name('profile.update');

Route::get('/test/{id?}', function(Request $request, $id = null) {
    dd($id);
});
