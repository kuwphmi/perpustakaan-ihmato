<!DOCTYPE html>
<html>
<head>
    <title>Beranda</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">

    <h2>Beranda</h2>

    <!-- 🔍 SEARCH -->
    <input type="text" class="form-control mb-4" placeholder="Cari buku...">

    <!-- 📚 SUBJECT -->
    <h4>Subjects</h4>
    <div class="row">
        @foreach($subjects as $category => $items)
            <div class="col-md-4 mb-3">
                <h6>{{ $category }}</h6>
                @foreach($items as $item)
                    <span class="badge bg-secondary m-1">{{ $item }}</span>
                @endforeach
            </div>
        @endforeach
    </div>

    <!-- ⭐ BUKU -->
    <h4 class="mt-4">Rekomendasi Buku</h4>
    <div class="row">
        @foreach($books as $b)
        <div class="col-md-3">
            <div class="card mb-3">
                <div class="card-body">
                    <h6>{{ $b['title'] }}</h6>
                    <small>{{ $b['author'] }}</small>
                </div>
            </div>
        </div>
        @endforeach
    </div>

</div>

</body>
</html>