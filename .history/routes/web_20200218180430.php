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

Auth::routes(['verify' => true]);

Route::get('/', function() {
    return view('home');
})->name('home')->middleware(['verified']);

Route::prefix('/user')->name('changePassword.')->group(function() {
    Route::get('/password', 'Auth\ChangePasswordController@show')->name('show');
    Route::put('/password', 'Auth\ChangePasswordController@update')->name('update');
});

Route::prefix('/profile')->name('profile.')->group(function() {
    Route::get('/data/edit/{id?}', 'UserProfileController@edit')->name('edit');
    Route::get('/data/{id?}', 'UserProfileController@show')->name('show');
    Route::put('/data/{id}', 'UserProfileController@update')->name('update');
    Route::delete('/data/{id}', 'UserProfileController@destroy')->name('delete');
});

Route::get('/test/{id?}', function(Request $request, $id = null) {
    dd($id);
});
