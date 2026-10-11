<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Barang;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class KembalikanController extends Controller
{
    public function balikin(Request $request)
{
    $query = Peminjaman::where('status_dipinjam', true);

    if ($request->filled('barang_id')) {
        $query->where('barang_id', $request->barang_id);
    }

    $peminjaman = $query->get();

    return view('balikin', compact('peminjaman'));
}

        public function proses(Request $request, $id)
{
            $request->validate([
        'kondisi' => 'required|in:Baik,Rusak,Hilang',
        ]);

    DB::transaction(function () use ($request, $id) {

        $peminjaman = Peminjaman::where('id', $id)
            ->lockForUpdate()
            ->firstOrFail();

        // Cegah pengembalian transaksi yang sudah selesai
        if (!$peminjaman->status_dipinjam) {
            abort(403, 'Peminjaman ini sudah dikembalikan.');
        }

        $barang = Barang::findOrFail(
            $peminjaman->barang_id
        );

        // Stok bertambah jika barang tidak hilang
        if ($request->kondisi !== 'Hilang') {
            $barang->increment(
                'stock_barang',
                $peminjaman->jumlah
            );
        }

        $peminjaman->kondisi = $request->kondisi;
        $peminjaman->status_dipinjam = false;
        $peminjaman->tanggal_dikembalikan = now();
        $peminjaman->save();
    });

    return redirect('/barang')
        ->with('success', 'Pengembalian berhasil diproses!');
}

}
