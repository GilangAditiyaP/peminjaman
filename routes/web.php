<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\KembalikanController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [LoginController::class, 'login']);
Route::get('/register', [LoginController::class, 'register']);
Route::post('/register/store', [LoginController::class, 'store']);
Route::get('/barang', [BarangController::class, 'index']);
Route::get('/pinjam/{id}', [PeminjamanController::class, 'create']);
Route::post('/peminjaman', [PeminjamanController::class, 'store']);
Route::get('/kembalikan', [KembalikanController::class, 'balikin']);
Route::post('/kembalikan/{id}', [KembalikanController::class, 'proses']);