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

Route::get('/', 'Controller@index')->name('home');
Route::post('/', 'Controller@submit');
Route::get('/goods', 'Controller@goodList')->name('good_list');
Route::get('/goods/{goodId}', 'Controller@goodItem')->name('good_item');
