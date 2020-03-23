<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('login', 'API\UserController@login');
Route::post('register', 'API\UserController@register');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
    // Admin group

    // Customer group
});

// Customer route
Route::group(['middleware' => ['user']], function () {
    Route::post('customer/all-authors', 'API\Customer\AuthorController@findAll')->name('customer.all.authors');

    Route::post('customer/get-book', 'API\Customer\BookController@findOne')->name('customer.find.book');
    Route::post('customer/all-books', 'API\Customer\BookController@findAll')->name('customer.all.books');

    Route::post('customer/all-categories', 'API\Customer\CategoryController@findAll')->name('customer.all.categories');
    Route::post('customer/all-paymentMethods', 'API\Customer\PaymentMethodController@findAll')->name('customer.all.paymentMethods');
    Route::post('customer/all-shippingMethods', 'API\Customer\ShippingMethodController@findAll')->name('customer.all.shippingMethods');
    Route::post('customer/all-publications', 'API\Customer\PublicationController@findAll')->name('customer.all.publications');

    Route::post('customer/cart-view-all', 'API\Customer\CartController@view')->name('customer.cart.view');
    Route::post('customer/cart-add-book', 'API\Customer\CartController@add')->name('customer.cart.add');
    Route::post('customer/cart-remove-book', 'API\Customer\CartController@remove')->name('customer.cart.remove');

    Route::post('customer/wish-list-view-all', 'API\Customer\WishListController@view')->name('customer.wishList.view');
    Route::post('customer/wish-list-add-book', 'API\Customer\WishListController@add')->name('customer.wishList.add');
    Route::post('customer/wish-list-remove-book', 'API\Customer\WishListController@remove')->name('customer.wishList.remove');

    Route::post('customer/order-view', 'API\Customer\OrderController@view')->name('customer.order.view');
    Route::post('customer/order-place', 'API\Customer\OrderController@place')->name('customer.order.place');
});
// Admin route
Route::group(['middleware' => ['admin']], function () {
    Route::post('admin/get-author', 'API\Admin\AuthorController@findOne')->name('admin.find.author');
    Route::post('admin/all-authors', 'API\Admin\AuthorController@findAll')->name('admin.all.authors');
    Route::post('admin/create-author', 'API\Admin\AuthorController@create')->name('admin.create.author');
    Route::post('admin/update-author', 'API\Admin\AuthorController@update')->name('admin.update.author');
    Route::post('admin/delete-author', 'API\Admin\AuthorController@delete')->name('admin.update.author');

    Route::post('admin/get-book', 'API\Admin\BookController@findOne')->name('admin.find.book');
    Route::post('admin/all-books', 'API\Admin\BookController@findAll')->name('admin.all.books');
    Route::post('admin/create-book', 'API\Admin\BookController@create')->name('admin.create.book');
    Route::post('admin/update-book', 'API\Admin\BookController@update')->name('admin.update.book');
    Route::post('admin/delete-book', 'API\Admin\BookController@delete')->name('admin.update.book');

    Route::post('admin/get-category', 'API\Admin\CategoryController@findOne')->name('admin.find.category');
    Route::post('admin/all-categories', 'API\Admin\CategoryController@findAll')->name('admin.all.categories');
    Route::post('admin/create-category', 'API\Admin\CategoryController@create')->name('admin.create.category');
    Route::post('admin/update-category', 'API\Admin\CategoryController@update')->name('admin.update.category');
    Route::post('admin/delete-category', 'API\Admin\CategoryController@delete')->name('admin.update.category');

    Route::post('admin/get-publication', 'API\Admin\PublicationController@findOne')->name('admin.find.publication');
    Route::post('admin/all-publications', 'API\Admin\PublicationController@findAll')->name('admin.all.publications');
    Route::post('admin/create-publication', 'API\Admin\PublicationController@create')->name('admin.create.publication');
    Route::post('admin/update-publication', 'API\Admin\PublicationController@update')->name('admin.update.publication');
    Route::post('admin/delete-publication', 'API\Admin\PublicationController@delete')->name('admin.update.publication');

    Route::post('admin/get-paymentMethod', 'API\Admin\PaymentMethodController@findOne')->name('admin.find.paymentMethod');
    Route::post('admin/all-paymentMethods', 'API\Admin\PaymentMethodController@findAll')->name('admin.all.paymentMethods');
    Route::post('admin/create-paymentMethod', 'API\Admin\PaymentMethodController@create')->name('admin.create.paymentMethod');
    Route::post('admin/update-paymentMethod', 'API\Admin\PaymentMethodController@update')->name('admin.update.paymentMethod');
    Route::post('admin/delete-paymentMethod', 'API\Admin\PaymentMethodController@delete')->name('admin.update.paymentMethod');

    Route::post('admin/get-shippingMethod', 'API\Admin\ShippingMethodController@findOne')->name('admin.find.shippingMethod');
    Route::post('admin/all-shippingMethods', 'API\Admin\ShippingMethodController@findAll')->name('admin.all.shippingMethods');
    Route::post('admin/create-shippingMethod', 'API\Admin\ShippingMethodController@create')->name('admin.create.shippingMethod');
    Route::post('admin/update-shippingMethod', 'API\Admin\ShippingMethodController@update')->name('admin.update.shippingMethod');
    Route::post('admin/delete-shippingMethod', 'API\Admin\ShippingMethodController@delete')->name('admin.update.shippingMethod');

    Route::post('admin/get-order', 'API\Admin\OrderController@findOne')->name('admin.find.order');
    Route::post('admin/all-orders', 'API\Admin\OrderController@findAll')->name('admin.all.orders');
});
