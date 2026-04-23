<h1>Dashboard Super Admin</h1>
<form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit">Logout</button>
</form>

<table border="1" cellpadding="10">
<tr>
    <th>Nama</th>
    <th>Email</th>
    <th>Status</th>
    <th>Aksi</th>
</tr>

@foreach($admins as $admin)
<tr>
    <td>{{ $admin->name }}</td>
    <td>{{ $admin->email }}</td>
    <td>{{ $admin->status }}</td>
    <td>

        <form action="/approve/{{ $admin->id }}" method="POST">
            @csrf
            <button type="submit">Approve</button>
        </form>

        <form action="/reject/{{ $admin->id }}" method="POST">
            @csrf
            <button type="submit">Reject</button>
        </form>

    </td>
</tr>
@endforeach

</table>