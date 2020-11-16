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

// use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('start');
});

Route::group(['prefix' => 'dashboard'], function(){
    Route::get('/', 'DashboardController@index')->name('dashboard');
});

Route::group(['prefix' => 'koneksi'], function(){
    Route::get('/', 'KoneksiController@index')->name('koneksi');
    Route::get('create', 'KoneksiController@create')->name('koneksi.create');
    Route::get('get', 'KoneksiController@get')->name('koneksi.get');
    Route::post('store', 'KoneksiController@store')->name('koneksi.store');
    Route::post('update/{id?}', 'KoneksiController@update')->name('koneksi.update');
    Route::get('edit/{id?}', 'KoneksiController@edit')->name('koneksi.edit');
    Route::get('delete/{id?}', 'KoneksiController@delete')->name('koneksi.delete');
});

Route::group(['prefix' => 'start'], function(){
    Route::get('/', 'StartController@start')->name('start');
});

Route::group(['prefix' => 'objek'], function(){
    Route::get('/', 'ObjekController@index')->name('objek');
    Route::get('create', 'ObjekController@create')->name('objek.create');
    Route::post('store', 'ObjekController@store')->name('objek.store');
    Route::get('edit/{id?}', 'ObjekController@edit')->name('objek.edit');
    Route::get('delete/{id?}', 'ObjekController@delete')->name('objek.delete');
    Route::get('view/{id?}', 'ObjekController@view')->name('objek.view');
    Route::post('update/{id?}', 'ObjekController@update')->name('objek.update');
    Route::get('get_data', 'ObjekController@get_data')->name('objek.get_data');
});

Route::group(['prefix' => 'jenis_dokumen'], function(){
    Route::get('/', 'Jenis_Dokumen_Controller@index')->name('jenis_dokumen');
    Route::get('get_data', 'Jenis_Dokumen_Controller@get_data')->name('jenis_dokumen.get_data');
    Route::get('create', 'Jenis_Dokumen_Controller@create')->name('jenis_dokumen.create');
    Route::post('store', 'Jenis_Dokumen_Controller@store')->name('jenis_dokumen.store');
    Route::get('edit/{id?}', 'Jenis_Dokumen_Controller@edit')->name('jenis_dokumen.edit');
    Route::post('update/{id?}', 'Jenis_Dokumen_Controller@update')->name('jenis_dokumen.update');
    Route::get('delete/{id?}', 'Jenis_Dokumen_Controller@delete')->name('jenis_dokumen.delete');
});

Route::group(['prefix' => 'cetak'], function(){
    Route::get('/', 'CetakController@index')->name('cetak');
    Route::get('create', 'CetakController@create')->name('cetak.create');
    Route::get('edit/{id?}', 'CetakController@edit')->name('cetak.edit');
    Route::post('update/{id?}', 'CetakController@update')->name('cetak.update');
    Route::get('delete/{id?}', 'CetakController@delete')->name('cetak.delete');
    Route::post('store', 'CetakController@store')->name('cetak.store');
    Route::get('get_data', 'CetakController@get_data')->name('cetak.get_data');
});