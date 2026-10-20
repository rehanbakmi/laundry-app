<?php

use App\Http\Controllers\LayananController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\TransaksiController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Tambahkan baris-baris ini ke routes/web.php project Laravel kamu
|--------------------------------------------------------------------------
*/
Route::redirect('/', '/transaksi');
Route::resource('pelanggan', PelangganController::class);
Route::resource('pegawai', PegawaiController::class);
Route::resource('layanan', LayananController::class);
Route::resource('transaksi', TransaksiController::class);
Route::resource('pembayaran', PembayaranController::class);
