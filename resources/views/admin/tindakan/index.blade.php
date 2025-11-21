<h3>Daftar Kode Tindakan Terapi</h3>

<table border="1" cellpadding="5">
    <tr>
        <th>ID</th>
        <th>Kode</th>
        <th>Deskripsi</th>
        <th>Kategori</th>
        <th>Kategori Klinis</th>
    </tr>

    @foreach ($tindakan as $t)
    <tr>
        <td>{{ $t->idkode_tindakan_terapi }}</td>
        <td>{{ $t->kode }}</td>
        <td>{{ $t->deskripsi_tindakan_terapi }}</td>
        <td>{{ $t->kategori->nama_kategori }}</td>
        <td>{{ $t->kategoriKlinis->nama_kategori_klinis }}</td>
    </tr>
    @endforeach
</table>
