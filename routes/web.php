<?php

use Illuminate\Support\Facades\Route;

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



Route::group(['middleware' => 'user'], function () {
    Route::get('/', 'UserController@homeView')->name('homeView');
    Route::post('/createproject', 'UserController@addProject')->name('createProject');
    Route::get('logout', 'AccountController@logout')->name('logout');

    Route::group(['prefix' => 'project', 'middleware' => 'project'], function () {
        Route::get('/{id}', 'UserController@projectView')->name('projectView');
        Route::post('/{id}/addcollabolator', 'UserController@addColabolator')->name('addColllabolator');
        Route::post('/{id}/uploadfile', 'UserController@uploadFile')->name('uploadFile');
        Route::post('/{id}/editproject', 'UserController@editproject')->name('editproject');
        Route::get('/{id}/downloadfile/{fileID}', 'UserController@downloadFile')->name('downloadFile');
        // Perlu buat DropZone (AJAX nya kyknya)
        Route::post('/upload', 'UserController@fileupload')->name('user.fileupload');
    });
});

Route::group(['middleware' => 'logged'], function () {
    Route::get('/auth/google', 'AccountController@redirectToGoogleAuth')->name('loginByGoogle');
    Route::get('/auth/google/redirect', 'AccountController@googleAuthCallback')->name('googleCallback');
    Route::get('/login', 'AccountController@loginView')->name('login');
});

Route::get('/test', 'UserController@test');




