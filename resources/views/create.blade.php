<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Form Peminjaman</title>
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
            max-width: 680px;
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

        .panel {
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 22px
        }

        .detail {
            padding: 12px;
            background: #f6f7f8;
            border: 1px solid #e2e2e2;
            margin: 18px 0
        }

        .detail p {
            margin: 6px 0
        }

        .field {
            margin-bottom: 15px
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 7px
        }

        input {
            width: 100%;
            padding: 10px;
            border: 1px solid #bbb;
            border-radius: 3px;
            font: inherit
        }

        input[readonly] {
            background: #f3f3f3
        }

        .hint {
            font-size: 13px;
            color: #666;
            margin-top: 5px
        }

        .actions {
            display: flex;
            gap: 8px;
            margin-top: 20px
        }

        .btn {
            display: inline-block;
            padding: 10px 14px;
            border: 1px solid #ccc;
            border-radius: 4px;
            background: #fff;
            color: #222;
            text-decoration: none;
            font: inherit;
            cursor: pointer
        }

        .primary {
            background: #2563a6;
            color: #fff;
            border-color: #2563a6
        }

        .notice {
            padding: 11px 13px;
            background: #edf4fc;
            border: 1px solid #cbdcf0;
            margin: 15px 0
        }

        @media(max-width:500px) {
            .panel {
                padding: 16px
            }

            .actions {
                flex-wrap: wrap
            }
        }
    </style>
</head>

<body>
    <main class="wrap"><a href="{{ route('barang.index') }}" class="btn">&larr; Kembali</a>
        <div style="margin:22px 0">
            <h1>Form Peminjaman Barang</h1>
            <p>Isi data berikut untuk mengajukan peminjaman.</p>
        </div>
        <section class="panel">
            @if(session('success'))
            <div class="notice">{{ session('success') }}</div>@endif
            <div class="detail"><strong>Detail barang</strong>
                <p>Nama barang: {{ $barang->nama_barang }}</p>
                <p>Lokasi: {{ $barang->lokasi_barang ?: '-' }}</p>
                <p>Stok tersedia: {{ $barang->stock_barang }}</p>
            </div>
            <form action="{{ route('peminjaman.store') }}" method="POST">@csrf
                <div class="field"><label for="nama_peminjam">Nama Peminjam</label><input id="nama_peminjam" type="text"
                        name="nama_peminjam" value="{{ old('nama_peminjam', auth()->user()->name ?? '') }}" required
                        readonly>@error('nama_peminjam')
                        <div class="hint">{{ $message }}</div>@enderror
                </div>
                <input type="hidden" name="barang_id" value="{{ $barang->id }}">
                <div class="field"><label for="jumlah">Jumlah Barang</label><input id="jumlah" type="number"
                        name="jumlah" min="1" max="{{ $barang->stock_barang }}" value="{{ old('jumlah', 1) }}"
                        required>@error('jumlah')
                        <div class="hint">{{ $message }}</div>@enderror
                </div>
                <div class="field"><label for="tanggal_pinjam">Tanggal Pinjam</label><input id="tanggal_pinjam"
                        type="date" name="tanggal_pinjam" min="{{ date('Y-m-d') }}"
                        value="{{ old('tanggal_pinjam', date('Y-m-d')) }}" required>@error('tanggal_pinjam')
                        <div class="hint">{{ $message }}</div>@enderror
                </div>
                <div class="notice">Setelah mengirim formulir, silakan konfirmasi pengajuan kepada petugas. Barang belum
                    dipinjam sebelum disetujui.</div>
                <div class="actions"><button class="btn primary" type="submit">Kirim Pengajuan</button><a class="btn"
                        href="{{ route('barang.index') }}">Batal</a></div>
            </form>
        </section>
    </main>
</body>

</html>