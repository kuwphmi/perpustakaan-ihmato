<!DOCTYPE html>
<html>
<head>
    <title>Genre - {{ $name }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .card {
            height: 100%;
        }

        .book-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            gap: 15px;
        }
    </style>
</head>
<body>

<!-- 🔝 NAVBAR -->
<nav class="navbar navbar-dark bg-dark px-3">
    <a href="/home" class="text-white text-decoration-none">← Home</a>
    <span class="navbar-brand ms-3">{{ $name }}</span>
</nav>

<div class="container mt-4">

    <h5 class="mb-3">Genre: {{ $name }}</h5>

    <!-- 📚 BOOK GRID (VERTICAL SCROLL) -->
    <div class="book-grid">

        @forelse($books as $b)
        <a 
            href="/book/{{ urlencode($b['title'] ?? '') }}?from=genre&genre={{ urlencode($name) }}" 
            class="text-decoration-none text-dark"
        >

            <div class="card">

                @if(!empty($b['cover_i']))
                    <img src="https://covers.openlibrary.org/b/id/{{ $b['cover_i'] }}-M.jpg" class="card-img-top">
                @endif

                <div class="card-body">
                    <small>{{ $b['title'] ?? 'No Title' }}</small>
                </div>

            </div>

        </a>
        @empty
            <p>Tidak ada buku ditemukan.</p>
        @endforelse

    </div>

</div>

</body>
</html>