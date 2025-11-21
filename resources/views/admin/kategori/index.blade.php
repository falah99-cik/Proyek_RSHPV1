<h3>Daftar Kategori</h3>

<table border="1" cellpadding="5">
    <tr>
        <th>ID</th>
        <th>Nama Kategori</th>
    </tr>

    @foreach ($kategori as $k)
    <tr>
        <td>{{ $k->idkategori }}</td>
        <td>{{ $k->nama_kategori }}</td>
    </tr>
    @endforeach
</table>
