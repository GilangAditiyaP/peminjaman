@extends('layout.persona')
@section('title', 'Dashboard Petugas')
@section('content')
    <div style="position:fixed;left:24px;bottom:24px;z-index:9999;color:white;text-shadow:0 2px 8px #000;max-width:430px">
        <h1 style="font-size:1.6rem;font-weight:bold">DASHBOARD PETUGAS</h1>
        <p>Selamat datang, {{ auth()->user()->name }}.</p>
        <p>Pilih VERIFIKASI untuk menyetujui/menolak permintaan atau KELOLA BARANG untuk menambah, mengubah, dan menghapus
            data barang.</p>
    </div>
@endsection