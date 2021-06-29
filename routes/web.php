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

Route::get('/surat-masuk', 'SuratMasukController@index')->name('surat-masuk.index');
Route::get('/surat-masuk/create', 'SuratMasukController@create')->name('surat-masuk.create');
Route::post('/surat-masuk/store', 'SuratMasukController@store')->name('surat-masuk.store');
Route::get('/surat-masuk/{id}/edit', 'SuratMasukController@edit')->name('surat-masuk.edit');
Route::put('/surat-masuk/{id}', 'SuratMasukController@update')->name('surat-masuk.update');
Route::delete('/surat-masuk/{id}', 'SuratMasukController@destroy')->name('surat-masuk.destroy');

Route::get('/surat-masuk/print', 'SuratMasukController@printPdfSuratMasuk')->name('surat-masuk.print');