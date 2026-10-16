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
        $validated = $request->validate([
            'nama_peminjam' => 'required|string|max:255',
            'barang_id' => 'required|exists:barang,id',
            'jumlah' => 'required|integer|min:1',
            'tanggal_pinjam' => 'required|date|after_or_equal:today',
        ]);

        $barang = Barang::findOrFail($validated['barang_id']);
        if ($validated['jumlah'] > $barang->stock_barang) {
            return back()->withInput()->with('error', 'Stok barang tidak cukup.');
        }

        Peminjaman::create([
            'nama_peminjam' => auth()->user()->name,
            'user_id' => auth()->id(),
            'barang_id' => $barang->id,
            'jumlah' => $validated['jumlah'],
            'tanggal_pinjam' => $validated['tanggal_pinjam'],
            'status_dipinjam' => false,
            'status_verifikasi' => 'menunggu',
        ]);

        return redirect()->route('peminjam.peminjaman.menunggu')->with('success', 'Permintaan peminjaman dikirim.');
    }

    public function menunggu()
    {
        $peminjaman = Peminjaman::with('barang')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('peminjaman.menunggu', compact('peminjaman'));
    }
}
