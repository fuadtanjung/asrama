<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

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
Route::get('/getroomtest','CheckinController@getRoom');

Route::group(['middleware' => 'auth','throttle : 60,1'], function () {
    Route::group(['middleware' => ['checkRole:pembina,mahasiswa']], function () {
        Route::get('/home', 'HomeController@index')->name('home');
    });

    Route::group(['middleware' => ['checkRole:pembina']], function () {

        Route::group(['prefix' => 'data'], function(){
            Route::get('/','DataController@index')->name('datamahasiswa');
            Route::get('/tugasbulananmahasiswa','DataController@indextugasbulanan')->name('datatugasbulananmahasiswa');
            Route::get('/tagihanmahasiswa', 'DataController@indextagihan')->name('datatagihanmahasiswa');
            Route::get('/dendamahasiswa', 'DataController@indexdenda')->name('datadendamahasiswa');
            Route::get('detailmahasiswa/{id}','DataController@detailmahasiswa')->name('detailmahasiswa');
            Route::post('print','DataController@printtugas')->name('printtugas');

        });

        Route::group(['prefix' => 'tugasbulananmahasiswa'], function() {
            Route::get('/{id}', 'TugasBulananMahasiswaController@index')->name('tugasbulanan');
            Route::get('data/{id}', 'TugasBulananMahasiswaController@ajaxtable');
            Route::post('input', 'TugasBulananMahasiswaController@input');
            Route::post('edit/{tgs}/{mhs}', 'TugasBulananMahasiswaController@edit');
            Route::post('delete/{id}/{bulan}/{tahun}/{mhs}', 'TugasBulananMahasiswaController@delete');
        });

        Route::group(['prefix' => 'tagihanmahasiswa'], function() {
            Route::get('/{id}', 'TagihanMahasiswaController@index')->name('tagihan');
            Route::get('data/{id}', 'TagihanMahasiswaController@ajaxTable');
            Route::post('input', 'TagihanMahasiswaController@input');
            Route::post('edit/{bulan}/{mhs}', 'TagihanMahasiswaController@edit');
            Route::post('delete/{id}/{bulan}', 'TagihanMahasiswaController@delete');
        });

        Route::group(['prefix' => 'dendamahasiswa'], function() {
            Route::get('/{id}', 'DendaMahasiswaController@index')->name('denda');
            Route::get('data/{id}', 'DendaMahasiswaController@ajaxTable');
            Route::post('input', 'DendaMahasiswaController@input');
            Route::post('edit/{id}', 'DendaMahasiswaController@edit');
            Route::post('delete/{id}/{mhs}', 'DendaMahasiswaController@delete');
        });

        Route::group(['prefix' => 'pembina'], function(){
            Route::get('/','PembinaController@index');
            Route::post('input', 'PembinaController@input');
        });

        Route::group(['prefix' => 'akunpembina'], function(){
            Route::get('/','AkunPembinaController@index');
            Route::get('data', 'AkunPembinaController@ajaxTable');
            Route::post('input', 'AkunPembinaController@input');
            Route::post('edit/{id}', 'AkunPembinaController@edit');
            Route::post('delete/{id}', 'AkunPembinaController@delete');
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

        Route::group(['prefix' => 'golongandarah'], function(){
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

        Route::group(['prefix' => 'statusrumah'], function(){
            Route::get('/','StatusRumahController@index');
            Route::get('data', 'StatusRumahController@ajaxTable');
            Route::post('input', 'StatusRumahController@input');
            Route::post('edit/{id}', 'StatusRumahController@edit');
            Route::post('delete/{id}', 'StatusRumahController@delete');
        });

        Route::group(['prefix' => 'gedung'], function(){
            Route::get('/','GedungController@index');
            Route::get('data', 'GedungController@ajaxTable');
            Route::post('input', 'GedungController@input');
            Route::post('edit/{id}', 'GedungController@edit');
            Route::post('delete/{id}', 'GedungController@delete');
            Route::get('listgedung', 'GedungController@listGedung');
        });

        Route::group(['prefix' => 'ruangan'], function(){
            Route::get('/{id}','RuanganController@index');
            Route::get('data/{id}', 'RuanganController@ajaxTable');
            Route::post('input', 'RuanganController@input');
            Route::post('edit/{id}', 'RuanganController@edit');
            Route::post('delete/{id}', 'RuanganController@delete');
        });

        Route::group(['prefix' => 'tugas'], function(){
            Route::get('/','TugasController@index');
            Route::get('data', 'TugasController@ajaxTable');
            Route::post('input', 'TugasController@input');
            Route::post('edit/{id}', 'TugasController@edit');
            Route::post('delete/{id}', 'TugasController@delete');
        });

        Route::group(['prefix' => 'denda'], function(){
            Route::get('/','DendaController@index');
            Route::get('data', 'DendaController@ajaxTable');
            Route::post('input', 'DendaController@input');
            Route::post('edit/{id}', 'DendaController@edit');
            Route::post('delete/{id}', 'DendaController@delete');
            Route::get('listdenda', 'DendaController@listDenda');
        });

        Route::group(['prefix' => 'tugasbulanan'], function(){
            Route::get('/','TugasBulananController@index');
            Route::get('data', 'TugasBulananController@ajaxTable');
            Route::post('input', 'TugasBulananController@input');
            Route::post('edit/{id}', 'TugasBulananController@edit');
            Route::post('delete/{id}/{bulan}/{tahun}', 'TugasBulananController@delete');
            Route::get('listtugas', 'TugasBulananController@listTugas');
            Route::get('listtugasbulanan', 'TugasBulananController@listTugasbulanan');
            Route::get('listtugasbulananmhs/{id}', 'TugasBulananController@listTugasbulananmhs')->name('gettugas');
        });

        Route::group(['prefix' => 'absensholat'], function () {
            Route::get('/', 'AbsenSholatController@index');
            Route::get('data', 'AbsenSholatController@ajaxTable');
            Route::post('input', 'AbsenSholatController@input')->name('absen');
            Route::post('printabsen', 'AbsenSholatController@print')->name('printabsen');
            Route::get('cari', 'AbsenSholatController@search')->name('found');
        });

        Route::group(['prefix' => 'checkin'], function(){
            Route::get('/','CheckinController@index');
            Route::get('/mahasiswa/{id}','CheckinController@choice')->name('kamar');
            Route::post('/input/{id}','CheckinController@input')->name('masuk');
            Route::get('/check/{id}','CheckinController@indexmhs')->name('check');
            Route::get('/unduh/{id}/{mhs}','CheckinController@unduh')->name('unduh');
        });

        Route::group(['prefix' => 'postingan'], function(){
            Route::get('/','PostinganController@index');
            Route::get('data', 'PostinganController@ajaxTable');
            Route::post('input', 'PostinganController@input');
            Route::post('edit/{id}', 'PostinganController@edit');
            Route::post('delete/{id}', 'PostinganController@delete');
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
            Route::get('kamar', 'MahasiswaController@kamar');
            Route::post('inputperjanjian/{id}', 'MahasiswaController@inputsurat')->name('suratperjanjian');
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

        Route::group(['prefix' => 'checkout'], function(){
            Route::get('/tagihan','CheckoutController@tagihan')->name('tagihanmahasiswa');
            Route::get('/denda','CheckoutController@denda')->name('dendamahasiswa');
            Route::get('/tugas','CheckoutController@tugas')->name('tugasmahasiswa');
        });

        Route::group(['prefix' => 'postinganpembina'], function(){
            Route::get('/','PostinganController@pengumuman')->name('pengumuman');
        });



        Route::group(['prefix' => 'surat'], function(){
            Route::get('/','DataController@surat');

            Route::get('/download',function (){
                $file = public_path()."\storage\bebas_asrama.pdf";
                $name = "Surat Bebas Asrama.pdf";
                $headers = array('Content-type : application/pdf');
                return Response()->download($file, $name, $headers);
            })->name('download');

            Route::get('/downloads',function (){
                $file = public_path()."\storage\perjanjian_asrama.pdf";
                $name = "Surat Perjanjian Asrama.pdf";
                $headers = array('Content-type : application/pdf');
                return Response()->download($file, $name, $headers);
            })->name('downloads');
        });
    });
});
