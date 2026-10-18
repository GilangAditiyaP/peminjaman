<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Denda</title>
    <style>
        *{box-sizing:border-box}body{margin:0;background:#f4f6f8;color:#202833;font:15px Arial,sans-serif}.wrap{max-width:1050px;margin:32px auto;padding:0 18px}header{display:flex;justify-content:space-between;align-items:center;gap:12px;flex-wrap:wrap;margin-bottom:22px}h1{font-size:26px;margin:0 0 6px}h2{font-size:18px;margin:0 0 12px}p{line-height:1.5;color:#65707d}.btn{display:inline-block;padding:10px 14px;border:1px solid #c9d0d8;border-radius:4px;text-decoration:none;color:#202833;background:#fff}.panel{background:#fff;border:1px solid #dce1e6;border-radius:5px;padding:18px;margin-bottom:14px}.details{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:8px 20px}.details p{margin:3px 0}.field{margin:14px 0}.field label{display:block;font-weight:700;margin-bottom:6px}.field input,.field textarea{width:100%;padding:10px;border:1px solid #c9d0d8;border-radius:4px;font:inherit}.field textarea{min-height:75px;resize:vertical}.submit{padding:10px 15px;background:#233b59;color:white;border:0;border-radius:4px;font:inherit;cursor:pointer}.notice{background:#e9f6ec;border:1px solid #bfdfc6;padding:12px;margin-bottom:16px}.error{background:#fff0f0;border:1px solid #e7bcbc;padding:12px;margin-bottom:16px}.status{display:inline-block;padding:5px 8px;background:#fff1d6;color:#7a4b00;border-radius:3px;font-size:13px}.amount{font-size:20px;font-weight:700;color:#a12d2d}.empty{background:#fff;border:1px solid #dce1e6;padding:24px;color:#65707d}@media(max-width:600px){.details{grid-template-columns:1fr}.wrap{margin:20px auto}}
    </style>
</head>
<body>
<main class="wrap">
    <header>
        <div><h1>KELOLA DENDA</h1><p>Tetapkan nominal dan keterangan denda untuk barang yang rusak atau hilang.</p></div>
        <a class="btn" href="{{ route('petugas.dashboard') }}">Kembali ke Dashboard</a>
    </header>

    @if(session('success'))<div class="notice">{{ session('success') }}</div>@endif
    @if(session('error'))<div class="error">{{ session('error') }}</div>@endif
    @if($errors->any())<div class="error">Periksa kembali input denda. Nominal harus lebih dari Rp0 dan keterangan wajib diisi.</div>@endif

    @forelse($denda as $item)
        <section class="panel">
            <h2>{{ $item->barang->nama_barang ?? 'Barang dihapus' }}</h2>
            <div class="details">
                <p><strong>Peminjam:</strong> {{ $item->nama_peminjam }}</p>
                <p><strong>Jumlah:</strong> {{ $item->jumlah }}</p>
                <p><strong>Kondisi:</strong> {{ $item->kondisi }}</p>
                <p><strong>Tanggal kembali:</strong> {{ $item->tanggal_dikembalikan ?? '-' }}</p>
            </div>
            <hr style="border:0;border-top:1px solid #e4e7eb;margin:16px 0">
            @if(is_null($item->denda))
                <span class="status">Belum ditetapkan</span>
            @else
                <p><strong>Denda saat ini:</strong> <span class="amount">Rp{{ number_format($item->denda, 0, ',', '.') }}</span></p>
                <p><strong>Keterangan:</strong> {{ $item->catatan_denda }}</p>
            @endif
            <form method="POST" action="{{ route('petugas.denda.tetapkan', $item->id) }}">
                @csrf
                <div class="field">
                    <label for="denda_{{ $item->id }}">Nominal denda (Rupiah)</label>
                    <input id="denda_{{ $item->id }}" type="number" name="denda" min="1" max="1000000000" step="1" required value="{{ old('denda', $item->denda) }}" placeholder="Contoh: 50000">
                </div>
                <div class="field">
                    <label for="catatan_{{ $item->id }}">Keterangan / alasan denda</label>
                    <textarea id="catatan_{{ $item->id }}" name="catatan_denda" required maxlength="1000" placeholder="Jelaskan kerusakan atau alasan nominal denda">{{ old('catatan_denda', $item->catatan_denda) }}</textarea>
                </div>
                <button class="submit" type="submit">Simpan Denda</button>
            </form>
        </section>
    @empty
        <div class="empty">Belum ada pengembalian dengan kondisi rusak atau hilang.</div>
    @endforelse
</main>
</body>
</html>
