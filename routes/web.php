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

    Route::group(['prefix' => '/producten'], function () {
        Route::get('/', 'Admin\ProductsController@overview');
        Route::get('/toevoegen', 'Admin\ProductsController@add');
        Route::get('/{id}/bewerken', 'Admin\ProductsController@edit');
        Route::post('/toevoegen', 'Admin\ProductsController@save');
        Route::post('/{id}/bewerken', 'Admin\ProductsController@update');
        Route::post('/{id}/verwijderen', 'Admin\ProductsController@delete');
    });

    Route::group(['prefix' => '/categorieen'], function () {
        Route::get('/', 'Admin\CategoriesController@overview');
        Route::get('/toevoegen', 'Admin\CategoriesController@add');
        Route::get('/{id}/bewerken', 'Admin\CategoriesController@edit');
        Route::post('/toevoegen', 'Admin\CategoriesController@save');
        Route::post('/{id}/bewerken', 'Admin\CategoriesController@update');
        Route::post('/{id}/verwijderen', 'Admin\CategoriesController@delete');
    });
    
    Route::group(['prefix' => '/gebruikers'], function () {
        Route::get('/', 'Admin\UsersController@overview');
    });
    
    Route::group(['prefix' => '/permissies'], function () {
        Route::get('/', 'Admin\PermissionsController@groups');
        Route::get('/groepen', 'Admin\PermissionsController@groups');
        Route::get('/gebruikers', 'Admin\PermissionsController@users');
    });

    Route::group(['prefix' => '/instellingen'], function () {
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
