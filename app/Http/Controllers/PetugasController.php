<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PetugasController extends Controller
{
    public function verifikasi()
    {
        $peminjaman = Peminjaman::with('barang')->where('status_verifikasi', 'menunggu')->latest()->get();
        $riwayat = Peminjaman::with('barang')->whereIn('status_verifikasi', ['disetujui', 'ditolak'])->latest()->take(20)->get();
        return view('petugas.verifikasi', compact('peminjaman', 'riwayat'));
    }

    public function setujui($id)
    {
        DB::transaction(function () use ($id) {
            $pinjaman = Peminjaman::whereKey($id)->lockForUpdate()->firstOrFail();
            if ($pinjaman->status_verifikasi !== 'menunggu') {
                abort(422, 'Permintaan ini sudah diproses.');
            }

            $barang = Barang::whereKey($pinjaman->barang_id)->lockForUpdate()->firstOrFail();
            if ($pinjaman->jumlah > $barang->stock_barang) {
                abort(422, 'Stok tidak cukup untuk menyetujui permintaan ini.');
            }

            $barang->decrement('stock_barang', $pinjaman->jumlah);
            $pinjaman->status_verifikasi = 'disetujui';
            $pinjaman->status_dipinjam = true;
            $pinjaman->save();
        });

        return back()->with('success', 'Peminjaman disetujui dan stok telah diperbarui.');
    }

    public function tolak($id)
    {
        $pinjaman = Peminjaman::whereKey($id)->firstOrFail();
        if ($pinjaman->status_verifikasi !== 'menunggu') {
            return back()->with('error', 'Permintaan ini sudah diproses.');
        }
        $pinjaman->update(['status_verifikasi' => 'ditolak', 'status_dipinjam' => false]);
        return back()->with('success', 'Permintaan peminjaman ditolak. Stok tidak berubah.');
    }

    public function barang()
    {
        $barang = Barang::orderBy('nama_barang')->get();
        return view('petugas.barang.index', compact('barang'));
    }

    public function createBarang()
    {
        return view('petugas.barang.form', ['barang' => new Barang(), 'aksi' => 'Tambah']);
    }

    public function storeBarang(Request $request)
    {
        $data = $this->validasiBarang($request);
        Barang::create($data);
        return redirect()->route('petugas.barang')->with('success', 'Barang berhasil ditambahkan.');
    }

    public function editBarang($id)
    {
        return view('petugas.barang.form', ['barang' => Barang::findOrFail($id), 'aksi' => 'Edit']);
    }

    public function updateBarang(Request $request, $id)
    {
        Barang::findOrFail($id)->update($this->validasiBarang($request));
        return redirect()->route('petugas.barang')->with('success', 'Data barang berhasil diperbarui.');
    }

    public function hapusBarang($id)
    {
        $barang = Barang::findOrFail($id);
        if (Peminjaman::where('barang_id', $id)->exists()) {
            return back()->with('error', 'Barang tidak bisa dihapus karena sudah memiliki riwayat peminjaman.');
        }
        $barang->delete();
        return back()->with('success', 'Barang berhasil dihapus.');
    }

    private function validasiBarang(Request $request): array
    {
        return $request->validate([
            'nama_barang' => 'required|string|max:255',
            'stock_barang' => 'required|integer|min:0',
            'kondisi_barang' => 'required|in:baik,rusak ringan,rusak berat',
            'lokasi_barang' => 'required|string|max:255',
        ]);
    }
}
