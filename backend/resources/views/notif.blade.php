<!DOCTYPE html>
<html>
<head>
    <title>Notifikasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-dark bg-dark px-3">
    <a href="/home" class="text-white text-decoration-none">← Home</a>
    <span class="navbar-brand">Notifikasi</span>
</nav>

<div class="container mt-4">

    <h5>Pengingat Buku</h5>

    <div class="list-group">

        @forelse($notif as $n)
            <div class="list-group-item">
                <div>
                    📌 {{ $n['message'] ?? '' }}
                </div>
                <small class="text-muted">
                    ⏰ {{ $n['time'] ?? '' }}
                </small>
            </div>
        @empty
            <div class="list-group-item">
                Tidak ada pengingat
            </div>
        @endforelse

    </div>

</div>

</body>
</html>