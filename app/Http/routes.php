<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
// Testing
Route::get('/test', 'Test@index');
// Restful API
Route::post('api/masuk', 'MasukController@cek_akun');
// Jika Session False
Route::group(['middleware' => 'sessionFalse'], function () {
  Route::resource('/', 'BerandaController');
  Route::resource('/admin', 'AdminController');
  Route::resource('/simpanan', 'SimpananController');
  Route::resource('/pinjaman', 'PinjamanController');
  Route::resource('/jenis_simpanan', 'MasterSimpananController');
  Route::resource('/angsuran', 'AngsuranController');
  Route::resource('/anggota', 'AnggotaController');
  Route::resource('/laporan', 'LaporanController');
  Route::get('/keluar', 'MasukController@keluar');
});
// Jika Session True
Route::group(['middleware' => 'sessionTrue'], function () {
  Route::get('/masuk', function () {
    return view('pages.masuk');
  });
});
