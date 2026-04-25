<!DOCTYPE html>
<html>
<head>
    <title>Laporan Peminjaman</title>
    <style>
        body {
            font-family: Arial;
            font-size: 11px;
        }

        h3 {
            text-align: center;
            margin-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 5px;
            text-align: center;
        }

        th {
            background-color: #f0f0f0;
        }
    </style>
</head>
<body>

<h3>PEMINJAMAN KOLEKSI PERPUSTAKAAN</h3>

<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Peminjam</th>
            <th>Judul Buku</th>
            <th>Tanggal Pinjam</th>
            <th>Tanggal Kembali</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach($loans as $i => $l)
        <tr>
            <td>{{ $i + 1 }}</td>
            <td>{{ $l->member_name }}</td>
            <td>{{ $l->book_title }}</td>
            <td>{{ date('d-m-Y', strtotime($l->request_date)) }}</td>
            <td>
                {{ $l->returned_at ? date('d-m-Y', strtotime($l->returned_at)) : '-' }}
            </td>
            <td>{{ $l->status }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>