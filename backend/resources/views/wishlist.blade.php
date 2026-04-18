<!DOCTYPE html>
<html>
<head>
    <title>Wishlist</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-dark bg-dark px-3">
    <a href="/home" class="text-white text-decoration-none">← Home</a>
    <span class="navbar-brand">Wishlist</span>
</nav>

<div class="container mt-4">

    <h5>Buku Favorit Kamu</h5>

    <div class="row">

        @forelse($wishlist as $b)
        <div class="col-6 col-md-3 mb-3">

            <div class="card">

                @if($b['cover'])
                    <img src="https://covers.openlibrary.org/b/id/{{ $b['cover'] }}-M.jpg" class="card-img-top">
                @endif

                <div class="card-body">
                    <small>{{ $b['title'] }}</small><br>
                    <small class="text-muted">{{ $b['author'] }}</small>
                </div>

            </div>

        </div>
        @empty
            <p>Belum ada wishlist.</p>
        @endforelse

    </div>

</div>

</body>
</html>