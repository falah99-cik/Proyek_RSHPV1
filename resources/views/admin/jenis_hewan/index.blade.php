<h3>Daftar Jenis Hewan</h3>

<table border="1" cellpadding="5">
    <tr>
        <th>ID</th>
        <th>Nama Jenis Hewan</th>
    </tr>

    @foreach ($jenisHewan as $j)
    <tr>
        <td>{{ $j->idjenis_hewan }}</td>
        <td>{{ $j->nama_jenis_hewan }}</td>
    </tr>
    @endforeach
</table>
