<!DOCTYPE html>
<html>
<head>
    <title>Search</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .card img {
            height: 200px;
            object-fit: cover;
        }
    </style>
</head>
<body>

<div class="container mt-4">

    <a href="/home">← Kembali</a>

    <div class="d-flex mt-3 mb-3">
        <input type="text" id="search" class="form-control" value="{{ $q }}" placeholder="Cari buku...">
    </div>

    <h5>Hasil: "{{ $q }}"</h5>

    <div class="row">
        @foreach($results as $r)
        <div class="col-md-2 mb-3">
            <div class="card"
                data-bs-toggle="modal"
                data-bs-target="#detailModal"
                onclick="showDetail('{{ addslashes($r['title']) }}','{{ addslashes($r['author']) }}','{{ $r['cover'] }}')">

                <img src="https://covers.openlibrary.org/b/id/{{ $r['cover'] }}-M.jpg">

                <div class="p-2">
                    <small><b>{{ $r['title'] }}</b></small><br>
                    <small>{{ $r['author'] }}</small>
                </div>
            </div>
        </div>
        @endforeach
    </div>

</div>

<!-- MODAL -->
<div class="modal fade" id="detailModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content p-3">

        <div class="row">
            <div class="col-md-4">
                <img id="modalCover" class="img-fluid">
            </div>

            <div class="col-md-8">
                <h4 id="modalTitle"></h4>
                <p><b>Author:</b> <span id="modalAuthor"></span></p>

                <button class="btn btn-danger">❤️ Wishlist</button>
                <button class="btn btn-primary">📚 Pinjam</button>
            </div>
        </div>

    </div>
  </div>
</div>

<script>
document.getElementById("search").addEventListener("keydown", function(e) {
    if (e.key === "Enter") {
        window.location.href = "/search?q=" + this.value;
    }
});

function showDetail(title, author, cover) {
    document.getElementById("modalTitle").innerText = title;
    document.getElementById("modalAuthor").innerText = author;

    document.getElementById("modalCover").src =
        cover ? "https://covers.openlibrary.org/b/id/" + cover + "-L.jpg"
              : "https://via.placeholder.com/200x300";
}
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>