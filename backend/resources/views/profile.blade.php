<h1>Profile</h1>

<p>Email: {{ session('user') }}</p>

<a href="/logout">Logout</a><h1>Profile</h1>

<p>Nama: {{ session('user.nama') }}</p>
<p>Tanggal Lahir: {{ session('user.tgl_lahir') }}</p>
<p>Jenis Kelamin: {{ session('user.jk') }}</p>
<p>No HP: {{ session('user.no_hp') }}</p>
<p>Email: {{ session('user.email') }}</p>

<a href="/logout">Logout</a>