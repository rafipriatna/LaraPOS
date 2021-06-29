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
        Route::resource('customer', 'CustomerController');
        Route::resource('coupon', 'CouponController');

        Route::get('/company', 'CompanyProfileController@index')->name('companyProfile.index');
        Route::post('/company', 'CompanyProfileController@save')->name('companyProfile.save');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/', 'HomeController@index')->name('home');
    
    Route::post('/sale/getCoupon', 'SaleController@getCoupon')->name('sale.getCoupon');
    Route::resource('sale', 'SaleController');
    Route::post('/transaction/storeTransaction', 'TransactionController@storeTransaction')->name('transaction.storeTransaction');
    Route::post('/transaction/report', 'TransactionController@report')->name('transaction.report');
    Route::get('/struk/{transaction_code?}', 'TransactionController@struk')->name('transaction.struk');
    Route::resource('transaction', 'TransactionController')->except([
        'create'
    ]);
    Route::get('/transaction/create/{transaction_code?}', 'TransactionController@create')->name('transaction.create');

    Route::get('/profile', 'ProfileController@index')->name('profile.index');
    Route::put('/profile', 'ProfileController@update')->name('profile.update');
});

Auth::routes(['verify' => true]);