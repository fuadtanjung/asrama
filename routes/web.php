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
            Route::post('delete/{id}', 'FakultasController@delete');
        });

        Route::group(['prefix' => 'jurusan'], function(){
            Route::get('/','JurusanController@index');
            Route::get('data', 'JurusanController@ajaxTable');
            Route::post('input', 'JurusanController@input');
            Route::post('edit/{id}', 'JurusanController@edit');
            Route::post('delete/{id}', 'JurusanController@delete');
            Route::get('listfakultas', 'JurusanController@listFakultas');
        });

        Route::group(['prefix' => 'goldar'], function(){
            Route::get('/','GoldarController@index');
            Route::get('data', 'GoldarController@ajaxTable');
            Route::post('input', 'GoldarController@input');
            Route::post('edit/{id}', 'GoldarController@edit');
            Route::post('delete/{id}', 'GoldarController@delete');
        });

        Route::group(['prefix' => 'jalurmasuk'], function(){
            Route::get('/','JalurMasukController@index');
            Route::get('data', 'JalurMasukController@ajaxTable');
            Route::post('input', 'JalurMasukController@input');
            Route::post('edit/{id}', 'JalurMasukController@edit');
            Route::post('delete/{id}', 'JalurMasukController@delete');
        });


    });
});
