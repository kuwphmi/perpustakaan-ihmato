<!DOCTYPE html>
<html>
<head>
    <title>Belanja Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">

    <h2 class="mb-4">🛒 Belanja Buku</h2>

    <!-- 🔍 SEARCH (opsional, nanti bisa dikembangkan) -->
    <form method="GET" action="/belanja" class="mb-4">
        <input type="text" name="q" class="form-control" placeholder="Cari buku...">
    </form>

    <div class="row">

        @foreach($books as $b)
        <div class="col-md-3 mb-4">

            <div class="card h-100 shadow-sm">

                <!-- 🖼 COVER -->
                <img src="{{ $b['cover'] }}"
                     class="card-img-top"
                     style="height:250px; object-fit:cover;">

                <div class="card-body">

                    <!-- 📚 TITLE -->
                    <h6 class="fw-bold">{{ $b['title'] }}</h6>

                    <!-- ✍️ AUTHOR -->
                    <small class="text-muted">{{ $b['author'] }}</small>

                    <hr>

                    <!-- 💰 PRICE -->
                    <p class="mb-1">💰 Rp {{ number_format($b['price'], 0, ',', '.') }}</p>

                    <!-- 📦 STOCK -->
                    <p class="mb-2">📦 Stok: {{ $b['stock'] }}</p>

                    <!-- 🛒 BUTTON -->
                    <button class="btn btn-primary btn-sm w-100">
                        Beli
                    </button>

                </div>

            </div>

        </div>
        @endforeach

    </div>

</div>

</body>
</html>