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

route::get('/auth/google','AccountController@redirectToGoogleAuth')->name('loginByGoogle');
route::get('/auth/google/redirect','AccountController@googleAuthCallback')->name('googleCallback');
route::get('logout','AccountController@logout')->name('logout');

route::get('/home','UserController@homeView')->name('homeView');
route::get('/project/{id}','UserController@projectView')->where('id','[0-9]+')->name('projectView');
route::get('/test','GdriveController@test');
