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

Route::get('/', 'App\Http\Controllers\MainController@index')->name('main');
Route::get('/denah/{id}', 'App\Http\Controllers\MainController@view')->name('main.view');
Route::get('/_attribute/{id}', 'App\Http\Controllers\MainController@details')->name('main.details');
Route::post('/update/_attribute/', 'App\Http\Controllers\MainController@update')->name('main.update');
