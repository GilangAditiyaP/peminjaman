<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kelola Barang</title>
</head>

<body
    style="font-family:Arial,sans-serif;max-width:1100px;margin:35px auto;padding:20px;background:#eef5fb;color:#142238">
    <h1>KELOLA BARANG</h1>@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>@endif @if(session('error'))
    <p style="color:#b91c1c">{{ session('error') }}</p>@endif
    <p><a href="{{ route('petugas.barang.create') }}">+ TAMBAH BARANG</a> | <a
            href="{{ route('petugas.dashboard') }}">Dashboard Petugas</a></p>
    <table width="100%" border="1" cellpadding="9" style="border-collapse:collapse;background:white">
        <tr>
            <th>Nama</th>
            <th>Stok</th>
            <th>Kondisi</th>
            <th>Lokasi</th>
            <th>Aksi</th>
        </tr>
        @forelse($barang as $item)
            <tr>
                <td>{{ $item->nama_barang }}</td>
                <td>{{ $item->stock_barang }}</td>
                <td>{{ $item->kondisi_barang }}</td>
                <td>{{ $item->lokasi_barang }}</td>
                <td><a href="{{ route('petugas.barang.edit', $item->id) }}">Edit</a>
                    <form method="POST" action="{{ route('petugas.barang.destroy', $item->id) }}" style="display:inline"
                        onsubmit="return confirm('Hapus barang ini?')">@csrf @method('DELETE')<button
                            type="submit">Hapus</button></form>
                </td>
        </tr>@empty<tr>
            <td colspan="5">Belum ada barang.</td>
        </tr>@endforelse
    </table>
</body>

</html>