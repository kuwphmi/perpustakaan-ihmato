<!DOCTYPE html>
<html>
<head>
    <title>Beranda</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .scroll-x {
            display: flex;
            overflow-x: auto;
            gap: 15px;
        }
        .card {
            min-width: 150px;
            cursor: pointer;
        }
    </style>
</head>
<body>

<!-- 🔝 NAVBAR -->
<nav class="navbar navbar-dark bg-dark px-3">
    <span class="navbar-brand">Perpustakaan</span>
    <div>
        <a href="/home" class="text-white me-3">Beranda</a>
        <a href="#" class="text-white me-3">Katalog</a>
        <a href="/riwayat" class="text-white me-3">Riwayat</a>
        <a href="#" class="text-white">Profil</a>
    </div>
</nav>

<div class="container mt-4">

    <!-- 🔍 SEARCH + ICON -->
    <div class="d-flex mb-3">
        <input type="text" id="search" value="{{ $q ?? '' }}" class="form-control me-2" placeholder="Cari buku...">

        <a href="/notifi" class="btn btn-outline-secondary">🔔</a>
        <a href="/wishlist" class="btn btn-outline-danger ms-2">❤️</a>
    </div>

    <!-- 🎯 GENRE -->
<h5>Genre</h5>

<div class="d-flex flex-wrap gap-2 mb-3">

    @foreach($genres as $g)
        <a href="/genre/{{ urlencode($g) }}" class="text-decoration-none">
            <span class="badge bg-secondary p-2">
                {{ $g }}
            </span>
        </a>
    @endforeach

</div>

    <!-- ⭐ BUKU TERBAIK -->
    <div class="d-flex justify-content-between align-items-center">
        <h5>Buku Terbaik</h5>
        <span>→</span>
    </div>

    <div class="scroll-x mb-4">
        @foreach($bestBooks as $b)
        <a href="/book/{{ urlencode($b['title']) }}">
            <div class="card">
                @if($b['cover'])
                    <img src="https://covers.openlibrary.org/b/id/{{ $b['cover'] }}-M.jpg" class="card-img-top">
                @endif
                <div class="card-body">
                    <small>{{ $b['title'] }}</small>
                </div>
            </div>
        </a>
        @endforeach
    </div>

    <!-- 🆕 BUKU TERBARU -->
    <div class="d-flex justify-content-between align-items-center">
        <h5>Buku Terbaru</h5>
        <span>→</span>
    </div>

    <div class="scroll-x">
        @foreach($newBooks as $b)
        <a href="/book/{{ urlencode($b['title']) }}">
            <div class="card">
                @if($b['cover'])
                    <img src="https://covers.openlibrary.org/b/id/{{ $b['cover'] }}-M.jpg" class="card-img-top">
                @endif
                <div class="card-body">
                    <small>{{ $b['title'] }}</small>
                </div>
            </div>
        </a>
        @endforeach
    </div>

</div>

<!-- 🔥 SEARCH ENTER -->
<script>
document.getElementById("search").addEventListener("keypress", function(e) {
    if (e.key === "Enter") {
        let keyword = this.value;
        window.location.href = "/search?q=" + keyword;
    }
});
</script>

</body>
</html>