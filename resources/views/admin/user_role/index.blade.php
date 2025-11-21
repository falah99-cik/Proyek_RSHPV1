<h3>Daftar User dan Role Aktif</h3>

<table border="1" cellpadding="5">
    <tr>
        <th>ID</th>
        <th>Nama</th>
        <th>Email</th>
        <th>Role</th>
    </tr>

    @foreach ($users as $u)
    <tr>
        <td>{{ $u->iduser }}</td>
        <td>{{ $u->nama }}</td>
        <td>{{ $u->email }}</td>
        <td>
            @foreach ($u->roleAktif as $r)
                {{ $r->nama_role }}
            @endforeach
        </td>
    </tr>
    @endforeach
</table>
