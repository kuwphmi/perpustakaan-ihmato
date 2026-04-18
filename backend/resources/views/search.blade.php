<!DOCTYPE html>
<html>
<head>
    <title>Hasil Pencarian</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .card {
            border: none;
            transition: 0.2s;
        }

        .card:hover {
            transform: scale(1.05);
        }

        .card img {
            height: 200px;
            object-fit: cover;
            border-radius: 8px;
        }

        .card-body {
            padding: 8px;
        }

        .card-body small {
            font-size: 12px;
        }

        .back-link {
            text-decoration: none;
            font-size: 14px;
        }
    </style>
</head>
<body>

<div class="container mt-4">

    <!-- 🔙 BACK SIMPLE -->
<a href="/book/{{ urlencode($b['title']) }}?from=search">
    <!-- 🔍 SEARCH -->
    <div class="d-flex mb-3">
        <input type="text" id="search" value="{{ $q ?? '' }}" class="form-control me-2" placeholder="Cari buku...">
    </div>

    <h5>Hasil pencarian: "{{ $q ?? '' }}"</h5>

    <div class="row">
        @foreach($results as $r)
        <div class="col-md-2 mb-3">
            <a href="/book/{{ urlencode($r['title']) }}" style="text-decoration: none; color: black;">
                <div class="card">

                    @if($r['cover'])
                        <img src="https://covers.openlibrary.org/b/id/{{ $r['cover'] }}-M.jpg">
                    @else
                        <!-- fallback kalau cover kosong -->
                        <img src="https://via.placeholder.com/150x200?text=No+Cover">
                    @endif

                    <div class="card-body">
                        <small><b>{{ $r['title'] }}</b></small><br>
                        <small>{{ $r['author'] }}</small>
                    </div>

                </div>
            </a>
        </div>
        @endforeach
    </div>

</div>

<!-- 🔥 SEARCH ENTER -->
<script>
document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("search").addEventListener("keydown", function(e) {
        if (e.key === "Enter") {
            e.preventDefault();
            let keyword = this.value.trim();

            if (keyword !== "") {
                window.location.href = "/search?q=" + keyword;
            }
        }
    });
});
</script>

</body>
</html>