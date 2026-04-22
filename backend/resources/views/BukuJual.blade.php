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
            gap: 15px;
        }

        .top-left {
            display: flex;
            align-items: center;
            gap: 10px;
            flex: 1;
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
            white-space: nowrap;
        }

        .search-input {
            max-width: 300px;
        }
    </style>
</head>

<body>

<div class="container mt-4">

    <!-- TOP BAR -->
    <div class="top-bar">

        <!-- LEFT -->
        <div class="top-left">

            <h2 class="m-0">🛒 Belanja Buku</h2>

            <input
                type="text"
                class="form-control search-input"
                placeholder="🔍 Cari buku..."
            >

        </div>

        <!-- RIGHT -->
        <div class="top-right">

            <div class="status-box">
                Status: <strong>Diproses</strong>
            </div>

            <!-- GLOBAL KERANJANG (TIDAK DIHAPUS) -->
            <button class="btn btn-success btn-sm">
                🛒 Keranjang
            </button>

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

                        <!-- ACTION BUTTONS -->
                        <div class="d-flex gap-2">

                            <!-- KERANJANG (DATABASE CONNECT - JANGAN DIHAPUS) -->
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

<!-- JS (TETAP PERTAHANKAN - CONNECT DB) -->
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