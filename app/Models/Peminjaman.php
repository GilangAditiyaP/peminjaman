<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    protected $table = 'peminjaman';

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }

    protected $fillable = [
        'nama_peminjam',
        'user_id',
        'barang_id',
        'jumlah',
        'tanggal_pinjam',
        'tanggal_dikembalikan',
        'status_dipinjam',
        'status_verifikasi',
        'denda',
        'catatan_denda',
    ];
}
