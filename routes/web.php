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
Route::get('/siteplan/{id}', 'App\Http\Controllers\MainController@view')->name('main.view');
Route::get('/_attribute/{id}', 'App\Http\Controllers\AttributeController@details')->name('attribute.details');
Route::post('/update/_attribute/', 'App\Http\Controllers\AttributeController@update')->name('attribute.update');
Route::post('/update/_main/', 'App\Http\Controllers\MainController@update')->name('main.update');


Route::get('/member/auth', 'App\Http\Controllers\LoginController@index')->name('login')->middleware('guest');
Route::post('/session','App\Http\Controllers\LoginController@authenticate')->name('login.session');
Route::post('/logout','App\Http\Controllers\LoginController@logout');

Route::get('/member/register', 'App\Http\Controllers\RegisterController@index')->name('register.index');
Route::post('/register', 'App\Http\Controllers\RegisterController@store')->name('register.store');

Route::get('/member/dashboard', 'App\Http\Controllers\DashboardController@index')->name('dashboard.index');
Route::get('/member/siteplan', 'App\Http\Controllers\SiteplanController@index')->name('siteplan.index');
Route::get('/member/siteplan/{name}', 'App\Http\Controllers\SiteplanController@details')->name('siteplan.details');
