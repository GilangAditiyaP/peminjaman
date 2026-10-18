<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pengembalian Barang</title>
    <style>
        * {
            box-sizing: border-box
        }

        body {
            margin: 0;
            background: #f5f6f8;
            color: #222;
            font: 15px Arial, sans-serif
        }

        .wrap {
            max-width: 950px;
            margin: 32px auto;
            padding: 0 18px
        }

        h1 {
            font-size: 25px;
            margin: 0 0 7px
        }

        p {
            color: #666;
            line-height: 1.5
        }

        .top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
            margin-bottom: 22px
        }

        .btn {
            display: inline-block;
            padding: 9px 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            text-decoration: none;
            color: #222;
            background: #fff;
            font: inherit;
            cursor: pointer
        }

        .primary {
            background: #2563a6;
            color: #fff;
            border-color: #2563a6
        }

        .panel {
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 18px;
            margin-bottom: 14px
        }

        .row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px
        }

        .info {
            margin: 6px 0;
            color: #555
        }

        .field {
            margin: 14px 0
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 7px
        }

        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #bbb;
            border-radius: 3px;
            background: white;
            font: inherit
        }

        .actions {
            margin-top: 14px
        }

        .notice {
            padding: 11px 13px;
            background: #edf4fc;
            border: 1px solid #cbdcf0;
            margin: 15px 0
        }

        .empty {
            padding: 22px;
            background: #fff;
            border: 1px solid #ddd;
            color: #666
        }

        @media(max-width:580px) {
            .row {
                grid-template-columns: 1fr
            }

            .panel {
                padding: 15px
            }
        }
    </style>
</head>

<body>
    <main class="wrap">
        <header class="top">
            <div>
                <h1>Pengembalian Barang</h1>
                <p>Daftar barang yang sedang dipinjam dan dapat dikembalikan.</p>
            </div><a href="{{ route('barang.index') }}" class="btn">Kembali ke Data Barang</a>
        </header>
        @if(session('success'))
        <div class="notice">{{ session('success') }}</div>@endif @if(session('error'))
        <div class="notice">{{ session('error') }}</div>@endif
        @forelse($peminjaman as $item)
            <section class="panel">
                <div class="row">
                    <div><strong>{{ $item->barang->nama_barang ?? 'Barang tidak ditemukan' }}</strong>
                        <p class="info">Nama peminjam: {{ $item->nama_peminjam }}</p>
                        <p class="info">Jumlah: {{ $item->jumlah }}</p>
                    </div>
                    <div>
                        <p class="info">Tanggal pinjam: {{ $item->tanggal_pinjam }}</p>
                        <p class="info">ID Peminjaman: {{ $item->id }}</p>
                    </div>
                </div>
                <form action="{{ route('kembalikan.proses', $item->id) }}" method="POST"
                    onsubmit="return confirm('Proses pengembalian barang ini?')">@csrf
                    <div class="field"><label for="kondisi_{{ $item->id }}">Kondisi Barang</label><select
                            id="kondisi_{{ $item->id }}" name="kondisi" required>
                            <option value="">-- Pilih kondisi --</option>
                            <option value="Baik">Baik</option>
                            <option value="Rusak">Rusak</option>
                            <option value="Hilang">Hilang</option>
                        </select></div><button type="submit" class="btn primary">Kembalikan Barang</button>
                </form>
            </section>
        @empty<div class="empty">Tidak ada barang yang sedang dipinjam dan perlu dikembalikan.</div>@endforelse
    </main>
</body>

</html>