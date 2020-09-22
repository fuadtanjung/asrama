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

        Route::group(['prefix' => 'data'], function(){
            Route::get('/','DataController@index')->name('datamahasiswa');
            Route::get('detailmahasiswa/{id}','DataController@detailmahasiswa')->name('detailmahasiswa');
            Route::get('tagihanmahasiswa/{id}', 'DataController@tagihanmahasiswa')->name('tagihanmahasiswa');
        });

        Route::group(['prefix' => 'tugasbulananmahasiswa'], function() {
            Route::get('datatugasbulanan/{id}', 'TugasBulananMahasiswaController@data')->name('tugasbulanan');
            Route::post('inputtugasbulanan', 'TugasBulananMahasiswaController@inputtugasbulanan');
            Route::post('edittugasbulanan/{id}', 'TugasBulananMahasiswaController@edittugasbulanan');
            Route::post('hapustugasbulanan/{id}', 'TugasBulananMahasiswaController@hapustugasbulanan');
            Route::get('listtugas', 'TugasBulananMahasiswaController@listTugas');
        });

        Route::group(['prefix' => 'tagihan'], function() {
            Route::get('datatagihanmahasiswa', 'TagihanMahasiswaController@ajaxTable');
            Route::post('inputtagihanmahasiswa', 'TagihanMahasiswaController@input');
            Route::post('edittagihanmahasiswa/{id}', 'TagihanMahasiswaController@edit');
            Route::post('hapustagihanmahasiswa/{id}', 'TagihanMahasiswaController@delete');
        });

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

        Route::group(['prefix' => 'gedung'], function(){
            Route::get('/','GedungController@index');
            Route::get('data', 'GedungController@ajaxTable');
            Route::post('input', 'GedungController@input');
            Route::post('edit/{id}', 'GedungController@edit');
            Route::post('delete/{id}', 'GedungController@delete');
        });

        Route::group(['prefix' => 'ruangan'], function(){
            Route::get('/','RuanganController@index');
            Route::get('data', 'RuanganController@ajaxTable');
            Route::post('input', 'RuanganController@input');
            Route::post('edit/{id}', 'RuanganController@edit');
            Route::post('delete/{id}', 'RuanganController@delete');
            Route::get('listgedung', 'RuanganController@listGedung');
        });

        Route::group(['prefix' => 'tugas'], function(){
            Route::get('/','TugasController@index');
            Route::get('data', 'TugasController@ajaxTable');
            Route::post('input', 'TugasController@input');
            Route::post('edit/{id}', 'TugasController@edit');
            Route::post('delete/{id}', 'TugasController@delete');
        });

        Route::group(['prefix' => 'tugasbulanan'], function(){
            Route::get('/','TugasBulananController@index');
            Route::get('data', 'TugasBulananController@ajaxTable');
            Route::post('input', 'TugasBulananController@input');
            Route::post('edit/{id}', 'TugasBulananController@edit');
            Route::post('delete/{id}', 'TugasBulananController@delete');
            Route::get('listtugas', 'TugasBulananController@listTugas');
        });

    });

    Route::group(['middleware' => ['checkRole:mahasiswa']], function () {

        Route::group(['prefix' => 'mahasiswa'], function(){
            Route::get('/','MahasiswaController@index');
            Route::post('input', 'MahasiswaController@input');
            Route::get('listjurusan', 'MahasiswaController@listJurusan');
            Route::get('liststatusrumah', 'MahasiswaController@listStatusrumah');
            Route::get('listjalurmasuk', 'MahasiswaController@listJalurmasuk');
            Route::get('listgoldar', 'MahasiswaController@listGoldar');
        });

        Route::group(['prefix' => 'riwayatpenyakit'], function(){
            Route::get('/','RiwayatpenyakitController@index');
            Route::get('data', 'RiwayatpenyakitController@ajaxTable');
            Route::post('input', 'RiwayatpenyakitController@input');
            Route::post('edit/{id}', 'RiwayatpenyakitController@edit');
            Route::post('delete/{id}', 'RiwayatpenyakitController@delete');
        });

        Route::group(['prefix' => 'pengalamanorganisasi'], function(){
            Route::get('/','PengalamanorganisasiController@index');
            Route::get('data', 'PengalamanorganisasiController@ajaxTable');
            Route::post('input', 'PengalamanorganisasiController@input');
            Route::post('edit/{id}', 'PengalamanorganisasiController@edit');
            Route::post('delete/{id}', 'PengalamanorganisasiController@delete');
        });
    });
});
