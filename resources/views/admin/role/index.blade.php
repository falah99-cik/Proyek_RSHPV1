<h3>Daftar Role</h3>

<table border="1" cellpadding="5">
    <tr>
        <th>ID</th>
        <th>Nama Role</th>
    </tr>

    @foreach ($role as $r)
    <tr>
        <td>{{ $r->idrole }}</td>
        <td>{{ $r->nama_role }}</td>
    </tr>
    @endforeach
</table>
