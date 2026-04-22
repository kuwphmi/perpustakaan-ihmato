<!DOCTYPE html>
<html>
<head>
    <title>Belanja Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .top-right {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .status-box {
            padding: 6px 10px;
            background: #f1f1f1;
            border-radius: 8px;
            font-size: 14px;
        }
    </style>
</head>

<body>

<div class="container mt-4">

    <!-- TOP BAR (KANAN ATAS) -->
    <div class="top-bar">

        <h2>🛒 Belanja Buku</h2>

        <div class="top-right">

            <!-- STATUS (BUKAN DROPDOWN) -->
            <div class="status-box">
                Status: <strong>Diproses</strong>
            </div>

            <!-- TOMBOL KERANJANG (GLOBAL) -->
            <button class="btn btn-success btn-sm">
                🛒 Keranjang
            </button>

            <!-- TOMBOL PROFIL -->
            <button class="btn btn-primary btn-sm">
                👤 Profil
            </button>

        </div>
    </div>

    @foreach($booksByGenre as $genre => $books)

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

                        <!-- TOMBOL ATAS (KERANJANG LIHAT) -->
                        <div class="mb-2">
                            <button class="btn btn-outline-success btn-sm w-100">
                                Lihat Keranjang
                            </button>
                        </div>

                        <div class="d-flex gap-2">

                            <!-- KERANJANG (TAMBAH) -->
                            <button class="btn btn-success btn-sm w-50"
                                onclick="tambahKeranjang(
                                    '{{ $b['title'] }}',
                                    '{{ $b['cover'] }}',
                                    {{ $b['price'] }}
                                )">
                                Keranjang
                            </button>

                            <!-- BELI -->
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
            id_buku: judul,
            judul: judul,
            gambar: gambar,
            harga: harga
        })
    })
    .then(res => res.json())
    .then(data => {
        alert(data.message);
    })
    .catch(err => {
        console.error(err);
        alert('Gagal menambahkan ke keranjang');
    });
}
</script>

</body>
</html>