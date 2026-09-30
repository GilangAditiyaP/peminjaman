<h1>Kembalikan Barang</h1>

@foreach ($peminjaman as $item)

    <p>Nama: {{ $item->nama_peminjam }}</p>
    <p>Jumlah: {{ $item->jumlah }}</p>
    <p>Tanggal Pinjam: {{ $item->tanggal_pinjam }}</p>

    <form action="/kembalikan/{{ $item->id }}" method="POST">
        @csrf

        <button type="submit">Kembalikan</button>
    </form>

    <hr>

@endforeach