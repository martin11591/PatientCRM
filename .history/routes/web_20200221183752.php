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
    Route::post('/data/edit/{id?}', 'UserProfileController@edit')->name('edit.post');
    Route::get('/data/{id?}', 'UserProfileController@show')->name('show');
    Route::put('/data/{id}', 'UserProfileController@update')->name('update');
    Route::delete('/data/{id}', 'UserProfileController@destroy')->where('id', '.*')->name('delete');
});

Route::prefix('/patient')->namespace('Patient')->name('patient.')->group(function() {
    Route::get('s', 'PatientController@index')->name('index');
});

Route::prefix('/disease')->name('disease.')->group(function() {
    Route::get('/', 'DiseaseController@index')->name('index');
    Route::get('/edit/{disease}', 'DiseaseController@edit')->name('edit');
    Route::put('/{disease}', 'DiseaseController@update')->name('update');
    Route::delete('/{disease}', 'DiseaseController@destroy')->where('disease', '.*')->name('delete');
});

Route::prefix('/medicine')->name('medicine.')->group(function() {
    Route::get('/', 'MedicineController@index')->name('index');
    Route::get('/edit/{medicine}', 'MedicineController@edit')->name('edit');
    Route::put('/{medicine}', 'MedicineController@update')->name('update');
    Route::delete('/{medicine}', 'MedicineController@destroy')->where('medicine', '.*')->name('delete');
});

Route::get('/test/{id?}', function(Request $request, $id = null) {
    dd($id);
});
