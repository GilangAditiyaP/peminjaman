
<h1>Kembalikan Barang</h1>

@foreach ($peminjaman as $item)

    <p>ID Peminjaman: {{ $item->id }}</p>
    <p>ID Barang: {{ $item->barang_id }}</p>
    <p>Nama Peminjam: {{ $item->nama_peminjam }}</p>
    <p>Jumlah: {{ $item->jumlah }}</p>
    <p>Tanggal Pinjam: {{ $item->tanggal_pinjam }}</p>

    <form action="{{ url('/kembalikan/' . $item->id) }}"
          method="POST">
        @csrf

        <label>Kondisi Barang:</label>
        <select name="kondisi" required>
            <option value="">-- Pilih Kondisi --</option>
            <option value="Baik">Baik</option>
            <option value="Rusak">Rusak</option>
            <option value="Hilang">Hilang</option>
        </select>

        <button type="submit">Kembalikan</button>
    </form>

    <hr>

@endforeach