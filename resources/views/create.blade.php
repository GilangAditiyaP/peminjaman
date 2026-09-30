<!DOCTYPE html>
<html>
<head>
    <title>Pinjam</title>
</head>
<body>

    <h1>Pinjam Barang</h1>

    <table border="1" ">
        <tr>
            <th>Nama Barang</th>
            <td>{{ $barang->nama_barang }}</td>
        </tr>
        <tr>
            <th>Stock</th>
            <td>{{ $barang->stock_barang }}</td>
        </tr>
        <tr>
            <th>Kondisi</th>
            <td>{{ $barang->kondisi_barang }}</td>
        </tr>
    </table>

    <br>

    <form action="/peminjaman" method="POST">

        @csrf

        <input type="hidden" name="barang_id" value="{{ $barang->id }}">
        
        <label>Nama Peminjam</label>
        <br>
        <input type="text" name="nama_peminjam">
        <br>
        <label>Jumlah</label>
        <br>
        <input type="number" name="jumlah" min="1">
        <br>
        <label>Tanggal Pinjam</label>
        <br>
        <input type="date" name="tanggal_pinjam">
        <br>
        <button type="submit">Pinjam</button>
    </form>
</body>
</html>