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

Auth::routes();

Route::prefix('/admin')
    ->middleware('auth', 'admin')
    ->group(function() {
        Route::get('/', 'HomeController@index');
        Route::resource('user', 'UserController');
        Route::resource('product', 'ProductController');
        Route::resource('product-category', 'ProductCategoryController');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::resource('customer', 'CustomerController');
});

Auth::routes(['verify' => true]);