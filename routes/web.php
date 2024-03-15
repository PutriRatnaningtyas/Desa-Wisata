<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', function() {
    return view('home');
})->name('home')->middleware('auth');

Route::resource('users', \App\Http\Controllers\UserController::class)->middleware('auth');

Route::resource('katber', \App\Http\Controllers\Kategori_BeritaController::class)->middleware('auth');

Route::resource('berita', \App\Http\Controllers\BeritaController::class)->middleware('auth');

Route::resource('katwis', \App\Http\Controllers\Kategori_WisataController::class)->middleware('auth');

Route::resource('obwis', \App\Http\Controllers\Obyek_WisataController::class)->middleware('auth');

Route::resource('karyawan', \App\Http\Controllers\KaryawanController::class)->middleware('auth');

Route::resource('pelanggan', \App\Http\Controllers\PelangganController::class)->middleware('auth');

Route::resource('penginapan', \App\Http\Controllers\PenginapanController::class)->middleware('auth');

Route::resource('paket_wisata', \App\Http\Controllers\Paket_WisataController::class)->middleware('auth');

Route::resource('reservasi', \App\Http\Controllers\ReservasiController::class)->middleware('auth');

Route::resource('reservasibendahara', \App\Http\Controllers\ReservasiBendahara::class)->middleware('auth');

Route::get('/search', [App\Http\Controllers\LaporanController::class, 'search'])->name('search');
Route::get('/generateLaporan', [App\Http\Controllers\LaporanController::class, 'downloadpdf']);

Route::resource('laporan', \App\Http\Controllers\LaporanController::class)->middleware('auth');
