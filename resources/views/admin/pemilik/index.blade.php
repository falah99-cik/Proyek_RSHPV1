<h3>Daftar Pemilik</h3>

<table border="1" cellpadding="6" cellspacing="0" style="border-collapse: collapse; width: 100%">
    <thead>
        <tr style="background: #f2f2f2;">
            <th>No</th>
            <th>Nama Pemilik</th>
            <th>Nomor WA</th>
            <th>Alamat</th>
            <th>Email User</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($data as $index => $p)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $p->user->nama ?? '-' }}</td>
            <td>{{ $p->no_wa }}</td>
            <td>{{ $p->alamat }}</td>
            <td>{{ $p->user->email ?? '-' }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
