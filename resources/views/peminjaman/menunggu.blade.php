<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Status Peminjaman</title>
</head>

<body
    style="font-family:Arial,sans-serif;max-width:900px;margin:40px auto;padding:20px;background:#eef5fb;color:#142238">
    <h1>STATUS PEMINJAMAN</h1>
    <div style="padding:18px;background:#fff7d6;border-left:5px solid #eab308;margin-bottom:24px"><b>Silakan verifikasi
            ke petugas.</b><br>Permintaan kamu sudah masuk. Barang baru dianggap dipinjam setelah petugas menyetujuinya.
    </div>
    @if(session('success'))
    <p>{{ session('success') }}</p>@endif
    <table width="100%" border="1" cellpadding="10" style="border-collapse:collapse;background:white">
        <thead>
            <tr>
                <th>Barang</th>
                <th>Jumlah</th>
                <th>Tanggal</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($peminjaman as $item)
                <tr>
                    <td>{{ $item->barang->nama_barang ?? 'Barang dihapus' }}</td>
                    <td>{{ $item->jumlah }}</td>
                    <td>{{ $item->tanggal_pinjam }}</td>
                    <td><b>{{ strtoupper($item->status_verifikasi) }}</b></td>
            </tr>@empty<tr>
                <td colspan="4">Belum ada permintaan peminjaman.</td>
            </tr>@endforelse
        </tbody>
    </table>
    <p><a href="{{ route('peminjam.dashboard') }}">Dashboard</a> | <a href="{{ route('barang.index') }}">Daftar
            Barang</a></p>
</body>

</html>