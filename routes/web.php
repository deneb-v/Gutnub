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

Route::get('/', 'AccountController@loginView')->name('login');

Route::group(['middleware' => 'user'], function () {
    route::get('/home', 'UserController@homeView')->name('homeView');
    route::post('/createproject', 'UserController@addProject')->name('createProject');

    Route::group(['prefix' => 'project'], function () {
        route::get('/{id}', 'UserController@projectView')->name('projectView');
        route::post('/{id}/addcollabolator', 'UserController@addColabolator')->name('addColllabolator');
        route::post('/{id}/uploadfile', 'UserController@uploadFile')->name('uploadFile');
        route::get('/{id}/downloadfile/{fileID}', 'UserController@downloadFile')->name('downloadFile');
        // Perlu buat DropZone (AJAX nya kyknya)
        Route::post('/upload', 'UserController@fileupload')->name('user.fileupload');
    });
});

route::get('/auth/google', 'AccountController@redirectToGoogleAuth')->name('loginByGoogle');
route::get('/auth/google/redirect', 'AccountController@googleAuthCallback')->name('googleCallback');
route::get('logout', 'AccountController@logout')->name('logout');



