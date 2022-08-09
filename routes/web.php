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

Route::get('', 'App\Http\Controllers\MainController@index')->name('main');
Route::get('siteplan/{name}', 'App\Http\Controllers\MainController@view')->name('main.view');

Route::get('cluster/{id}', 'App\Http\Controllers\ClusterController@view')->name('cluster.view');
Route::post('cluster/update', 'App\Http\Controllers\ClusterController@update')->name('cluster.update');


Route::get('member/auth', 'App\Http\Controllers\LoginController@index')->name('login')->middleware('guest');
Route::post('session','App\Http\Controllers\LoginController@authenticate')->name('login.session');
Route::post('logout','App\Http\Controllers\LoginController@logout');

Route::get('logged/register', 'App\Http\Controllers\RegisterController@index')->name('register.index');
Route::post('logged/register', 'App\Http\Controllers\RegisterController@store')->name('register.store');

Route::get('/dashboard', 'App\Http\Controllers\DashboardController@index')->name('dashboard.index');

Route::get('logged/siteplan', 'App\Http\Controllers\SiteplanController@index')->name('siteplan.index');
Route::get('logged/siteplan/{id}', 'App\Http\Controllers\SiteplanController@show')->name('siteplan.show');
Route::get('logged/siteplan/details/{id}', 'App\Http\Controllers\SiteplanController@details')->name('siteplan.details');
Route::post('logged/siteplan/update', 'App\Http\Controllers\SiteplanController@update')->name('siteplan.update');
Route::get('logged/siteplan/duplicate/{id}', 'App\Http\Controllers\SiteplanController@duplicate')->name('siteplan.duplicate');

Route::resource('logged/penghuni/card', 'App\Http\Controllers\CardController');
Route::post('logged/penghuni/card/upload', 'App\Http\Controllers\CardController@upload')->name('card.upload');
