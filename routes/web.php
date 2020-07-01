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

    Route::group(['prefix' => '/filialen'], function() {
        Route::get('/', 'Admin\BranchesController@overview');
        Route::get('/openingstijden', 'Admin\BranchesController@openingHours');
        Route::get('/toevoegen', 'Admin\BranchesController@add');
        Route::post('/toevoegen', 'Admin\BranchesController@save');
        Route::get('/bewerken/{id}', 'Admin\BranchesController@edit');
        Route::post('/bewerken/{id}', 'Admin\BranchesController@update');
        Route::post('/verwijderen/{id}', 'Admin\BranchesController@delete');
    });
});
