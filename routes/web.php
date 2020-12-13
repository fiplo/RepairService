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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/order/create', 'OrderController@create')->name('order.create');
Route::get('/order/show', 'OrderController@show')->name('order.show');
Route::get('/order/{order}/edit', 'OrderController@edit')->name('order.edit');
Route::get('/order/{order}', 'OrderController@index')->name('order.show');
Route::get('/user/show', 'UserController@show')->name('user.show');
Route::get('/user/{user}', 'UserController@index')->name('user.index');
Route::get('/user/{user}/edit', 'UserController@edit')->name('user.edit');
Route::patch('/user/{id}', 'UserController@update')->name('user.update');
Route::patch('/order/{order}', 'OrderController@update')->name('order.update');
Route::post('/order', 'OrderController@store');



