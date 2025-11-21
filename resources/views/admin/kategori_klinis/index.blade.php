<h3>Daftar Kategori Klinis</h3>

<table border="1" cellpadding="5">
    <tr>
        <th>ID</th>
        <th>Nama Kategori Klinis</th>
    </tr>

    @foreach ($kategoriKlinis as $kk)
    <tr>
        <td>{{ $kk->idkategori_klinis }}</td>
        <td>{{ $kk->nama_kategori_klinis }}</td>
    </tr>
    @endforeach
</table>
