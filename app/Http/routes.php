<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index');

// Admin Middleware Security

Route::group(['middleware' => 'admin'], function(){

    Route::get('admin', function(){

        return view('admin.index');

    })->name('admin.index');

    Route::resource('/admin/users', 'AdminUsersController');
    Route::resource('/admin/posts', 'PostsController');
    Route::resource('admin/categories', 'AdminCategoriesController');

});


