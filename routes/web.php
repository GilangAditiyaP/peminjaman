
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\KembalikanController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\DendaController;

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
    Route::get('/verifikasi', [PetugasController::class, 'verifikasi'])->name('verifikasi');
    Route::post('/verifikasi/{id}/setujui', [PetugasController::class, 'setujui'])->name('verifikasi.setujui');
    Route::post('/verifikasi/{id}/tolak', [PetugasController::class, 'tolak'])->name('verifikasi.tolak');
    Route::get('/barang', [PetugasController::class, 'barang'])->name('barang');
    Route::get('/barang/tambah', [PetugasController::class, 'createBarang'])->name('barang.create');
    Route::post('/barang', [PetugasController::class, 'storeBarang'])->name('barang.store');
    Route::get('/barang/{id}/edit', [PetugasController::class, 'editBarang'])->name('barang.edit');
    Route::get('/denda', [DendaController::class, 'petugas'])->name('denda.index');
    Route::post('/denda/{id}', [DendaController::class, 'tetapkan'])->name('denda.tetapkan');
    Route::put('/barang/{id}', [PetugasController::class, 'updateBarang'])->name('barang.update');
    Route::delete('/barang/{id}', [PetugasController::class, 'hapusBarang'])->name('barang.destroy');
});

// Dashboard dan fitur peminjam
Route::middleware(['auth', 'role:peminjam'])->prefix('peminjam')->name('peminjam.')->group(function () {
    Route::get('/dashboard', function () {
        return view('peminjam.dashboard');
    })->name('dashboard');
    Route::get('/peminjaman/menunggu', [PeminjamanController::class, 'menunggu'])->name('peminjaman.menunggu');
    Route::get('/denda', [DendaController::class, 'peminjam'])->name('denda');
});

// Route barang, peminjaman, dan pengembalian
Route::middleware(['auth'])->group(function () {
    Route::get('/barang', [BarangController::class, 'index'])->name('barang.index');

    Route::middleware('role:peminjam')->group(function () {
        Route::get('/pinjam/{id}', [PeminjamanController::class, 'create'])->name('pinjam.create');
        Route::post('/peminjaman', [PeminjamanController::class, 'store'])->name('peminjaman.store');
    });

    Route::get('/kembalikan', [KembalikanController::class, 'balikin'])->name('kembalikan.index');

    Route::post('/kembalikan/{id}', [KembalikanController::class, 'proses'])->name('kembalikan.proses');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';