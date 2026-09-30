<?php

namespace App\Http\Controllers;

use App\Models\Barang;

class BarangController extends Controller
{
    public function index()
    {
        $barang = Barang::all();
        return view('index', compact('barang'));
    }
}