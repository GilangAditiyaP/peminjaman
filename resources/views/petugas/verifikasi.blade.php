<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Verifikasi Peminjaman</title>
</head>

<body
    style="font-family:Arial,sans-serif;max-width:1100px;margin:35px auto;padding:20px;background:#eef5fb;color:#142238">
    <h1>VERIFIKASI PEMINJAMAN</h1>
    <p>Stok hanya dikurangi setelah permintaan disetujui.</p>
    @if(session('success'))
    <p style="color:green">{{ session('success') }}</p>@endif @if(session('error'))
    <p style="color:#b91c1c">{{ session('error') }}</p>@endif
    @if($errors->any())
    <p style="color:#b91c1c">{{ $errors->first() }}</p>@endif
    <h2>Menunggu Verifikasi</h2>
    <table width="100%" border="1" cellpadding="9" style="border-collapse:collapse;background:white">
        <thead>
            <tr>
                <th>Peminjam</th>
                <th>Barang</th>
                <th>Jumlah</th>
                <th>Tanggal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($peminjaman as $item)
                <tr>
                    <td>{{ $item->nama_peminjam }}</td>
                    <td>{{ $item->barang->nama_barang ?? '-' }}</td>
                    <td>{{ $item->jumlah }}</td>
                    <td>{{ $item->tanggal_pinjam }}</td>
                    <td style="white-space:nowrap">
                        <form method="POST" action="{{ route('petugas.verifikasi.setujui', $item->id) }}"
                            style="display:inline">@csrf<button
                                style="padding:7px;background:#15803d;color:white;border:0">Setujui</button></form>
                        <form method="POST" action="{{ route('petugas.verifikasi.tolak', $item->id) }}"
                            style="display:inline">@csrf<button
                                style="padding:7px;background:#b91c1c;color:white;border:0">Tolak</button></form>
                    </td>
            </tr>@empty<tr>
                <td colspan="5">Tidak ada permintaan yang menunggu.</td>
            </tr>@endforelse
        </tbody>
    </table>
    <h2 style="margin-top:32px">Riwayat Terbaru</h2>
    <table width="100%" border="1" cellpadding="9" style="border-collapse:collapse;background:white">
        <tr>
            <th>Peminjam</th>
            <th>Barang</th>
            <th>Jumlah</th>
            <th>Status</th>
        </tr>@forelse($riwayat as $item)
            <tr>
                <td>{{ $item->nama_peminjam }}</td>
                <td>{{ $item->barang->nama_barang ?? '-' }}</td>
                <td>{{ $item->jumlah }}</td>
                <td>{{ strtoupper($item->status_verifikasi) }}</td>
        </tr>@empty<tr>
            <td colspan="4">Belum ada riwayat.</td>
        </tr>@endforelse
    </table>
    <p><a href="{{ route('petugas.dashboard') }}">Kembali ke dashboard petugas</a></p>
</body>

</html>