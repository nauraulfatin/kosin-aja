<form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit">Logout</button>
</form>

<h1>Dashboard Admin Kos</h1>
<p>Selamat datang {{ auth()->user()->name }}</p>
