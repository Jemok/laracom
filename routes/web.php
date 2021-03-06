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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/**
 * Admin routes
 */
Route::namespace('Admin')->group(function () {
    Route::get('admin/login', 'LoginController@showLoginForm');
    Route::post('admin/login', 'LoginController@login')->name('admin.login');
    Route::get('admin/logout', 'LoginController@logout')->name('admin.logout');
});
Route::group(['prefix' => 'admin', 'middleware' => 'admin', 'as' => 'admin.' ], function () {

    Route::namespace('Admin')->group(function () {
        Route::get('/', 'DashboardController@index')->name('dashboard');
        Route::namespace('Customers')->group(function () {
            Route::resource('customers', 'CustomerController');
            Route::resource('customers.addresses', 'CustomerAddressController');
        });
        Route::namespace('Products')->group(function () {
            Route::resource('products', 'ProductController');
            Route::get('remove-image-product', 'ProductController@removeImage')->name('product.remove.image');
            Route::get('remove-image-thumb', 'ProductController@removeThumbnail')->name('product.remove.thumb');
        });
        Route::namespace('Categories')->group(function () {
            Route::resource('categories', 'CategoryController');
            Route::get('remove-image-category', 'CategoryController@removeImage')->name('category.remove.image');
        });
        Route::namespace('Orders')->group(function () {
            Route::resource('orders', 'OrderController');
            Route::resource('order-statuses', 'OrderStatusController');
            Route::get('orders/{id}/invoice', 'OrderController@generateInvoice')->name('orders.invoice.generate');
        });
        Route::resource('employees', 'EmployeeController');
        Route::get('employees/{id}/profile', 'EmployeeController@getProfile')->name('employee.profile');
        Route::put('employees/{id}/profile', 'EmployeeController@updateProfile')->name('employee.profile.update');
        Route::resource('addresses', 'Addresses\AddressController');
        Route::resource('countries', 'Countries\CountryController');
        Route::resource('countries.provinces', 'Provinces\ProvinceController');
        Route::resource('countries.provinces.cities', 'Cities\CityController');
        Route::resource('couriers', 'Couriers\CourierController');
        Route::resource('payment-methods', 'PaymentMethods\PaymentMethodController');
    });
});

/**
 * Frontend routes
 */
Auth::routes();
Route::namespace('Auth')->group(function () {
    Route::get('cart/login', 'CartLoginController@showLoginForm')->name('cart.login');
    Route::post('cart/login', 'CartLoginController@login')->name('cart.login');
    Route::get('logout', 'LoginController@logout');
});

Route::namespace('Front')->group(function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::group(['middleware' => ['auth']], function () {
        Route::get('accounts', 'AccountsController@index')->name('accounts');
    });
    Route::resource('cart', 'CartController');
    Route::resource('customer', 'CustomerController');
    Route::resource('customer.address', 'CustomerAddressController');
    Route::get('checkout', 'CheckoutController@index')->name('checkout.index');
    Route::get('database', 'DBController@createRecommendationDb')->name('recommend');
    Route::post('checkout', 'CheckoutController@store')->name('checkout.store');
    Route::post('set-courier', 'CheckoutController@setCourier')->name('set.courier');
    Route::post('set-address', 'CheckoutController@setAddress')->name('set.address');
    Route::get('checkout/execute', 'CheckoutController@execute')->name('checkout.execute');
    Route::get('checkout/cancel', 'CheckoutController@cancel')->name('checkout.cancel');
    Route::get('checkout/success', 'CheckoutController@success')->name('checkout.success');
    Route::get("category/{slug}", 'CategoryController@getCategory')->name('front.category.slug');
    Route::get("search", 'ProductController@search')->name('search.product');
    Route::get("{product}", 'ProductController@getProduct')->name('front.get.product');

});


