@extends('layout.persona')
@section('title', 'Dashboard Peminjam')
@section('content')
    <div style="position:fixed;left:24px;bottom:24px;z-index:9999;color:white;text-shadow:0 2px 8px #000;max-width:420px">
        <h1 style="font-size:1.6rem;font-weight:bold">DASHBOARD PEMINJAM</h1>
        <p>Selamat datang, {{ auth()->user()->name }}.</p>
        <p>Pilih menu PINJAM untuk mengajukan barang. 
            Permintaan harus disetujui petugas sebelum stok berkurang.</p>
        <a href="{{ route('peminjam.peminjaman.menunggu') }}" style="color:#7de6fd;text-decoration:underline">Lihat status
            permintaan</a>
    </div>
@endsection