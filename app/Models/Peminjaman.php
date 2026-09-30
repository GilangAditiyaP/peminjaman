<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    protected $table = 'peminjaman';

    protected $fillable = [
        'nama_peminjam',
        'barang_id',
        'jumlah',
        'tanggal_pinjam',
        'tanggal_dikembalikan',
        'status_dipinjam',
    ];
}
