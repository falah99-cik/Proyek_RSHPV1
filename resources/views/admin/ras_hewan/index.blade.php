<h3>Daftar Ras Hewan</h3>

<table border="1" cellpadding="5">
    <tr>
        <th>ID</th>
        <th>Nama Ras</th>
        <th>Jenis Hewan</th>
    </tr>

    @foreach ($rasHewan as $r)
    <tr>
        <td>{{ $r->idras_hewan }}</td>
        <td>{{ $r->nama_ras }}</td>
        <td>{{ $r->jenis->nama_jenis_hewan }}</td>
    </tr>
    @endforeach
</table>
