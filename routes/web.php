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



Route::get('/', 'AuthController@start')->name('start');
Route::get('/login', 'AuthController@start')->name('form');
Route::post('login', 'AuthController@login')->name('login');

Route::group(['middleware' => 'auth'], function () {

    Route::group(['prefix' => 'dashboard'], function(){
        Route::get('/', 'DashboardController@index')->name('dashboard');
        Route::get('get_data', 'DashboardController@get_data')->name('dashboard.get_data');
        Route::get('delete/{id?}', 'DashboardController@delete')->name('dashboard.delete');
        Route::get('view/{id?}', 'DashboardController@view')->name('dashboard.view');
        Route::get('download/{id?}', 'DashboardController@download')->name('dashboard.download');
        Route::get('user', 'SettingController@user')->name('dashboard.user');
        Route::post('key', 'SettingController@keygen')->name('dashboard.keygen');
        Route::post('changepassword', 'SettingController@change_password')->name('dashboard.changepassword');
        Route::post('name', 'SettingController@name')->name('dashboard.name');

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
        Route::get('get_koneksi/{id?}', 'ObjekController@get_koneksi')->name('objek.get_koneksi');
    });

    Route::group(['prefix' => 'jenis_dokumen'], function(){
        Route::get('/', 'Jenis_Dokumen_Controller@index')->name('jenis_dokumen');
        Route::get('get_data', 'Jenis_Dokumen_Controller@get_data')->name('jenis_dokumen.get_data');
        Route::get('create', 'Jenis_Dokumen_Controller@create')->name('jenis_dokumen.create');
        Route::post('store', 'Jenis_Dokumen_Controller@store')->name('jenis_dokumen.store');
        Route::get('edit/{id?}', 'Jenis_Dokumen_Controller@edit')->name('jenis_dokumen.edit');
        Route::post('update/{id?}', 'Jenis_Dokumen_Controller@update')->name('jenis_dokumen.update');
        Route::get('delete/{id?}', 'Jenis_Dokumen_Controller@delete')->name('jenis_dokumen.delete');
        Route::get('get_koneksi/{id?}', 'Jenis_Dokumen_controller@get_koneksi')->name('jenis_dokumen.get_koneksi');
    });

    Route::group(['prefix' => 'users'], function(){
        Route::get('/', 'UsersController@index')->name('users');
        Route::get('create', 'UsersController@create')->name('users.create');
        Route::post('store', 'UsersController@store')->name('users.store');
        Route::get('delete/{id?}', 'UsersController@destroy')->name('users.delete');
        Route::get('edit/{id?}', 'UsersController@edit')->name('users.edit');
        Route::get('get_data', 'UsersController@get_data')->name('users.get_data');
        Route::get('view/{id?}', 'UsersController@view')->name('users.view');
        Route::post('name/{id?}', 'UsersController@name')->name('users.name');
        Route::get('reset/{id?}', 'UsersController@reset')->name('users.resetPassword');
        Route::post('changepassword/{id?}', 'UsersController@change_password')->name('users.changepassword');
    });

    Route::group(['prefix' => 'cetak'], function(){
        Route::get('/', 'CetakController@index')->name('cetak');
        Route::get('create/{id?}', 'CetakController@create')->name('cetak.create');
        Route::get('store/{id?}', 'CetakController@store')->name('cetak.store');
        Route::get('get_data', 'CetakController@get_data')->name('cetak.get_data');
        Route::get('download/{id?}', 'CetakController@download')->name('cetak.download');
    });


    Route::get('logout', 'AuthController@logout')->name('logout');
});

