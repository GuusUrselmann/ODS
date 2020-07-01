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


//Admin routes
Route::group(['prefix' => '/admin'], function() {
    Route::get('/', 'Admin\AdminDashboardController@dashboard');
    Route::get('/dashboard', 'Admin\AdminDashboardController@dashboard');
    Route::group(['prefix' => '/products'], function() {
        Route::get('/', 'Admin\AdminProductsController@products');
        Route::get('/add', 'Admin\AdminProductsController@productAdd');
        Route::get('/{id}/edit', 'Admin\AdminProductsController@productEdit');
        Route::post('/add', 'Admin\AdminProductsController@productAddSave');
        Route::post('/{id}/edit', 'Admin\AdminProductsController@productEditSave');
        Route::post('/{id}/delete', 'Admin\AdminProductsController@productDelete');
    });
    Route::group(['prefix' => '/categories'], function() {
        Route::get('/', 'Admin\AdminCategoriesController@categories');
        Route::get('/add', 'Admin\AdminCategoriesController@categoryAdd');
        Route::get('/{id}/edit', 'Admin\AdminCategoriesController@categoryEdit');
        Route::post('/add', 'Admin\AdminCategoriesController@categoryAddSave');
        Route::post('/{id}/edit', 'Admin\AdminCategoriesController@categoryEditSave');
        Route::post('/{id}/delete', 'Admin\AdminCategoriesController@categoryDelete');
    });
    Route::group(['prefix' => '/coupons'], function() {
        Route::get('/', 'Admin\AdminCouponsController@coupons');
    });
    Route::group(['prefix' => '/users'], function() {
        Route::get('/', 'Admin\AdminUsersController@users');
    });
    Route::group(['prefix' => '/branches'], function() {
        Route::get('/', 'Admin\AdminBranchesController@branches');
    });
    Route::group(['prefix' => '/permissions'], function() {
        Route::get('/', 'Admin\AdminPermissionsController@groups');
        Route::get('/groups', 'Admin\AdminPermissionsController@groups');
        Route::get('/users', 'Admin\AdminPermissionsController@users');
    });
    Route::group(['prefix' => '/settings'], function() {
        Route::get('/', 'Admin\AdminSettingsController@settings');
    });


});
