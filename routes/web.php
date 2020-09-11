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

Route::get('/','LoginController@index')->name('login.index');
Route::post('login','LoginController@postlogin')->name('login.postlogin');
Route::get('logout','LoginController@logout')->name('login.logout');

Route::post('register','RegisterController@input')->name('register');

Route::group(['middleware' => ['auth']], function () {
    Route::group(['middleware' => ['checkRole:pembina,mahasiswa']], function () {
        Route::get('/home', 'HomeController@index')->name('home');
    });

    Route::group(['middleware' => ['checkRole:pembina']], function () {
        Route::group(['prefix' => 'fakultas'], function(){
            Route::get('/','FakultasController@index');
            Route::get('data', 'FakultasController@ajaxTable');
            Route::post('input', 'FakultasController@input');
            Route::post('edit/{id}', 'FakultasController@edit');
            Route::post('change/{id}', 'FakultasController@changeStatus');
            Route::post('delete/{id}', 'FakultasController@delete');
        });
    });
});
