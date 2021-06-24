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

// Homepage
//Route::get('/', 'HomeController@index')->name('home');
Route::redirect('/', '/products');
Route::redirect('/home', '/');

// Auth routes
Auth::routes();
Route::group(['middleware' => ['guest']], function() {
    Route::get('login/{provider}', 'Auth\LoginController@redirectToProvider')->where('provider', '(google|facebook)')->name('login.provider');
    Route::get('login/{provider}/callback', 'Auth\LoginController@handleProviderCallback')->where('provider', '(google|facebook)')->name('login.provider.callback');
});

// Products
Route::get('/products', 'ProductController@index')->name('product.products');

// Create, Edit and Delete Product
Route::group(['middleware' => ['auth']], function() {
    Route::get('/product/create', 'ProductController@create')->name('product.create');
    Route::post('/product/store', 'ProductController@store')->name('product.store');
    Route::get('/product/{id}/edit', 'ProductController@edit')->name('product.edit');
    Route::post('/product/{id}', 'ProductController@update')->name('product.update');
    Route::post('/product/{id}/delete', 'ProductController@destroy')->name('product.destroy');
    Route::post('/product/{id}/activate', 'ProductController@activate')->name('product.activate');
    Route::post('/product/{id}/deactivate', 'ProductController@deactivate')->name('product.deactivate');

    // ProductImage
    Route::post('/product-image/store', 'ProductImageController@store')->name('product.image.store');
    Route::post('/product-image/delete', 'ProductImageController@destroy')->name('product.image.destroy');
});

// Product
Route::get('/product/{id}', 'ProductController@show')->name('product.product');

// User
Route::group(['middleware' => ['auth']], function() {
    Route::get('/profile', 'UserController@edit')->name('user.edit');
    Route::post('/profile', 'UserController@update')->name('user.update');
    Route::get('/profile-image-delete', 'UserController@avatarDestroy')->name('user.avatar.delete');
    Route::post('/profile-image-delete', 'UserController@avatarDestroy')->name('user.avatar.delete');
});

Route::get('/profile/{id}', 'UserController@show')->name('user.profile');




