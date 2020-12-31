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
    route::get('/', 'UserController@homeView')->name('homeView');
    route::post('/createproject', 'UserController@addProject')->name('createProject');
    route::get('logout', 'AccountController@logout')->name('logout');

    Route::group(['prefix' => 'project'], function () {
        route::get('/{id}', 'UserController@projectView')->name('projectView');
        route::post('/{id}/addcollabolator', 'UserController@addColabolator')->name('addColllabolator');
        route::post('/{id}/uploadfile', 'UserController@uploadFile')->name('uploadFile');
        route::post('/{id}/editproject', 'UserController@editproject')->name('editproject');
        route::get('/{id}/downloadfile/{fileID}', 'UserController@downloadFile')->name('downloadFile');
        // Perlu buat DropZone (AJAX nya kyknya)
        Route::post('/upload', 'UserController@fileupload')->name('user.fileupload');
    });
});

Route::group(['middleware' => 'logged'], function () {
    route::get('/auth/google', 'AccountController@redirectToGoogleAuth')->name('loginByGoogle');
    route::get('/auth/google/redirect', 'AccountController@googleAuthCallback')->name('googleCallback');
    Route::get('/login', 'AccountController@loginView')->name('login');
});

Route::get('/test', 'UserController@test');




