<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;

class KembalikanController extends Controller
{
 public function balikin()
{
    $peminjaman = Peminjaman::where('status_dipinjam', true)->get();

    return view('balikin', compact('peminjaman'));
}

public function proses($id)
{
    $peminjaman = Peminjaman::find($id);

    $peminjaman->status_dipinjam = false;
    $peminjaman->tanggal_dikembalikan = now();

    $peminjaman->save();

    return redirect('/kembalikan');
}
}