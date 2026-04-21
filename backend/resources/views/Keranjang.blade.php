<!DOCTYPE html>
<html>
<head>
    <title>Keranjang Belanja</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">

    <h2 class="mb-4">🛒 Keranjang Saya</h2>

    @if(count($keranjang) == 0)
        <div class="alert alert-info">
            Keranjang masih kosong 😢
        </div>
    @else

    <table class="table table-bordered">

        <thead>
            <tr>
                <th>Gambar</th>
                <th>Judul</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Total</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
        @foreach($keranjang as $item)
            <tr>

                <td>
                    <img src="{{ $item->gambar }}" width="60">
                </td>

                <td>{{ $item->judul }}</td>

                <td>Rp {{ number_format($item->harga,0,',','.') }}</td>

                <td>{{ $item->jumlah }}</td>

                <td>
                    Rp {{ number_format($item->harga * $item->jumlah,0,',','.') }}
                </td>

                <td>
                    <button class="btn btn-danger btn-sm"
                        onclick="hapusItem({{ $item->id }})">
                        Hapus
                    </button>
                </td>

            </tr>
        @endforeach
        </tbody>

    </table>

    <h4 class="text-end">
        Total: Rp {{ number_format($total,0,',','.') }}
    </h4>

    @endif

</div>

<script>
function hapusItem(id) {
    fetch('/keranjang/hapus', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ id: id })
    })
    .then(res => res.json())
    .then(data => {
        alert(data.message);
        location.reload();
    });
}
</script>

</body>
</html>