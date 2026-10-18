<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use Illuminate\Http\Request;

class DendaController extends Controller
{
    public function peminjam()
    {
        $denda = Peminjaman::with('barang')
            ->where('user_id', auth()->id())
            ->whereIn('kondisi', ['Rusak', 'Hilang'])
            ->where('status_dipinjam', false)
            ->latest('tanggal_dikembalikan')
            ->get();

        return view('peminjam.denda', compact('denda'));
    }

    public function petugas()
    {
        $denda = Peminjaman::with(['barang'])
            ->whereIn('kondisi', ['Rusak', 'Hilang'])
            ->where('status_dipinjam', false)
            ->latest('tanggal_dikembalikan')
            ->get();

        return view('petugas.denda', compact('denda'));
    }

    public function tetapkan(Request $request, $id)
    {
        $data = $request->validate([
            'denda' => 'required|integer|min:1|max:1000000000',
            'catatan_denda' => 'required|string|max:1000',
        ]);

        $pinjaman = Peminjaman::whereKey($id)
            ->where('status_dipinjam', false)
            ->whereIn('kondisi', ['Rusak', 'Hilang'])
            ->firstOrFail();

        $pinjaman->update($data);

        return back()->with('success', 'Denda berhasil ditetapkan. Peminjam dapat melihat nominal dan keterangannya di menu CEK DENDA.');
    }
}
