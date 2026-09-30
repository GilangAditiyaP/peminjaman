<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function create($id)
    {
        $barang = Barang::findOrFail($id);

        return view('create', compact('barang'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_peminjam' => 'required',
            'jumlah' => 'required|integer|min:1',
            'tanggal_pinjam' => 'required|date',
        ]);

        $barang = Barang::findOrFail($request->barang_id);

        if ($request->jumlah > $barang->stock_barang) {
            return back()->with('error', 'Stok barang tidak cukup!');
        }

        Peminjaman::create([
            'nama_peminjam' => $request->nama_peminjam,
            'barang_id' => $request->barang_id,
            'jumlah' => $request->jumlah,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'status_dipinjam' => true,
        ]);

        $barang->stock_barang -= $request->jumlah;
        $barang->save();

        return redirect('/barang');
    }
}