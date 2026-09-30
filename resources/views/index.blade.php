<!DOCTYPE html>
<html>
<head>
    <title>Data Barang</title>
</head>
<body>

    <h1>Data Barang</h1>

    <table border="1">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Stock</th>
                <th>Kondisi</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($barang as $data)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $data->nama_barang }}</td>
                    <td>{{ $data->stock_barang }}</td>
                    <td>{{ $data->kondisi_barang }}</td>
                    <td>
                      <a href="/pinjam/{{ $data->id }}">Pinjam</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>