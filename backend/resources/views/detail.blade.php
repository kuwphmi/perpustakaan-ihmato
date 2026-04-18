<!DOCTYPE html>
<html>
<head>
    <title>Detail Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">

    <!-- BACK BUTTON -->
     <!--button back genre-->
    @if($from == 'genre')
        <a href="/genre/{{ urlencode($genre) }}" class="text-decoration-none mb-3 d-inline-block">
            ← Kembali
        </a>
     <!--button back search-->
    @elseif($from == 'search')
        <a href="/search?q={{ request('q') }}" class="text-decoration-none mb-3 d-inline-block">
            ← Kembali
        </a>
     <!--button back home-->
    @else
        <a href="/home" class="text-decoration-none mb-3 d-inline-block">
            ← Kembali
        </a>
    @endif

    @if($book)
    <div class="row">

        <!-- 📚 COVER -->
        <div class="col-md-4">
            @if($book['cover'])
                <img src="https://covers.openlibrary.org/b/id/{{ $book['cover'] }}-L.jpg" class="img-fluid">
            @else
                <img src="https://via.placeholder.com/200x300?text=No+Cover" class="img-fluid">
            @endif
        </div>

        <!-- 📖 DETAIL -->
        <div class="col-md-8">
            <h3>{{ $book['title'] }}</h3>

            <p><b>Author:</b> {{ $book['author'] }}</p>
            <p><b>Tahun:</b> {{ $book['year'] }}</p>

            <p><b>Deskripsi:</b><br>
                {{ $book['subject'] }}
            </p>

            <!-- 🔥 BUTTON -->
            <button class="btn btn-danger">❤️ Wishlist</button>
            <a href="/wishlist/add?title={{ urlencode($book['title']) }}&author={{ urlencode($book['author']) }}&cover={{ $book['cover'] }}"
   class="btn btn-danger">
    ❤️ Wishlist
</a>
            <button class="btn btn-primary">📚 Pinjam</button>
        </div>

    </div>
    @else
        <p>Data buku tidak ditemukan.</p>
    @endif

</div>

</body>
</html>