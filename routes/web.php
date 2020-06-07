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


//Auth::routes();
Auth::routes(['register' => false]);

Route::group(['middleware' => 'auth'] , function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::Post('/add/product', 'ProductController@store')->name('product.store');
    Route::Post('/search/product', 'ProductController@search')->name('product.search');
    Route::get('/get/product', 'ProductController@index')->name('product.index');
    Route::get('/delete/product/{id}', 'ProductController@destroy')->name('product.edit');
    Route::get('/edit/product/{id}', 'ProductController@edit')->name('product.destroy');


        Route::get('/users/view', 'UserController@index')->name('users.view');
        Route::get('/get/all/users', 'UserController@all_users')->name('users.all');
        Route::get('/get/user', 'UserController@show')->name('users.show');
        Route::Post('/add/user', 'UserController@store')->name('user.store');
        Route::get('/delete/user/{id}', 'UserController@destroy')->name('user.destroy');
        Route::get('/edit/user/{id}', 'UserController@edit')->name('user.edit');


        Route::get('/category/view', 'CategoryController@index')->name('categories.view');
        Route::get('/get/category', 'CategoryController@show')->name('category.show');
        Route::Post('/add/category', 'CategoryController@store')->name('category.store');
        Route::get('/delete/category/{id}', 'CategoryController@destroy')->name('category.destroy');
        Route::get('/edit/category/{id}', 'CategoryController@edit')->name('category.edit');

    Route::get('/change/password', 'UserController@change_password')->name('change_password');
    Route::Post('/update/password', 'UserController@update_password')->name('update_password');
    Route::get('/update/profile', 'UserController@update_profile')->name('update_profile');
    Route::Post('/update/profile', 'UserController@update_profile_view')->name('update_profile_view');

    Route::get('/get/master/users', 'UserController@getMasterUsers')->name('get_master_users');

});
