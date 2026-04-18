<!DOCTYPE html>
<html>
<head>
    <title>Riwayat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .book-card {
            border: 1px solid #ddd;
            border-radius: 15px;
            padding: 10px;
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 15px;
        }

        .book-card img {
            width: 80px;
            height: 110px;
            object-fit: cover;
            border-radius: 10px;
        }

        .book-info {
            flex: 1;
        }

        .btn-perpanjang {
            background-color: #2c5d85;
            color: white;
            border-radius: 20px;
            font-size: 12px;
            padding: 5px 15px;
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

    <h4>Riwayat Peminjaman</h4>

    @foreach($history as $h)
    <div class="book-card">

        <!-- COVER (dummy dulu) -->
        <img src="https://via.placeholder.com/80x110" alt="cover">

        <div class="book-info">
            <strong>{{ $h['title'] }}</strong><br>
            <small>{{ $h['author'] }}</small><br>

            @if($h['status'] == 'Dipinjam')
                <button 
                    class="btn btn-perpanjang mt-2"
                    data-bs-toggle="modal"
                    data-bs-target="#modalPerpanjang"
                    onclick="setBook('{{ $h['title'] }}')"
                >
                    Perpanjang
                </button>
            @else
                <span class="badge bg-success mt-2">Selesai</span>
            @endif
        </div>

    </div>
    @endforeach

</div>

<!-- MODAL -->
<div class="modal fade" id="modalPerpanjang" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">Perpanjang Peminjaman</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <p><strong>Buku:</strong> <span id="namaBuku"></span></p>

        <p>Aturan perpanjangan:</p>
        <ul>
            <li>Maksimal 7 hari</li>
            <li>Tidak boleh telat</li>
            <li>Hanya 5x perpanjangan</li>
        </ul>
      </div>

      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button class="btn btn-success" onclick="perpanjang()">Ya</button>
      </div>

    </div>
  </div>
</div>

<script>
function setBook(title) {
    document.getElementById("namaBuku").innerText = title;
}

function perpanjang() {
    alert("Berhasil diperpanjang!");
}
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>