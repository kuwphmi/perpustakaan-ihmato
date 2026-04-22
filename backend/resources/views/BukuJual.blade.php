<!DOCTYPE html>
<html>
<head>
    <title>Belanja Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<!-- 🔵 NAVBAR (TAMBAHAN BARU - TIDAK MENGHAPUS YANG ADA) -->
<nav class="navbar navbar-light bg-white shadow-sm px-4 py-3 mb-4">
    <div class="container-fluid">

        <span class="navbar-brand fw-bold text-primary">
            📚 BukuIn Store
        </span>

        <div class="d-flex gap-3 align-items-center">

            <!-- STATUS -->
            <div class="dropdown">
                <button class="btn btn-outline-secondary btn-sm dropdown-toggle" data-bs-toggle="dropdown">
                    Status
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="#">Diproses</a></li>
                    <li><a class="dropdown-item" href="#">Dikirim</a></li>
                    <li><a class="dropdown-item" href="#">Selesai</a></li>
                </ul>
            </div>

            <!-- 🛒 KERANJANG ATAS (HANYA LIHAT ISI) -->
            <a href="/keranjang" class="btn btn-success btn-sm">
                🛒 Keranjang
                <span id="cartCount" class="badge bg-danger">0</span>
            </a>

            <!-- PROFIL -->
            <a href="/profile" class="btn btn-primary btn-sm">
                👤 Profil
            </a>

        </div>

    </div>
</nav>


<div class="container mt-4">

    <h2 class="mb-4">🛒 Belanja Buku</h2>

    @foreach($booksByGenre as $genre => $books)

        <!-- 🏷 GENRE -->
        <h4 class="mt-5 mb-3">📚 {{ $genre }}</h4>

        <div class="row">
            @foreach($books as $b)
            <div class="col-md-3 mb-4">

                <div class="card h-100 shadow-sm">

                    <img src="{{ $b['cover'] }}"
                         class="card-img-top"
                         style="height:250px; object-fit:cover;">

                    <div class="card-body">

                        <h6 class="fw-bold">{{ $b['title'] }}</h6>
                        <small class="text-muted">{{ $b['author'] }}</small>

                        <hr>

                        <p>💰 Rp {{ number_format($b['price'], 0, ',', '.') }}</p>
                        <p>📦 Stok: {{ $b['stock'] }}</p>

                        <div class="d-flex gap-2">

                            <!-- 🛒 TOMBOL KERANJANG (TAMBAH KE BACKEND) -->
                            <button class="btn btn-success btn-sm w-50"
                                onclick="tambahKeranjang(
                                    '{{ $b['title'] }}',
                                    '{{ $b['cover'] }}',
                                    {{ $b['price'] }}
                                )">
                                Keranjang
                            </button>

                            <!-- Beli -->
                            <button class="btn btn-primary btn-sm w-50">
                                Beli
                            </button>

                        </div>

                    </div>

                </div>

            </div>
            @endforeach
        </div>

    @endforeach

</div>

<!-- JS -->
<script>
function tambahKeranjang(judul, gambar, harga) {
    fetch('http://localhost:8000/api/keranjang/tambah', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            id_pengguna: 1,
            judul: judul,
            gambar: gambar,
            harga: harga
        })
    })
    .then(res => res.json())
    .then(data => {
        alert("Masuk keranjang!");
        loadKeranjang(); // update badge
    })
    .catch(err => {
        console.error(err);
        alert('Gagal menambahkan ke keranjang');
    });
}

// 🔵 AMBIL JUMLAH KERANJANG UNTUK BADGE ATAS
function loadKeranjang() {
    fetch('http://localhost:8000/api/keranjang')
    .then(res => res.json())
    .then(data => {
        document.getElementById("cartCount").innerText = data.data.length;
    })
    .catch(err => console.log(err));
}

loadKeranjang();

</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>