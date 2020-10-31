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
    Route::get('/bestellen', 'Guest\GuestHomeController@order');
    Route::post('/bestellen', 'Guest\GuestHomeController@placeOrder');
    Route::get('/bestelling/volgen/{uuid}', 'Guest\GuestHomeController@trackOrder');
    Route::get('/bedankt/{uuid}', 'Guest\GuestHomeController@thanks');
});


//Admin routes
Route::group(['prefix' => '/admin'], function () {
    Route::get('/', 'Admin\DashboardController@dashboard');
    Route::get('/dashboard', 'Admin\DashboardController@dashboard');

    Route::group(['prefix' => '/producten'], function () {
        Route::get('/', 'Admin\ProductsController@products');
        Route::get('/toevoegen', 'Admin\ProductsController@add');
        Route::post('/toevoegen', 'Admin\ProductsController@save');
        Route::get('/bewerken/{id}', 'Admin\ProductsController@edit');
        Route::post('/bewerken/{id}', 'Admin\ProductsController@update');
        Route::get('/verwijderen/{id}', 'Admin\ProductsController@delete');
    });

    Route::group(['prefix' => '/categorieen'], function () {
        Route::get('/', 'Admin\CategoriesController@categories');
        Route::get('/toevoegen', 'Admin\CategoriesController@add');
        Route::get('/bewerken/{id}', 'Admin\CategoriesController@edit');
        Route::post('/toevoegen', 'Admin\CategoriesController@save');
        Route::post('/bewerken/{id}', 'Admin\CategoriesController@update');
        Route::get('/verwijderen/{id}', 'Admin\CategoriesController@delete');
    });

    Route::group(['prefix' => '/menus'], function () {
        Route::get('/', 'Admin\MenusController@menus');
        Route::get('/toevoegen', 'Admin\MenusController@add');
        Route::get('/bewerken/{id}', 'Admin\MenusController@edit');
        Route::post('/toevoegen', 'Admin\MenusController@save');
        Route::post('/bewerken/{id}', 'Admin\MenusController@update');
        Route::get('/verwijderen/{id}', 'Admin\MenusController@delete');
    });

    Route::group(['prefix' => '/standaard-extras'], function () {
        Route::get('/', 'Admin\StandardExtrasController@standardextras');
        Route::get('/toevoegen', 'Admin\StandardExtrasController@add');
        Route::post('/toevoegen', 'Admin\StandardExtrasController@save');
        Route::get('/bewerken/{id}', 'Admin\StandardExtrasController@edit');
        Route::post('/bewerken/{id}', 'Admin\StandardExtrasController@update');
        Route::get('/verwijderen/{id}', 'Admin\StandardExtrasController@delete');
    });

    Route::group(['prefix' => '/bestellingen'], function () {
        Route::get('/', 'Admin\OrdersController@orders');
        Route::get('/toevoegen', 'Admin\OrdersController@add');
        Route::get('/bewerken/{id}', 'Admin\OrdersController@edit');
        Route::post('/toevoegen', 'Admin\OrdersController@save');
        Route::post('/bewerken/{id}', 'Admin\OrdersController@update');
        Route::get('/verwijderen/{id}', 'Admin\OrdersController@delete');
    });

    Route::group(['prefix' => '/orderwindow'], function () {
        Route::get('/', 'Admin\OrderwindowController@orderwindow');
    });

    Route::group(['prefix' => '/gebruikers'], function () {
        Route::get('/', 'Admin\UsersController@users');
        Route::get('/toevoegen', 'Admin\UsersController@add');
        Route::post('/toevoegen', 'Admin\UsersController@save');
        Route::get('/bewerken/{id}', 'Admin\UsersController@edit');
        Route::post('/bewerken/{id}', 'Admin\UsersController@update');
        Route::get('/verwijderen/{id}', 'Admin\UsersController@delete');
    });

    Route::group(['prefix' => '/rechten'], function () {
        Route::get('/', 'Admin\PermissionsController@groups');
        Route::get('/groepen', 'Admin\PermissionsController@groups');
        Route::get('/groepen/toevoegen', 'Admin\PermissionsController@groupAdd');
        Route::post('/groepen/toevoegen', 'Admin\PermissionsController@groupSave');
        Route::get('/groepen/bewerken/{id}', 'Admin\PermissionsController@groupEdit');
        Route::post('/groepen/bewerken/{id}', 'Admin\PermissionsController@groupUpdate');
        Route::get('/groepen/verwijderen/{id}', 'Admin\PermissionsController@groupDelete');
        Route::get('/gebruikers', 'Admin\PermissionsController@users');
    });

    Route::group(['prefix' => '/instellingen'], function () {
        Route::get('/', 'Admin\SettingsController@general');
        Route::get('/algemeen', 'Admin\SettingsController@general');
        Route::get('/openingstijden', 'Admin\SettingsController@openinghours');
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

    Route::group(['prefix' => '/klanten'], function () {
        Route::group(['prefix' => '/particulieren'], function () {
            Route::get('/', 'Admin\CustomerIndividualsController@individuals');
            Route::get('/toevoegen', 'Admin\CustomerIndividualsController@add');
            Route::get('/bewerken/{id}', 'Admin\CustomerIndividualsController@edit');
            Route::get('/verwijderen/{id}', 'Admin\CustomerIndividualsController@delete');
            Route::post('/toevoegen', 'Admin\CustomerIndividualsController@save');
            Route::post('/bewerken/{id}', 'Admin\CustomerIndividualsController@update');
        });

        Route::group(['prefix' => '/bedrijven'], function () {
            Route::get('/', 'Admin\CustomerCompaniesController@companies');
            Route::get('/toevoegen', 'Admin\CustomerCompaniesController@add');
            Route::get('/bewerken/{id}', 'Admin\CustomerCompaniesController@edit');
            Route::get('/verwijderen/{id}', 'Admin\CustomerCompaniesController@delete');
            Route::post('/toevoegen', 'Admin\CustomerCompaniesController@save');
            Route::post('/bewerken/{id}', 'Admin\CustomerCompaniesController@update');
        });
    });
});

Route::group(['prefix' => '/api'], function () {
    Route::post('/getcart', 'APIController@getCart');
    Route::post('/addproducttocart', 'APIController@addProductToCart');
    Route::post('/removeproductfromcart', 'APIController@removeProductFromCart');
    Route::post('/updateproductquantityincart', 'APIController@updateProductQuantityInCart');
    Route::post('/orderlist', 'APIController@orderList');
    Route::post('/setorderstatus', 'APIController@setOrderStatus');
});

Route::group(['prefix' => '/webhooks'], function() {
    Route::post('/mollie', 'MollieWebhookController@handle');
});
