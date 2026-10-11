
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\KembalikanController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    if (auth()->user()->role === 'petugas') {
        return redirect()->route('petugas.dashboard');
    }

    return redirect()->route('peminjam.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Dashboard petugas
Route::middleware(['auth', 'role:petugas'])->prefix('petugas')->name('petugas.')->group(function () {
    Route::get('/dashboard', function () {
        return view('petugas.dashboard');
    })->name('dashboard');
});

// Dashboard dan fitur peminjam
Route::middleware(['auth', 'role:peminjam'])->prefix('peminjam')->name('peminjam.')->group(function () {
    Route::get('/dashboard', function () {
        return view('peminjam.dashboard');
    })->name('dashboard');
});

// Route barang, peminjaman, dan pengembalian
Route::middleware(['auth'])->group(function () {
    Route::get('/barang', [BarangController::class, 'index'])->name('barang.index');

    Route::get('/pinjam/{id}', [PeminjamanController::class, 'create'])->name('pinjam.create');

    Route::post('/peminjaman', [PeminjamanController::class, 'store'])->name('peminjaman.store');

    Route::get('/kembalikan', [KembalikanController::class, 'balikin'])->name('kembalikan.index');

    Route::post('/kembalikan/{id}', [KembalikanController::class, 'proses'])->name('kembalikan.proses');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
