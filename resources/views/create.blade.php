<!DOCTYPE html>
<html lang="id"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title>Ajukan Peminjaman</title></head>
<body style="font-family:Arial,sans-serif;max-width:700px;margin:40px auto;padding:20px;background:#f3f7fb;color:#172033">
<h1>Ajukan Peminjaman Barang</h1>
@if(session('error'))<p style="color:#b91c1c">{{ session('error') }}</p>@endif
@if($errors->any())<ul style="color:#b91c1c">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>@endif
<table style="border-collapse:collapse;width:100%;background:white" border="1" cellpadding="10">
<tr><th align="left">Nama Barang</th><td>{{ $barang->nama_barang }}</td></tr><tr><th align="left">Stok tersedia</th><td>{{ $barang->stock_barang }}</td></tr><tr><th align="left">Kondisi</th><td>{{ $barang->kondisi_barang }}</td></tr><tr><th align="left">Lokasi</th><td>{{ $barang->lokasi_barang }}</td></tr></table>
<form action="{{ route('peminjaman.store') }}" method="POST" style="display:grid;gap:12px;margin-top:20px">@csrf
<input type="hidden" name="barang_id" value="{{ $barang->id }}">
<label>Nama Peminjam<input required name="nama_peminjam" value="{{ old('nama_peminjam', auth()->user()->name) }}" style="display:block;padding:10px;width:95%"></label>
<label>Jumlah<input required type="number" name="jumlah" min="1" max="{{ $barang->stock_barang }}" value="{{ old('jumlah', 1) }}" style="display:block;padding:10px;width:95%"></label>
<label>Tanggal Pinjam<input required type="date" name="tanggal_pinjam" min="{{ now()->toDateString() }}" value="{{ old('tanggal_pinjam', now()->toDateString()) }}" style="display:block;padding:10px;width:95%"></label>
<p style="background:#fff7d6;padding:12px;border-left:4px solid #eab308">Setelah menekan Ajukan, permintaan akan berstatus <b>Menunggu Verifikasi</b>. Stok belum berkurang sampai petugas menyetujuinya.</p>
<button type="submit" style="padding:12px;background:#123c64;color:white;border:0;cursor:pointer">AJUKAN PEMINJAMAN</button>
<a href="{{ route('barang.index') }}">Kembali ke daftar barang</a></form></body></html>
