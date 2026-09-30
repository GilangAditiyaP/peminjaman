<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Barang;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         Barang::create([
            'nama_barang' => 'Laptop',
            'stock_barang' => 5,
            'kondisi_barang' => 'baik',
            'lokasi_barang' => 'di ruang guru'
        ]);

        Barang::create([
            'nama_barang' => 'Proyektor',
            'stock_barang' => 2,
            'kondisi_barang' => 'baik',
            'lokasi_barang' => 'di ruang guru'
        ]);

        Barang::create([
            'nama_barang' => 'Kamera',
            'stock_barang' => 3,
            'kondisi_barang' => 'rusak ringan',
            'lokasi_barang' => 'di ruang guru'
        ]);
    
    }
}
