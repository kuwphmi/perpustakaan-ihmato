<h1>Login</h1>

@if(session('error'))
    <p style="color:red">{{ session('error') }}</p>
@endif

<form method="POST" action="/login">
    @csrf

    Nama: <input type="text" name="nama"><br><br>
    Tanggal Lahir: <input type="date" name="tgl_lahir"><br><br>

    Jenis Kelamin:
    <select name="jk">
        <option value="Laki-laki">Laki-laki</option>
        <option value="Perempuan">Perempuan</option>
    </select><br><br>

    No HP: <input type="text" name="no_hp"><br><br>

    Email: <input type="text" name="email"><br><br>
    Password: <input type="password" name="password"><br><br>

    <button type="submit">Login</button>
</form>