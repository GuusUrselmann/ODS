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

Route::group(['prefix' => '/'], function () {
    Route::get('/', 'Guest\GuestHomeController@home');
    Route::get('/home', 'Guest\GuestHomeController@home');
});


//Admin routes
Route::group(['prefix' => '/admin'], function () {
    Route::get('/', 'Admin\DashboardController@dashboard');
    Route::get('/dashboard', 'Admin\DashboardController@dashboard');
    Route::group(['prefix' => '/products'], function () {
        Route::get('/', 'Admin\ProductsController@overview');
        Route::get('/add', 'Admin\ProductsController@add');
        Route::get('/{id}/edit', 'Admin\ProductsController@edit');
        Route::post('/add', 'Admin\ProductsController@save');
        Route::post('/{id}/edit', 'Admin\ProductsController@update');
        Route::post('/{id}/delete', 'Admin\ProductsController@delete');
    });

    Route::group(['prefix' => '/categories'], function () {
        Route::get('/', 'Admin\CategoriesController@overview');
        Route::get('/add', 'Admin\CategoriesController@add');
        Route::get('/{id}/edit', 'Admin\CategoriesController@edit');
        Route::post('/add', 'Admin\CategoriesController@save');
        Route::post('/{id}/edit', 'Admin\CategoriesController@update');
        Route::post('/{id}/delete', 'Admin\CategoriesController@delete');
    });
    
    Route::group(['prefix' => '/users'], function () {
        Route::get('/', 'Admin\UsersController@overview');
    });
    
    Route::group(['prefix' => '/permissions'], function () {
        Route::get('/', 'Admin\PermissionsController@groups');
        Route::get('/groups', 'Admin\PermissionsController@groups');
        Route::get('/users', 'Admin\PermissionsController@users');
    });

    Route::group(['prefix' => '/settings'], function () {
        Route::get('/', 'Admin\SettingsController@overview');
    });

    Route::group(['prefix' => '/couponcodes'], function () {
        Route::get('/', 'Admin\CouponcodesController@overview');
        Route::get('/bewerken/{id}', 'Admin\CouponcodesController@edit');
        Route::post('/bewerken/{id}', 'Admin\CouponcodesController@update');
        Route::get('/toevoegen', 'Admin\CouponcodesController@add');
        Route::post('/toevoegen', 'Admin\CouponcodesController@save');
        Route::get('/verwijderen', 'Admin\CouponcodesController@delete');
    });

    Route::group(['prefix' => '/filialen'], function () {
        Route::get('/', 'Admin\BranchesController@overview');
        Route::get('/openingstijden', 'Admin\BranchesController@openingHours');
        Route::get('/toevoegen', 'Admin\BranchesController@add');
        Route::post('/toevoegen', 'Admin\BranchesController@save');
        Route::get('/bewerken/{id}', 'Admin\BranchesController@edit');
        Route::post('/bewerken/{id}', 'Admin\BranchesController@update');
        Route::post('/verwijderen/{id}', 'Admin\BranchesController@delete');
    });
});
