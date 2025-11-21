<h3>Daftar Pet</h3>

<table border="1" cellpadding="5">
    <tr>
        <th>ID</th>
        <th>Nama</th>
        <th>Tanggal Lahir</th>
        <th>Warna</th>
        <th>Jenis Kelamin</th>
        <th>Pemilik</th>
        <th>Ras</th>
        <th>Jenis Hewan</th>
    </tr>

    @foreach ($pet as $p)
    <tr>
        <td>{{ $p->idpet }}</td>
        <td>{{ $p->nama }}</td>
        <td>{{ $p->tanggal_lahir }}</td>
        <td>{{ $p->warna_tanda }}</td>
        <td>{{ $p->jenis_kelamin }}</td>
        <td>{{ $p->pemilik->user->nama }}</td>
        <td>{{ $p->ras->nama_ras }}</td>
        <td>{{ $p->ras->jenis->nama_jenis_hewan }}</td>
    </tr>
    @endforeach
</table>
