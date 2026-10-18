<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cek Denda</title>
    <style>
        *{box-sizing:border-box}body{margin:0;background:#f4f6f8;color:#202833;font:15px Arial,sans-serif}.wrap{max-width:1000px;margin:32px auto;padding:0 18px}header{display:flex;justify-content:space-between;align-items:center;gap:12px;flex-wrap:wrap;margin-bottom:22px}h1{font-size:26px;margin:0 0 6px}p{line-height:1.5;color:#65707d}.btn{display:inline-block;padding:10px 14px;border:1px solid #c9d0d8;border-radius:4px;text-decoration:none;color:#202833;background:#fff}.panel{background:#fff;border:1px solid #dce1e6;border-radius:5px;padding:18px;margin-bottom:14px}.panel h2{font-size:18px;margin:0 0 12px}.details{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:8px 20px}.details p{margin:3px 0}.amount{font-size:21px;font-weight:700;color:#a12d2d}.status{display:inline-block;padding:5px 8px;background:#fff1d6;color:#7a4b00;border-radius:3px;font-size:13px}.notice{background:#e9f6ec;border:1px solid #bfdfc6;padding:12px;margin-bottom:16px}.empty{background:#fff;border:1px solid #dce1e6;padding:24px;color:#65707d}.note{white-space:pre-wrap}@media(max-width:600px){.details{grid-template-columns:1fr}.wrap{margin:20px auto}}
    </style>
</head>
<body>
<main class="wrap">
    <header>
        <div><h1>CEK DENDA</h1><p>Daftar denda untuk barang yang dikembalikan dalam kondisi rusak atau hilang.</p></div>
        <a class="btn" href="{{ route('peminjam.dashboard') }}">Kembali ke Dashboard</a>
    </header>

    @if(session('success'))<div class="notice">{{ session('success') }}</div>@endif

    @forelse($denda as $item)
        <section class="panel">
            <h2>{{ $item->barang->nama_barang ?? 'Barang dihapus' }}</h2>
            <div class="details">
                <p><strong>Jumlah:</strong> {{ $item->jumlah }}</p>
                <p><strong>Kondisi saat dikembalikan:</strong> {{ $item->kondisi }}</p>
                <p><strong>Tanggal pinjam:</strong> {{ $item->tanggal_pinjam }}</p>
                <p><strong>Tanggal kembali:</strong> {{ $item->tanggal_dikembalikan ?? '-' }}</p>
            </div>
            <hr style="border:0;border-top:1px solid #e4e7eb;margin:16px 0">
            @if(is_null($item->denda))
                <span class="status">Denda belum ditentukan petugas</span>
            @else
                <p style="margin:0 0 5px">Nominal denda</p>
                <div class="amount">Rp{{ number_format($item->denda, 0, ',', '.') }}</div>
                <p><strong>Keterangan petugas:</strong></p>
                <p class="note">{{ $item->catatan_denda ?: 'Tidak ada keterangan.' }}</p>
            @endif
        </section>
    @empty
        <div class="empty">Belum ada denda yang tercatat. Jika barang dikembalikan dalam kondisi rusak atau hilang, informasi akan muncul di sini setelah diproses.</div>
    @endforelse
</main>
</body>
</html>
