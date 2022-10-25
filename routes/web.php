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

Route::get('', function () {
    $url = Request::url();
    if(($url == 'http://sie.tamankopoindah.com') || ($url == 'https://sie.tamankopoindah.com')){
        echo 'redirected';
    }else{
        return redirect('/siteplan/bulma');
    }
    
})->name('landing');

Route::get('siteplan/{themes}', 'App\Http\Controllers\MainController@index')->name('main');
Route::get('siteplan/{themes}/{name}', 'App\Http\Controllers\MainController@view')->name('main.view');
Route::get('siteplan/details/{themes}/{id}', 'App\Http\Controllers\MainController@details')->name('main.details');

Route::get('cluster/{id}', 'App\Http\Controllers\ClusterController@view')->name('cluster.view');
Route::post('cluster/update', 'App\Http\Controllers\ClusterController@update')->name('cluster.update');
Route::post('type/update', 'App\Http\Controllers\ClusterController@type_update')->name('type.update');


Route::get('member/auth', 'App\Http\Controllers\LoginController@index')->name('login')->middleware('guest');
Route::post('session','App\Http\Controllers\LoginController@authenticate')->name('login.session');
Route::post('logout','App\Http\Controllers\LoginController@logout');

Route::get('logged/register', 'App\Http\Controllers\RegisterController@index')->name('register.index');
Route::post('logged/register', 'App\Http\Controllers\RegisterController@store')->name('register.store');

Route::get('/dashboard', 'App\Http\Controllers\DashboardController@index')->name('dashboard.index');

Route::get('logged/siteplan', 'App\Http\Controllers\SiteplanController@index')->name('siteplan.index');
Route::get('logged/siteplan/{id}', 'App\Http\Controllers\SiteplanController@show')->name('siteplan.show');
Route::get('logged/siteplan/details/{id}', 'App\Http\Controllers\SiteplanController@details')->name('siteplan.details');
Route::get('logged/siteplan/delete/{id}', 'App\Http\Controllers\SiteplanController@delete_details')->name('details.delete');
Route::post('logged/siteplan/store/details', 'App\Http\Controllers\SiteplanController@store_details')->name('details.store');
Route::post('logged/siteplan/update', 'App\Http\Controllers\SiteplanController@update')->name('siteplan.update');
Route::get('logged/siteplan/duplicate/{id}', 'App\Http\Controllers\SiteplanController@duplicate')->name('siteplan.duplicate');

Route::resource('logged/penghuni/card', 'App\Http\Controllers\CardController');
Route::post('logged/penghuni/update/card', 'App\Http\Controllers\CardController@update')->name('card.update');
Route::post('logged/penghuni/card/upload', 'App\Http\Controllers\CardController@upload')->name('card.upload');

Route::get('logged/administrasi/masuk', 'App\Http\Controllers\AdministrasiController@masuk')->name('administrasi.masuk');
Route::get('logged/administrasi/masuk/{id}/edit', 'App\Http\Controllers\AdministrasiController@edit')->name('administrasi.masuk.show');
Route::put('logged/administrasi/{id}/update', 'App\Http\Controllers\AdministrasiController@update')->name('administrasi.update');
Route::get('logged/administrasi/delete/{id}', 'App\Http\Controllers\AdministrasiController@delete')->name('administrasi.delete');
Route::get('logged/administrasi/create/{jenis}', 'App\Http\Controllers\AdministrasiController@create')->name('administrasi.create');
Route::post('logged/administrasi/store', 'App\Http\Controllers\AdministrasiController@store')->name('administrasi.store');
Route::get('logged/administrasi/keluar', 'App\Http\Controllers\AdministrasiController@keluar')->name('administrasi.keluar');

Route::get('scale/fixing', 'App\Http\Controllers\SiteplanController@scale_fixing');
Route::get('landing', 'App\Http\Controllers\LoginController@landing');