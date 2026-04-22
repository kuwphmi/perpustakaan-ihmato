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
            padding-bottom: 10px;
        }

        .card {
            min-width: 150px;
            cursor: pointer;
            border: none;
        }

        .card img {
            height: 200px;
            object-fit: cover;
        }
    </style>
</head>
<body>

<!-- NAVBAR -->
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

    <!-- SEARCH -->
    <div class="d-flex mb-3">
        <input type="text" id="search" value="{{ $q ?? '' }}" class="form-control me-2" placeholder="Cari buku...">

        <a href="/notifi" class="btn btn-outline-secondary">🔔</a>
        <a href="/wishlist" class="btn btn-outline-danger ms-2">❤️</a>
    </div>

    <!-- GENRE -->
    <h5>Genre</h5>
    <div class="d-flex flex-wrap gap-2 mb-3">
        @foreach($genres as $g)
            <a href="/genre/{{ urlencode($g) }}" class="text-decoration-none">
                <span class="badge bg-secondary p-2">{{ $g }}</span>
            </a>
        @endforeach
    </div>

    <!-- BUKU TERBAIK -->
    <div class="d-flex justify-content-between align-items-center">
        <h5>Buku Terbaik</h5>
        <span>→</span>
    </div>

    <div class="scroll-x mb-4">
        @foreach($bestBooks as $b)
        <div class="card"
            data-bs-toggle="modal"
            data-bs-target="#detailModal"
            onclick="showDetail(
                '{{ addslashes($b['title']) }}',
                '{{ addslashes($b['author']) }}',
                '{{ $b['cover'] }}'
            )">

            @if($b['cover'])
                <img src="https://covers.openlibrary.org/b/id/{{ $b['cover'] }}-M.jpg" class="card-img-top">
            @else
                <img src="https://via.placeholder.com/150x200?text=No+Cover">
            @endif

            <div class="card-body p-2">
                <small>{{ $b['title'] }}</small>
            </div>
        </div>
        @endforeach
    </div>

    <!-- BUKU TERBARU -->
    <div class="d-flex justify-content-between align-items-center">
        <h5>Buku Terbaru</h5>
        <span>→</span>
    </div>

    <div class="scroll-x">
        @foreach($newBooks as $b)
        <div class="card"
            data-bs-toggle="modal"
            data-bs-target="#detailModal"
            onclick="showDetail(
                '{{ addslashes($b['title']) }}',
                '{{ addslashes($b['author']) }}',
                '{{ $b['cover'] }}'
            )">

            @if($b['cover'])
                <img src="https://covers.openlibrary.org/b/id/{{ $b['cover'] }}-M.jpg" class="card-img-top">
            @else
                <img src="https://via.placeholder.com/150x200?text=No+Cover">
            @endif

            <div class="card-body p-2">
                <small>{{ $b['title'] }}</small>
            </div>
        </div>
        @endforeach
    </div>

</div>

<!-- MODAL DETAIL -->
<div class="modal fade" id="detailModal" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">Detail Buku</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <div class="row">

          <!-- COVER -->
          <div class="col-md-4">
            <img id="modalCover" class="img-fluid">
          </div>

          <!-- DETAIL -->
          <div class="col-md-8">
            <h4 id="modalBookTitle"></h4>

            <p><b>Author:</b> <span id="modalAuthor"></span></p>

            <button class="btn btn-danger">Wishlist</button>
            <button class="btn btn-primary">Pinjam</button>
          </div>

        </div>
      </div>

    </div>
  </div>
</div>

<!-- SEARCH SCRIPT -->
<script>
document.getElementById("search").addEventListener("keydown", function(e) {
    if (e.key === "Enter") {
        e.preventDefault();
        let keyword = this.value.trim();

        if (keyword !== "") {
            window.location.href = "/search?q=" + keyword;
        }
    }
});
</script>

<!-- MODAL SCRIPT -->
<script>
function showDetail(title, author, cover) {
    document.getElementById("modalBookTitle").innerText = title;
    document.getElementById("modalAuthor").innerText = author;

    document.getElementById("modalCover").src =
        cover
        ? "https://covers.openlibrary.org/b/id/" + cover + "-L.jpg"
        : "https://via.placeholder.com/200x300?text=No+Cover";
}
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>