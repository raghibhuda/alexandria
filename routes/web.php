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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// User route
Route::group(['middleware' => ['user']], function () {
    Route::get('/user/dashboard',function (){
        return ('User Dashboard');
    })->name('user.dashboard');
});
// Admin route
Route::group(['middleware' => ['admin']], function () {
    Route::get('/admin/dashboard',function (){
        return ('Admin Dashboard');
    })->name('admin.dashboard');
});
