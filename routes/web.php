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
    return redirect('/login');
});


Auth::routes();

Route::group(['middleware' => 'auth'] , function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::Post('/add/product', 'ProductController@store')->name('product.store');
    Route::get('/get/product', 'ProductController@index')->name('product.index');
    Route::get('/delete/product/{id}', 'ProductController@destroy')->name('product.edit');
    Route::get('/edit/product/{id}', 'ProductController@edit')->name('product.destroy');

    Route::group(['middleware' => ['permission:users-page']] , function () {
        Route::get('/users/view', 'UserController@index')->name('users.view');
        Route::get('/get/user', 'UserController@show')->name('users.show');
        Route::Post('/add/user', 'UserController@store')->name('user.store');
        Route::get('/delete/user/{id}', 'UserController@destroy')->name('user.destroy');
        Route::get('/edit/user/{id}', 'UserController@edit')->name('user.destroy');
    });

    Route::group(['middleware' => ['permission:categories-page']] , function () {

    });

    Route::get('/change/password', 'UserController@change_password')->name('change_password');
    Route::Post('/update/password', 'UserController@update_password')->name('update_password');

});
