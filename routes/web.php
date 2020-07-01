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

Route::group(['prefix' => '/'], function() {
    Route::get('/', 'Guest\GuestHomeController@home');
    Route::get('/home', 'Guest\GuestHomeController@home');
});

Route::group(['prefix' => '/admin'], function() {
    Route::get('/', 'Admin\AdminDashboardController@Dashboard');
    Route::get('/dashboard', 'Admin\AdminDashboardController@Dashboard');

    Route::group(['prefix' => '/couponcodes'], function() {
        Route::get('/', 'Admin\CouponcodesController@overview');
        Route::get('/bewerken/{id}', 'Admin\CouponcodesController@edit');
        Route::post('/bewerken/{id}', 'Admin\CouponcodesController@update');
        Route::get('/toevoegen', 'Admin\CouponcodesController@add');
        Route::post('/toevoegen', 'Admin\CouponcodesController@save');
        Route::get('/verwijderen', 'Admin\CouponcodesController@delete');
    });    
});