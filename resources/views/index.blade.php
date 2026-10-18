<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Barang</title>
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
            max-width: 1050px;
            margin: 32px auto;
            padding: 0 18px
        }

        .top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
            margin-bottom: 22px
        }

        h1 {
            font-size: 26px;
            margin: 0 0 7px
        }

        p {
            color: #666;
            margin: 0
        }

        .actions {
            display: flex;
            gap: 8px;
            flex-wrap: wrap
        }

        .btn {
            display: inline-block;
            padding: 9px 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            text-decoration: none;
            color: #222;
            background: #fff;
            font-size: 14px;
            cursor: pointer
        }

        .primary {
            background: #2563a6;
            color: #fff;
            border-color: #2563a6
        }

        .message {
            padding: 11px 13px;
            background: #e7f5e9;
            border: 1px solid #c4e5c9;
            margin-bottom: 14px
        }

        .message.error {
            background: #fff0f0;
            border-color: #f0caca
        }

        .panel {
            background: white;
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 18px
        }

        .panel h2 {
            font-size: 18px;
            margin: 0 0 14px
        }

        table {
            width: 100%;
            border-collapse: collapse
        }

        th,
        td {
            text-align: left;
            padding: 11px 10px;
            border-bottom: 1px solid #e5e5e5
        }

        th {
            background: #f2f3f5;
            font-size: 14px
        }

        tr:last-child td {
            border-bottom: 0
        }

        .status {
            font-size: 13px;
            color: #555
        }

        .empty {
            padding: 20px;
            text-align: center;
            color: #666
        }

        @media(max-width:650px) {
            .panel {
                overflow-x: auto
            }

            table {
                min-width: 650px
            }

            .top {
                align-items: flex-start
            }
        }
    </style>
</head>

<body>
    <main class="wrap">
        <header class="top">
            <div>
                <h1>Data Barang</h1>
                <p>Daftar barang yang tersedia untuk dipinjam.</p>
            </div>
            <div class="actions"><a class="btn" href="{{ route('peminjam.peminjaman.menunggu') }}">Riwayat Pengajuan</a>
                    <a class="btn primary" href="{{ route('kembalikan.index') }}">Pengembalian Barang</a>
                    <a class="btn primary" href="{{ route('peminjam.dashboard') }}">Kembali ke Dashboard</a>
            </div>
        </header>
        @if(session('success'))
        <div class="message">{{ session('success') }}</div>@endif @if(session('error'))
        <div class="message error">{{ session('error') }}</div>@endif
        <section class="panel">
            <h2>Daftar Barang</h2>
            <table>
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Barang</th>
                        <th>Lokasi</th>
                        <th>Stok</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($barang as $data)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $data->nama_barang }}</td>
                            <td>{{ $data->lokasi_barang ?: '-' }}</td>
                            <td>{{ $data->stock_barang }}</td>
                            <td class="status">{{ $data->stock_barang > 0 ? 'Tersedia' : 'Stok habis' }}</td>
                            <td>@if($data->stock_barang > 0)<a class="btn primary"
                            href="{{ url('/pinjam/' . $data->id) }}">Pinjam</a>@else<span class="status">Tidak
                                    tersedia</span>@endif</td>
                        </tr>
                    @empty<tr>
                        <td colspan="6" class="empty">Belum ada data barang.</td>
                    </tr>@endforelse
                </tbody>
            </table>
        </section>
    </main>
</body>

</html>